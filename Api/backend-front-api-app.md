### Структура окружений:

Backend:

- dev: https://api-dev.seriiburduja.org
- prod: https://api.seriiburduja.org

Frontend:

- dev: localhost:3000 (через прокси)
- prod: https://teashop.seriiburduja.org

### 1. Frontend — разные .env файлы:

```bash
# .env.development (для npm run dev)
NUXT_PUBLIC_API_BASE=/api
NUXT_PUBLIC_ENV=development
```

```bash
# .env.production (для npm run build)
NUXT_PUBLIC_API_BASE=https://api.seriiburduja.org
NUXT_PUBLIC_ENV=production
```

### 2. nuxt.config.ts — прокси только для dev:

```ts
typescriptexport default defineNuxtConfig({
runtimeConfig: {
public: {
apiBase: process.env.NUXT_PUBLIC_API_BASE,
},
},

nitro: {
devProxy: process.env.NODE_ENV === 'development'
? {
'/api': {
target: 'https://nest-teashop.seriiburduja.org',
changeOrigin: true,
cookieDomainRewrite: 'localhost',
}
}
: undefined,
},

// ... остальное
})
```

### 3. Backend — настройки по окружению:

```ts
typescript// auth.service.ts
addRefreshTokenToResponse(res: Response, refreshToken: string) {
    const isProd = this.configService.get('NODE_ENV') === 'production';

    res.cookie(this.REFRESH_TOKEN_NAME, refreshToken, {
httpOnly: true,
domain: isProd ? this.configService.get('COOKIE_DOMAIN') : undefined,
secure: isProd,
sameSite: isProd ? 'strict' : 'lax',
expires: expires_in,
});
}
```

```bash
# .env.development (бэкенд)
NODE_ENV=development
COOKIE_DOMAIN=localhost
```

```bash
# .env.production (бэкенд)
NODE_ENV=production
COOKIE_DOMAIN=.seriiburduja.org
```

### 4. package.json скрипты:

```json
json{
    "scripts": {
        "dev": "nuxt dev",
            "build": "nuxt build",
            "build:dev": "NODE_ENV=development nuxt build",
            "build:prod": "NODE_ENV=production nuxt build"
    }
}
```
