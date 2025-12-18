### Installation

```bash
bun add @fortawesome/fontawesome-svg-core @fortawesome/free-solid-svg-icons @fortawesome/free-brands-svg-icons @fortawesome/vue-fontawesome@latest-3
```

### Create Plugin

Create plugins/fontawesome.ts:

```ts
import { library, config } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { fas } from "@fortawesome/free-solid-svg-icons";
import { fab } from "@fortawesome/free-brands-svg-icons";

// This is important, we are going to let Nuxt worry about the CSS
config.autoAddCss = false;

// Add all icons to the library
library.add(fas, fab);

export default defineNuxtPlugin((nuxtApp) => {
  nuxtApp.vueApp.component("FontAwesomeIcon", FontAwesomeIcon);
});
```

### Update nuxt.config.ts

```ts
export default defineNuxtConfig({
  modules: ["@nuxtjs/tailwindcss", "@pinia/nuxt"],
  css: ["@fortawesome/fontawesome-svg-core/styles.css"],
});
```

### usage

copy from https://fontawesome.com/v6/docs/web/use-with/vue/add-icons

```vue
<font-awesome-icon icon="fa-solid fa-arrow-right-from-bracket" />
```
