# nuxt fetch plugin

/plugins/fetch.ts

```typescript
export default defineNuxtPlugin({
  name: "fetch",
  parallel: true,
  setup(nuxtApp) {
    const api = $fetch.create({
      baseURL: "https://jsonplaceholder.typicode.com",
      onRequest({ request, options, error }) {
        options.headers.set("Content-type", "application/json");
        options.headers.set("Accept", "application/json");
        options.headers.set("Authorization", "Bearer " + "mynewtoken");
      },
      async onResponseError({ response }) {
        if (response.status === 401) {
          await nuxtApp.runWithContext(() => navigateTo("/login"));
        }
      },
    });

    // Expose to useNuxtApp().$api
    return {
      provide: {
        api,
      },
    };
  },
});
```

composables/useAPI.ts

```typescript
import type { UseFetchOptions } from "nuxt/app";

export function useAPI<T>(url: string | (() => string), options?: UseFetchOptions<T>) {
  return useFetch(url, {
    ...options,
    $fetch: useNuxtApp().$api as typeof $fetch,
  });
}
```

pages/index.vue

```vue
<script setup lang="ts">
import { useAPI } from "~/composables/useAPI";

const response = await useAPI("/posts");
console.log(response, "response");

const { $api } = useNuxtApp();

function getPosts() {
  $api("/posts").then((res) => {
    console.log(res, "res from button");
  });
}
</script>
```
