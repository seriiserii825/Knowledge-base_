# useAsyncData

```ts
const { data, error, refresh } = await useAsyncData("posts", () =>
  Promise.all([
    $fetch<TPost[]>(`${api_url}/posts?userId=${userId.value}`),
    $fetch<TPost[]>(`${api_url}/posts?userId=${userId.value}`),
  ])
);
```
