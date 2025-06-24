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

### useAxios.ts a composable for Axios

```typescript
// composables/useAxios.ts
import axios from "axios";

export const useAxios = () => {
  const config = useRuntimeConfig();

  return axios.create({
    baseURL: config.public.api_base,
    headers: {
      "Content-Type": "application/json",
      Accept: "application/json",
      Authkey: config.public.auth_key,
      userToken: config.public.user_token,
    },
  });
};
```

## index.vue

```
const axiosInstance = useAxios();
const data = await axiosInstance.get(`/property?id_property=${property_id.value}`);
```
