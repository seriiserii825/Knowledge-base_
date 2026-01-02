### install packages

```bash
bun add -D @trivago/prettier-plugin-sort-imports
```

### .prettierc

```json
{
  "plugins": ["@trivago/prettier-plugin-sort-imports", "prettier-plugin-tailwindcss"],
  "vueIndentScriptAndStyle": true,
  "singleQuote": true,
  "semi": false,
  "tabWidth": 2,
  "trailingComma": "es5",
  "importOrder": [
    "^vue$",
    "^nuxt",
    "^@nuxt/(.*)$",
    "^#app",
    "^#imports",
    "^@/composables/(.*)$",
    "^@/utils/(.*)$",
    "^@/types/(.*)$",
    "^@/stores/(.*)$",
    "^@/components/(.*)$",
    "^@/layouts/(.*)$",
    "^@/pages/(.*)$",
    "^@/(.*)$",
    "^~/(.*)$",
    "^[./]"
  ],
  "importOrderSeparation": true,
  "importOrderSortSpecifiers": true
}
```
