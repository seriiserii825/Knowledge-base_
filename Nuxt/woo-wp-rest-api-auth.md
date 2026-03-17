# WordPress & WooCommerce REST API — авторизация через Nuxt

## Архитектура

```
Браузер → Nuxt /api/* (Nitro) → WordPress REST API
```

Nuxt выступает единственным шлюзом к WordPress. Браузер никогда не обращается к WordPress напрямую.

---

## 1. Переменные окружения (.env)

```env
# WordPress REST API base URL
NUXT_PUBLIC_WP_URL=http://your-site.com/wp-json

# WooCommerce
WOOCOMMERCE_URL=http://your-site.com
WOOCOMMERCE_CONSUMER_KEY=ck_...
WOOCOMMERCE_CONSUMER_SECRET=cs_...

# Секретный ключ сервер-сервер (Nuxt → WordPress)
WP_API_SECRET=какой-нибудь-длинный-случайный-ключ-32символа
```

---

## 2. nuxt.config.ts

```ts
runtimeConfig: {
  wooKey: process.env.WOOCOMMERCE_CONSUMER_KEY,
  wooSecret: process.env.WOOCOMMERCE_CONSUMER_SECRET,
  wpApiSecret: process.env.WP_API_SECRET,
  public: {
    apiBase: process.env.NUXT_PUBLIC_WP_URL,
    wooUrl: process.env.WOOCOMMERCE_URL,
  },
},
```

Приватные ключи (`wooKey`, `wooSecret`, `wpApiSecret`) доступны **только на сервере**.
`public.*` доступны и на клиенте — не клади туда секреты.

---

## 3. WordPress REST API — server/utils/wpFetch.ts

Используется для кастомных WordPress endpoint'ов (`/custom/v1/*`, ACF и т.д.).

```ts
export function useWpFetch(event: Parameters<typeof getCookie>[0]) {
  const config = useRuntimeConfig();
  const token = getCookie(event, "token"); // JWT токен пользователя

  const headers: Record<string, string> = {
    "Content-Type": "application/json",
    Accept: "application/json",
    "X-WP-Secret": config.wpApiSecret, // сервер-серверный секрет
  };

  if (token) {
    headers.Authorization = `Bearer ${token}`; // токен авторизованного пользователя
  }

  return {
    get<T = unknown>(path: string) {
      return $fetch<T>(`${config.public.apiBase}${path}`, { headers });
    },
  };
}
```

**Пример использования** в `server/api/home.get.ts`:

```ts
export default defineEventHandler(async (event) => {
  const wp = useWpFetch(event);
  try {
    return await wp.get("/custom/v1/home");
  } catch (err: any) {
    throw createError({ statusCode: err?.status ?? 500, message: err?.message });
  }
});
```

---

## 4. WooCommerce REST API — server/utils/wooFetch.ts

WooCommerce по HTTP требует **OAuth 1.0a** (query params не работают без HTTPS).
Реализован через встроенный `node:crypto`, без дополнительных пакетов.

```ts
import { createHmac } from "node:crypto";

export function useWooFetch() {
  const config = useRuntimeConfig();
  const baseUrl = `${config.public.wooUrl}/wp-json/wc/v3`;

  const encode = (s: string) => encodeURIComponent(s);

  function sign(method: string, url: string, params: Record<string, string>) {
    const oauthParams: Record<string, string> = {
      oauth_consumer_key: config.wooKey,
      oauth_nonce: Math.random().toString(36).slice(2) + Math.random().toString(36).slice(2),
      oauth_signature_method: "HMAC-SHA256",
      oauth_timestamp: Math.floor(Date.now() / 1000).toString(),
      oauth_version: "1.0",
    };

    const allParams = { ...params, ...oauthParams };
    const paramString = Object.keys(allParams)
      .sort()
      .map((k) => `${encode(k)}=${encode(allParams[k])}`)
      .join("&");

    const baseString = `${method.toUpperCase()}&${encode(url)}&${encode(paramString)}`;
    const signingKey = `${encode(config.wooSecret)}&`;
    const signature = createHmac("sha256", signingKey).update(baseString).digest("base64");

    return { ...params, ...oauthParams, oauth_signature: signature };
  }

  return {
    get<T = unknown>(path: string, params: Record<string, string> = {}) {
      const url = `${baseUrl}${path}`;
      return $fetch<T>(url, {
        params: sign("GET", url, params),
        headers: { "X-WP-Secret": config.wpApiSecret },
      });
    },
  };
}
```

**Пример использования** в `server/api/categories.get.ts`:

```ts
export default defineEventHandler(async (event) => {
  const woo = useWooFetch();
  const query = getQuery(event) as Record<string, string>;
  try {
    return await woo.get("/products/categories", query);
  } catch (err: any) {
    throw createError({ statusCode: err?.status ?? 500, message: err?.message });
  }
});
```

---

## 5. Защита WordPress — functions.php

Блокирует все запросы к REST API без правильного `X-WP-Secret`.

```php
add_filter('rest_authentication_errors', function($result) {
    // Пропускаем если уже авторизован (wp-admin, JWT и т.д.)
    if (true === $result || is_wp_error($result)) {
        return $result;
    }

    $secret = $_SERVER['HTTP_X_WP_SECRET'] ?? '';
    $expected = defined('NUXT_API_SECRET') ? NUXT_API_SECRET : '';

    if (empty($expected) || !hash_equals($expected, $secret)) {
        return new WP_Error(
            'rest_forbidden',
            'Access denied.',
            ['status' => 403]
        );
    }

    return $result;
});
```

В `wp-config.php`:

```php
define('NUXT_API_SECRET', 'тот-же-ключ-что-и-в-WP_API_SECRET');
```

---

## 6. WooCommerce API ключи

1. WordPress Admin → WooCommerce → Settings → Advanced → REST API
2. **Add key** → User: администратор → Permissions: **Read** (или Read/Write)
3. Скопировать `Consumer key` и `Consumer secret` → вставить в `.env`

> **Важно:** WooCommerce показывает `Consumer secret` только один раз при создании.

---

## 7. Почему Basic auth / query params не работают по HTTP

WooCommerce REST API поддерживает два метода аутентификации:

| Метод                                          | Требование       |
| ---------------------------------------------- | ---------------- |
| Basic auth / query params (`consumer_key=...`) | Только **HTTPS** |
| OAuth 1.0a                                     | HTTP и HTTPS     |

На локальном сервере (`http://`) обязательно использовать OAuth 1.0a.
На продакшене с SSL можно использовать query params, но OAuth надёжнее.

---

## 8. Схема в продакшене

```
Интернет
    │
    ▼
Nuxt (публичный порт 443)
    │  X-WP-Secret + Bearer token (если авторизован)
    ▼
WordPress (закрытый, только localhost или внутренняя сеть)
```

Дополнительно можно закрыть `/wp-json/` на уровне Nginx:

```nginx
location /wp-json/ {
    allow 127.0.0.1;
    deny all;
    try_files $uri $uri/ /index.php?$args;
}
```

Тогда даже без `X-WP-Secret` никто не доберётся до WordPress напрямую.
