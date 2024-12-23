### nuxt.config.json

```
// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: "2024-11-01",
  devtools: { enabled: true },
  css: ["~/assets/scss/my.scss"],
  modules: ["@pinia/nuxt", "@nuxt/image"],
  runtimeConfig: {
    apiSecretKey: "NUXT_API_SECRET_KEY",
    public: {
      apiBase: process.env.NUXT_PUBLIC_API_BASE,
      localBaseUrl: process.env.NUXT_PUBLIC_LOCAL_BASE_URL,
      apiBaseToken: process.env.NUXT_PUBLIC_API_BASE_TOKEN,
    },
  },
  vite: {
    server: {
      hmr: {
        overlay: false,
      },
    },
  },
  devServer: {
    port: 4174,
  },
  app: {
    head: {
      charset: "utf-8",
      viewport: "width=device-width, initial-scale=1",
    },
  },
});
```

### .env

```
NUXT_PUBLIC_API_BASE=https://menu.altuofianco.com/api/v1
NUXT_PUBLIC_LOCAL_BASE_URL=http://localhost:4174
NUXT_PUBLIC_API_BASE_TOKEN=my_token
```

## index.vue

```
const runtimeConfig = useRuntimeConfig();
const apiBase = runtimeConfig.public.apiBase;
console.log("apiBase", apiBase);
const localBaseUrl = runtimeConfig.public.localBaseUrl;
console.log("localBaseUrl", localBaseUrl);
const apiBaseToken = runtimeConfig.public.apiBaseToken;
console.log("apiBaseToken", apiBaseToken);
```
