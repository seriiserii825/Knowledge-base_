### colors and fonts

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
      padding: "20px",
      center: true,
    },
    extend: {
      colors: {
        primary: {
          light: "#6D28D9", //use in html class "text-primary-light"
          DEFAULT: "#5B21B6", //use in html class "text-primary"
          dark: "#4C1D95", //use in html class "text-primary-dark"
        },
        secondary: {
          light: "#3B82F6", //use in html class "text-secondary-light"
          DEFAULT: "#2563EB", //use in html class "text-secondary"
          dark: "#1D4ED8", //use in html class "text-secondary-dark"
        },
      },
      fontFamily: {
        sans: ["Inter", "ui-sans-serif", "system-ui"], // use in html class "font-sans"
        serif: ["Merriweather", "ui-serif", "Georgia"], // use in html class "font-serif"
      },
    },
  },
  plugins: [require("@tailwindcss/forms"), "prettier-plugin-tailwindcss"],
};
```
