# $fetch

- need to use try catch
- for ssr and client side

```js
try {
  const api_url = useApiUrl();
  posts.value = await $fetch(`${api_url}/posts`);
  console.log(posts.value, "posts.value");
} catch (error) {
  console.log(error, "error");
}
```
