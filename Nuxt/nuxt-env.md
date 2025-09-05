# Nuxt 3 Environment Variables Example

```
// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  runtimeConfig: {
   token: "", - private variable just for server side
    public: { // public variable for client and server side
      apiBase: "",
    },
  },
});
```

## .env

```
NUXT_TOKEN=my_token
NUXT_PUBLIC_APIBASE=https://menu.altuofianco.com/api/v1
PORT=3001 // default is 3000
```

## useAxios.ts a composable for Axios

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
