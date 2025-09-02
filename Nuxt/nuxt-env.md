### nuxt.config.json

```
// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  runtimeConfig: {
    apiSecretKey: "NUXT_API_SECRET_KEY",
    public: {
      apiBase: "",
      localBaseUrl: "",
      apiBaseToken: "",
    },
  },
});
```

### .env

```
NUXT_PUBLIC_APIBASE=https://menu.altuofianco.com/api/v1
NUXT_PUBLIC_LOCALBASEURL=http://localhost:4174
NUXT_PUBLIC_APIBASETOKEN=my_token
```

### useAxios.ts a composable for Axios

```typescript
import axios from "axios";

export const useAxios = () => {
  const config = useRuntimeConfig();

  return axios.create({
    baseURL: config.public.apiBase,
    headers: {
      "Content-Type": "application/json",
      Accept: "application/json",
    },
  });
};
```
