### install packages

```bash
bun add -D @nuxt/eslint eslint eslint-plugin-vue
```

eslint.config.js

```js
// eslint.config.js
import withNuxt from "./.nuxt/eslint.config.mjs";

export default withNuxt({
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
    "vue/multi-word-component-names": "off",
  },
});
```

package.json lint script

```json

"lint": "eslint .",
"lint:fix": "eslint . --fix"
```
