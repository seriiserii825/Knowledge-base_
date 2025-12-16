### tailwind.config.js

```js
/** @type {import('tailwindcss').Config} */
export default {
  content: {
    files: [
      // all directories and extensions will correspond to your Nuxt config
      "srcDir/components/**/*.{vue,js,jsx,mjs,ts,tsx}",
      "srcDir/layouts/**/*.{vue,js,jsx,mjs,ts,tsx}",
      "srcDir/pages/**/*.{vue,js,jsx,mjs,ts,tsx}",
      "srcDir/plugins/**/*.{js,ts,mjs}",
      "srcDir/composables/**/*.{js,ts,mjs}",
      "srcDir/utils/**/*.{js,ts,mjs}",
      "srcDir/{A,a}pp.{vue,js,jsx,mjs,ts,tsx}",
      "srcDir/{E,e}rror.{vue,js,jsx,mjs,ts,tsx}",
      "srcDir/app.config.{js,ts,mjs}",
      "srcDir/app/spa-loading-template.html",
    ],
  },
  theme: {
    screens: {
      sm: { max: "480px" },
      md: { max: "768px" },
      lg: { max: "992px" },
    },
    container: {
      padding: "2rem",
      center: true,
    },
    extend: {},
  },
  plugins: [require("@tailwindcss/forms"), "prettier-plugin-tailwindcss"],
};
```

### container

```
@layer components {
  .container {
    @apply mx-auto px-4 max-w-[1000px];
  }
}
```
