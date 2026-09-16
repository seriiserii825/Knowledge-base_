# WP REST API auth key

Protecting custom REST routes registered in a theme's `api/*.php` files with a shared secret key, checked via `permission_callback`. No plugin, no nonces — just a static key compared with `hash_equals`.

Reference implementation: `ag-cairepro` theme (`app/public/wp-content/themes/ag-cairepro`), see its `readme.md` / `CLAUDE.md` for the project-specific version of this.

## Where the key lives

Same var name, same value, in two independent places — nothing reads `.env` at PHP runtime, so they must be kept in sync manually:

- `wp-config.php` — a plain literal constant (same style as other hardcoded secrets there, e.g. `FLUENTMAIL_SMTP_PASSWORD`):
  ```php
  define( 'WP_REST_API_KEY', '...' );
  ```
- theme's `.env`:
  ```
  WP_REST_API_KEY=...
  ```

Generate the value with:
```bash
openssl rand -hex 32
```

## Shared permission_callback

`api/api-key-auth.php`:
```php
<?php
if (!defined('ABSPATH')) exit;

function agCaireproVerifyApiKey(WP_REST_Request $request)
{
  if (!defined('WP_REST_API_KEY') || empty(WP_REST_API_KEY)) {
    return new WP_Error('api_key_not_configured', 'API key is not configured.', ['status' => 500]);
  }

  $provided_key = $request->get_header('x-api-key');

  if (!$provided_key || !hash_equals(WP_REST_API_KEY, $provided_key)) {
    return new WP_Error('invalid_api_key', 'Invalid or missing API key.', ['status' => 401]);
  }

  return true;
}
```

Require it before any other `api/*.php` file in `functions.php`, so the function exists when the others register their routes:
```php
require_once __DIR__ . '/api/api-key-auth.php';
require_once __DIR__ . '/api/projects-filter-api.php';
require_once __DIR__ . '/api/persons-filter-api.php';
// ...
```

Every `register_rest_route` call then uses this instead of `'__return_true'`:
```php
'permission_callback' => 'agCaireproVerifyApiKey',
```

## Frontend (Vue + Vite): sending the key

Vite only exposes `VITE_`-prefixed vars from `.env` to `import.meta.env` by default. To reuse the exact same var name (`WP_REST_API_KEY`) without adding a `VITE_`-prefixed duplicate, whitelist it explicitly via `envPrefix` in `vite.config.js`:
```js
export default defineConfig({
  envPrefix: ['VITE_', 'WP_REST_API_KEY'],
  // ...
});
```

`vite-env.d.ts` at the theme root (add it to `tsconfig.json`'s `include` too):
```ts
interface ImportMetaEnv {
  readonly WP_REST_API_KEY: string;
}
interface ImportMeta {
  readonly env: ImportMetaEnv;
}
```

Shared axios instance attaches the header on every request, so every view using it is covered automatically:
```ts
export const axiosInstance = axios.create({
  baseURL: `${url}wp-json`,
  headers: {
    'X-Api-Key': import.meta.env.WP_REST_API_KEY
  }
});
```

## Verify

```bash
curl -s -o /dev/null -w "%{http_code}\n" https://site.test/wp-json/site/v1/get-admin-users                          # 401 — no key
curl -s -o /dev/null -w "%{http_code}\n" -H "X-Api-Key: wrong" https://site.test/wp-json/site/v1/get-admin-users    # 401 — wrong key
curl -s -o /dev/null -w "%{http_code}\n" -H "X-Api-Key: <real key>" https://site.test/wp-json/site/v1/get-admin-users # 200
```

Quick way to check the constant loaded correctly (WP-CLI):
```bash
wp eval 'echo WP_REST_API_KEY;'
```

## Rotating the key

1. `openssl rand -hex 32`
2. set the new value in both `.env`'s `WP_REST_API_KEY=` and `wp-config.php`'s `define('WP_REST_API_KEY', ...)`
3. `yarn build` — re-embeds the new key into the frontend bundle
4. if `.env` is gpg-encrypted (see `Gpg/` notes and the repo's `.gpgrc`), re-encrypt after editing

## Gotchas

- Forgetting to wire a new `api/*.php` route's `permission_callback` to `agCaireproVerifyApiKey` leaves it wide open — `__return_true` was the old default, never use it for a real endpoint.
- `import.meta.env.WP_REST_API_KEY` needs the `envPrefix` override in `vite.config.js` — without it Vite silently returns `undefined` for any var not prefixed `VITE_`, and the header goes out empty (endpoint then always 401s).
- The key still ends up visible in the built JS bundle (`dist/js/main.*.js`) — this only blocks casual/direct hits on the REST endpoints, it's not a secret from anyone reading the frontend's own network requests.
