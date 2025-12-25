### install dependencies

```bash
bun add -D eslint eslint-plugin-vue @typescript-eslint/parser @typescript-eslint/eslint-plugin typescript-eslint
```

### eslint.config.js

```js
import pluginVue from "eslint-plugin-vue";
import tseslint from "typescript-eslint";
import vueParser from "vue-eslint-parser";

export default [
  ...tseslint.configs.recommended,
  ...pluginVue.configs["flat/recommended"],
  {
    files: ["**/*.vue"],
    languageOptions: {
      parser: vueParser,
      parserOptions: {
        parser: tseslint.parser,
        sourceType: "module",
      },
    },
  },
  {
    files: ["**/*.ts", "**/*.tsx", "**/*.vue"],
    rules: {
      "vue/attributes-order": [
        "error",
        {
          order: [
            "DEFINITION",
            "LIST_RENDERING",
            "CONDITIONALS",
            "RENDER_MODIFIERS",
            "GLOBAL",
            "UNIQUE",
            "SLOT",
            "TWO_WAY_BINDING",
            "OTHER_DIRECTIVES",
            "OTHER_ATTR",
            "EVENTS",
            "CONTENT",
          ],
          alphabetical: false,
        },
      ],
      "vue/html-self-closing": [
        "error",
        {
          html: {
            void: "always",
            normal: "never",
            component: "always",
          },
          svg: "always",
          math: "always",
        },
      ],
      "vue/multi-word-component-names": "off",
    },
  },
  {
    ignores: ["node_modules", "dist", "vendor", "*.php", "**/*.js"],
  },
];
```

### package json add type module and scripts

```json
{
  "type": "module",
  "lint": "eslint .",
  "lint:fix": "eslint . --fix"
}
```
