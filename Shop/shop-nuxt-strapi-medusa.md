# E-commerce на Nuxt + Medusa (+ Strapi) — мультиязычный магазин

Заметки по выбору стека для интернет-магазина с мультиязычностью (ro, ru, en) на своём VPS.

---

## 1. Можно ли сделать e-commerce на Strapi?

Да, но **Strapi — это CMS, а не e-commerce движок**.

- **i18n** — встроен в ядро (v5; в v4 был плагином). Локализация включается на content-type.
- Локализуемые и нелокализуемые поля: `title`, `description`, `slug` — переводятся; `price`, `sku`, `stock`, `images` — общие для всех языков.
- Draft/publish — отдельно для каждой локали.
- API: `?locale=ro`, `?locale=all`.

Что в Strapi придётся писать самому:

| Что | В Strapi |
|---|---|
| Каталог, категории, переводы | ✅ отлично |
| Варианты товара (размер/цвет) | ⚠️ руками через компоненты/relations |
| Корзина, checkout, оплата | ❌ кастомный API + Stripe/PayPal webhooks |
| Заказы, статусы, письма | ❌ свой content-type + lifecycle hooks |
| Остатки, резервирование | ❌ нужны транзакции |
| Мультивалютность, скидки, налоги, доставка | ❌ всё руками |

**Вывод:** для магазина лучше отдельный e-commerce движок (Medusa / Saleor), Strapi — только для контента.

---

## 2. Что бесплатно

| Что | Лицензия | Бесплатно? |
|---|---|---|
| Strapi | MIT | ✅ self-host (платно: Strapi Cloud, Enterprise — SSO, audit logs) |
| Medusa | MIT | ✅ self-host (платно: Medusa Cloud) |
| Saleor | BSD-3 | ✅ self-host (платно: Saleor Cloud) |
| Nuxt, `@nuxtjs/i18n` | MIT | ✅ |
| Meilisearch | MIT | ✅ self-host |
| Algolia | — | ⚠️ free tier с лимитами |
| Shopify | проприетарный | ❌ подписка + комиссии |
| Stripe | — | ⚠️ без абонплаты, % с транзакции (EU ~1.5% + €0.25). Проверить, поддерживает ли Stripe страну регистрации фирмы — иначе местный эквайринг/PayPal |

На своём VPS платишь только за VPS и комиссию платёжки.

### Цены Medusa Cloud ($29 / $99 / $299 / Enterprise)

Это **платный хостинг** от команды Medusa, не лицензия. Self-host — $0. «No GMV-tax» — Medusa не берёт % с продаж.

| Из тарифа Cloud | Аналог на своём VPS |
|---|---|
| Hosting, deploy from GitHub | Docker Compose + GitHub Actions |
| Automatic backups | `pg_dump` по cron вне VPS |
| Medusa Search | Meilisearch |
| Medusa Emails | notification module + SMTP / Resend / Brevo |
| Redis KV, cache, workers | свой Redis, `worker_mode` |
| Custom domains | Caddy + Let's Encrypt |
| Autoscaling, SLA, SSO, Audit Logs | ❌ нет (для небольшого магазина не нужно) |

---

## 3. Medusa vs Saleor

| | **Medusa** | **Saleor** |
|---|---|---|
| Бэкенд | TypeScript / Node.js | Python / Django |
| API | REST + `@medusajs/js-sdk` | только GraphQL |
| Расширение | модули, workflows, API-роуты прямо в коде | внешние Apps через webhooks |
| Мультиязычность | исторически слабо; в свежих v2 появились переводы — проверять версию | ✅ встроена, переводы в админке |
| Валюты/регионы | regions (валюта, налоги, доставка) | channels (валюта, цены, склады) |
| Склады | несколько | несколько, сильная сторона |
| Ресурсы | легче: Node + Postgres + Redis (~2 GB) | тяжелее: + Celery worker (~4 GB) |
| Для JS-разработчика | весь стек на TS | Python + GraphQL |

- **Saleor** — если нужны переводы из коробки без Strapi и устраивает GraphQL.
- **Medusa** — если стек на JS/TS (Nuxt), нужна кастомная логика, VPS небольшой.

---

## 4. Как работает Medusa

| Что | Где |
|---|---|
| Товары, категории, коллекции, цены, остатки | админка Medusa (`/app`) или импорт CSV |
| Корзина | **не в админке** — создаёт фронт (Nuxt) через Store API |
| Checkout | фронт: адрес → доставка → оплата → complete → заказ |
| Заказы, возвраты, обмены | админка |
| Ручной заказ (по телефону) | draft orders в админке |

### Вариативные товары

```
Product: "Футболка Basic"
├── Options:  Размер [S, M, L],  Цвет [Белый, Чёрный]
└── Variants:
    ├── S / Белый   → SKU TS-S-WH, €19, остаток 12
    ├── S / Чёрный  → SKU TS-S-BK, €19, остаток 0
    └── M / Белый   → SKU TS-M-WH, €21, остаток 5
```

У каждого **варианта**: SKU, штрихкод, вес, цены по валютам/регионам, price lists (распродажи, B2B), остатки по складам, allow backorder. **В корзину кладётся вариант**, не товар. Админка генерирует комбинации из опций.

Грабли:
- картинки на конкретный вариант (цвет) — исторически слабое место, обходят через `metadata` или Strapi;
- названия опций/значений («Размер», «Белый») тоже нужно переводить.

### Пример в Nuxt

```ts
import Medusa from '@medusajs/js-sdk'
const sdk = new Medusa({ baseUrl: 'https://api.shop.com', publishableKey: 'pk_...' })

const { product } = await sdk.store.product.retrieve(id, {
  region_id: regionId,
  fields: '*variants.calculated_price,+variants.inventory_quantity',
})

// выбранные опции → вариант
const variant = product.variants.find(v =>
  v.options.every(o => selected[o.option_id] === o.value)
)

const { cart } = await sdk.store.cart.create({ region_id: regionId })
await sdk.store.cart.createLineItem(cart.id, { variant_id: variant.id, quantity: 1 })
// cart.id → cookie
```

---

## 5. Зачем Strapi, если есть Medusa

Strapi нужен только для **контента, который не товар**, и если его правит не-программист.

| Задача | Medusa | Strapi |
|---|---|---|
| Блог, статьи | ❌ | ✅ |
| «О нас», «Доставка», FAQ | ❌ | ✅ |
| Баннеры, промо-блоки на главной | ❌ | ✅ dynamic zones |
| Длинные описания с таблицами размеров, видео | ⚠️ | ✅ |
| SEO-поля по языкам | ⚠️ metadata | ✅ |

**Рекомендация:** начать **без Strapi** — Nuxt + Medusa, статические страницы в `@nuxt/content` (`content/ro/about.md`, `content/ru/about.md`). Strapi добавить, когда появится блог/контент-менеджер.

---

## 6. Фронт на Nuxt

| Задача | Модуль |
|---|---|
| Мультиязычность | `@nuxtjs/i18n` — префиксы `/ro/ /ru/ /en/`, локализованные роуты, `hreflang` |
| Strapi | `@nuxtjs/strapi` или `$fetch` |
| Medusa | `@medusajs/js-sdk` (официальный стартер только на Next.js — витрину на Nuxt пишешь сам) |
| SEO | `@nuxtjs/seo` — sitemap по локалям, schema.org |
| Картинки | `@nuxt/image` |
| Поиск | Meilisearch |
| Статические страницы | `@nuxt/content` |

```ts
const { locale } = useI18n()
const { find } = useStrapi()
const { data } = await useAsyncData(`products-${locale.value}`, () =>
  find('products', { locale: locale.value, populate: '*' })
)
```

UI-строки («В корзину») — JSON-файлы `@nuxtjs/i18n`; контент — в бэкенде.

### Мультиязычность — грабли

- `slug` локализуемый, `hreflang`/alternate между версиями.
- **Валюта ≠ язык** — цену к локали не привязывать.
- Заказы не локализуются — хранить язык заказа в поле (для писем).
- Поиск — индекс на каждую локаль.

---

## 7. Деплой на свой VPS

| Стек | Минимум RAM | Комфортно |
|---|---|---|
| Medusa + Postgres + Redis | 2 GB | 4 GB |
| Strapi + Postgres | 2 GB | 4 GB |
| Medusa + Strapi + Nuxt | 4 GB | 8 GB |

Сборка (`nuxt build`, админки Strapi/Medusa) пикует по памяти — swap на маленьком VPS, либо собирать в CI.

```
VPS
├── Docker Compose
│   ├── postgres
│   ├── redis
│   ├── medusa   → api.shop.com (+ админка /app)
│   ├── strapi   → cms.shop.com (опционально)
│   └── nuxt     → shop.com   (node .output/server/index.mjs)
└── Caddy (reverse proxy + авто SSL)
```

- Бэкапы Postgres (`pg_dump` по cron) — вне VPS, обязательно.
- Nuxt SSR в рантайме ~100–200 MB.

---

## 8. Структура репозитория — монорепо

Для одного разработчика — монорепо вместо 3 отдельных репо:

```
shop/
├── apps/
│   ├── nuxt/
│   ├── medusa/
│   └── strapi/          # опционально
├── infra/
│   ├── docker-compose.yml
│   ├── Caddyfile
│   └── backup.sh
├── .github/workflows/   # отдельный workflow на app, фильтр paths: apps/<app>/**
└── .env.example
```

- Фича, затрагивающая несколько частей, — один коммит.
- Деплой раздельный через `paths:` в GitHub Actions.
- `node_modules` в каждой папке отдельно (pnpm workspaces могут конфликтовать со Strapi/Medusa).
- Разделить потом можно через `git subtree split`.

Отдельные репо имеют смысл, если разные команды/права доступа. Тогда нужен ещё 4-й — `shop-infra`.

### Создание проектов (заметки)

```bash
# Nuxt
npx create-nuxt@latest apps/nuxt --template minimal --packageManager npm --no-gitInit
cd apps/nuxt && npm i @nuxtjs/i18n @medusajs/js-sdk @medusajs/types

# Medusa — стартер (по умолчанию yarn; для npm удалить .yarn, yarn.lock, .yarnrc.yml)
git clone --depth 1 https://github.com/medusajs/medusa-starter-default.git apps/medusa
# .env: DATABASE_URL, REDIS_URL, STORE_CORS, ADMIN_CORS, AUTH_CORS, JWT_SECRET, COOKIE_SECRET

# Strapi
npx create-strapi@latest apps/strapi --non-interactive --skip-cloud --no-run --ts \
  --use-npm --no-example --no-git-init --dbclient=postgres \
  --dbhost=localhost --dbport=5432 --dbname=strapi --dbusername=shop --dbpassword=shop
```
