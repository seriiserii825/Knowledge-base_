### colors and fonts

base.scss

```scss
:root {
  --accent-light-color: #4a90ff;
  --accent-color: #2463eb;
  --accent-dark-color: #1a4bb8;
  --text-color: #333333;
}
```

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
      lg: { max: "992px" },
      md: { max: "768px" },
      sm: { max: "576px" },
    },
    container: {
      padding: "20px",
      center: true,
    },
    extend: {
      colors: {
        accent: {
          light: "var(--accent-color-light)", //use in html class "text-accent-light"
          DEFAULT: "var(--accent-color)", //use in html class "text-primary"
          dark: "var(--accent-color-dark)", //use in html class "text-accent-dark"
        },
        text: {
          DEFAULT: "rgb(var(--text-color) / <alpha-value>)", //use in html class "text-text"
        },
      },
      fontFamily: {
        sans: ["Roboto", "ui-sans-serif", "system-ui"], // use in html class "font-sans"
      },
    },
  },
  plugins: [require("@tailwindcss/forms"), "prettier-plugin-tailwindcss"],
};
```
