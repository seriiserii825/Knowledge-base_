# Alias `@/...` вместо относительных путей `../../../`

## Vite (Vue и любой другой vite-проект)

`vite.config.js`:

```js
import path from "path";

export default defineConfig({
  resolve: {
    alias: {
      "@": path.resolve(__dirname, "."), // или './src', смотря что нужно
    },
  },
});
```

Если в проекте TS/`vue-tsc` — тот же alias нужно продублировать в `tsconfig.json`, иначе TS-сервер будет ругаться на импорт, даже если сборка Vite работает:

```json
{
  "compilerOptions": {
    "paths": {
      "@/*": ["./src/*"]
    }
  }
}
```

## Angular (CLI / esbuild-сборка)

Только `tsconfig.json` → `compilerOptions.paths`. `angular.json` трогать не нужно — `@angular/build` и Angular Language Service читают `paths` сами.

```json
{
  "compilerOptions": {
    "paths": {
      "@/*": ["./src/*"]
    }
  }
}
```

**Без `baseUrl`** — начиная с TS 4.1+ он не обязателен, а в новых версиях TS вообще deprecated (`TS5101`). Без `baseUrl` пути в `paths` резолвятся относительно самого `tsconfig.json`, но обязаны начинаться с `./` (`TS5090: Non-relative paths are not allowed when 'baseUrl' is not set`).

## Обычный TS без бандлера (node, ts-node, tsx)

`paths` в `tsconfig.json` решает алиасы только для тайпчекинга (IDE, `tsc --noEmit`). В рантайме (`node`, `ts-node`, скомпилированный `tsc`) алиасы `paths` **сами по себе не резолвятся** — нужен либо бандлер (esbuild/webpack/vite), либо доп. пакет:

- `ts-node` / `tsx` в dev — `tsconfig-paths` (`node -r tsconfig-paths/register ...`)
- после `tsc`-компиляции в JS — `tsc-alias` (переписывает алиасы на relative-пути в выходных `.js`)

Иначе получится сюрприз "в IDE работает, при запуске падает `Cannot find module '@/...'`".
