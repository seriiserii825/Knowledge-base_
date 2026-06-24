# ESLint + Stylelint + Prettier setup

Инструкция по настройке линтинга и форматирования для Vite + React + TS + SCSS проекта.
Включает сортировку импортов (по слоям FSD) и сортировку CSS-свойств.

## 1. Установка зависимостей

```bash
bun add -D eslint @eslint/js typescript-eslint eslint-plugin-react-hooks eslint-plugin-react-refresh globals eslint-config-prettier
bun add -D eslint-plugin-react
bun add -D stylelint stylelint-config-standard stylelint-config-standard-scss stylelint-order
bun add -D prettier @trivago/prettier-plugin-sort-imports
```

## 2. ESLint — `eslint.config.js`

Flat config. `eslint-config-prettier` отключает стилевые правила, которые конфликтуют с Prettier.

`eslint-plugin-react` ставится **только** за правилом `react/jsx-sort-props` — аналог
`vue/attributes-order` из Vue-проектов (в JSX нет директив типа `v-if`/`v-for`, поэтому
вместо семантических категорий — алфавитная сортировка с группировкой: shorthand-пропсы
(`disabled`) → остальные по алфавиту → события (`onClick` и т.п.) в конец). Не подключай
`react.configs.flat.recommended` целиком — на момент написания (`eslint-plugin-react@7.37.5`,
`eslint@10.5.0`) recommended-набор тащит правила (`react/display-name` и т.п.), которые
дёргают `context.getFilename()` — этого метода в ESLint 10 уже нет, и линт крашится.
Дождись, пока `eslint-plugin-react` явно объявит поддержку ESLint 10 в peerDependencies,
либо используй точечные правила, как ниже.

```js
import js from "@eslint/js";
import eslintConfigPrettier from "eslint-config-prettier";
import react from "eslint-plugin-react";
import reactHooks from "eslint-plugin-react-hooks";
import reactRefresh from "eslint-plugin-react-refresh";
import { defineConfig, globalIgnores } from "eslint/config";
import globals from "globals";
import tseslint from "typescript-eslint";

export default defineConfig([
  globalIgnores(["dist"]),
  {
    files: ["**/*.{ts,tsx}"],
    plugins: {
      react,
    },
    extends: [
      js.configs.recommended,
      tseslint.configs.recommended,
      reactHooks.configs.flat.recommended,
      reactRefresh.configs.vite,
      eslintConfigPrettier,
    ],
    languageOptions: {
      globals: globals.browser,
    },
    rules: {
      "@typescript-eslint/no-unused-vars": ["error", { argsIgnorePattern: "^_" }],
      "react/jsx-sort-props": [
        "error",
        {
          callbacksLast: true,
          shorthandFirst: true,
          reservedFirst: true,
          noSortAlphabetically: false,
        },
      ],
    },
  },
]);
```

## 3. Prettier — `.prettierrc.json`

Сортировка импортов через `@trivago/prettier-plugin-sort-imports`. Порядок групп —
под Feature-Sliced Design: внешние пакеты → `app` → `pages` → `widgets` → `features` →
`entities` → `shared` → относительные импорты. Если алиасы в проекте другие (не `@/*`),
поправь regex под них.

```json
{
  "semi": true,
  "singleQuote": false,
  "trailingComma": "all",
  "printWidth": 100,
  "tabWidth": 2,
  "plugins": ["@trivago/prettier-plugin-sort-imports"],
  "importOrder": [
    "<THIRD_PARTY_MODULES>",
    "^@/app/(.*)$",
    "^@/pages/(.*)$",
    "^@/widgets/(.*)$",
    "^@/features/(.*)$",
    "^@/entities/(.*)$",
    "^@/shared/(.*)$",
    "^[./]"
  ],
  "importOrderSeparation": true,
  "importOrderSortSpecifiers": true
}
```

`.prettierignore`:

```
dist
node_modules
```

## 4. Stylelint — `.stylelintrc.json`

`stylelint-order` сортирует CSS-свойства внутри правила в логическом порядке
(позиционирование → flex/layout → размеры → типографика → цвет/фон → border → эффекты).
Свойства, не попавшие в список, уходят в конец по алфавиту (`unspecified: bottomAlphabetical`).

Override `selector-class-pattern` для `*.module.scss` разрешает camelCase — это нужно
для CSS Modules, чтобы в JS/TS можно было писать `styles.fullWidth`, а не `styles["full-width"]`.

```json
{
  "plugins": ["stylelint-order"],
  "extends": ["stylelint-config-standard", "stylelint-config-standard-scss"],
  "overrides": [
    {
      "files": ["**/*.module.scss"],
      "rules": {
        "selector-class-pattern": "^[a-z][a-zA-Z0-9]*$"
      }
    }
  ],
  "rules": {
    "order/properties-order": [
      [
        "content",
        "position",
        "top",
        "left",
        "right",
        "bottom",
        "display",
        "justify-content",
        "align-items",
        "flex-direction",
        "flex-wrap",
        "flex-grow",
        "flex-shrink",
        "flex-basis",
        "flex",
        "align-content",
        "align-self",
        "order",
        "gap",
        "margin",
        "margin-top",
        "margin-right",
        "margin-bottom",
        "margin-left",
        "padding",
        "padding-top",
        "padding-right",
        "padding-bottom",
        "padding-left",
        "width",
        "max-width",
        "min-width",
        "height",
        "max-height",
        "min-height",
        "font-family",
        "font-size",
        "font-weight",
        "line-height",
        "letter-spacing",
        "text-align",
        "text-transform",
        "color",
        "background",
        "background-color",
        "background-image",
        "background-size",
        "background-position",
        "background-repeat",
        "background-attachment",
        "border",
        "border-width",
        "border-style",
        "border-color",
        "border-top",
        "border-top-width",
        "border-top-style",
        "border-top-color",
        "border-right",
        "border-right-width",
        "border-right-style",
        "border-right-color",
        "border-bottom",
        "border-bottom-width",
        "border-bottom-style",
        "border-bottom-color",
        "border-left",
        "border-left-width",
        "border-left-style",
        "border-left-color",
        "border-radius",
        "box-shadow",
        "opacity",
        "transform",
        "transition",
        "overflow",
        "overflow-x",
        "overflow-y",
        "z-index"
      ],
      {
        "unspecified": "bottomAlphabetical"
      }
    ],
    "order/order": [
      "custom-properties",
      "declarations",
      { "type": "at-rule", "name": "include" },
      "rules"
    ]
  }
}
```

Если в проекте есть глобальные SCSS-файлы с пустыми строками между CSS-переменными
для визуальной группировки — по умолчанию `stylelint-config-standard` это запрещает
(`custom-property-empty-line-before: "never"`). Если такая группировка нужна, либо
не используй пустые строки между `--переменными`, либо добавь override на конкретный файл.

## 5. Скрипты — `package.json`

```json
{
  "scripts": {
    "lint": "eslint . && stylelint '**/*.{css,scss}' && prettier --check .",
    "lint:fix": "eslint . --fix && stylelint '**/*.{css,scss}' --fix && prettier --write .",
    "format": "prettier --write ."
  }
}
```

## 6. Применение

```bash
bun run lint        # проверка без изменений
bun run lint:fix     # автофикс + пересортировка импортов/свойств/форматирования
```

## 7. Интеграция с редактором (Neovim / VS Code)

Чтобы автоформатирование при сохранении совпадало с `lint:fix`, форматтер в редакторе
должен запускать те же три шага в том же порядке: `eslint --fix` → `stylelint --fix` →
`prettier --write`. Если используется отдельный LSP-форматтер (например, нативный
`prettier`/`eslint` LSP без `--fix` для stylelint), сортировка SCSS-свойств не будет
применяться при сохранении — её нужно гонять отдельно через `stylelint --fix` (хук
pre-commit или ручной запуск `lint:fix`).
