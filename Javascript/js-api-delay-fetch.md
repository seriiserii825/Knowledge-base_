# Как добавить минимальную задержку к fetch-запросу

```ts
function minDelay(ms: number) {
  return new Promise((r) => setTimeout(r, ms));
}
```

```ts
const [res] = await Promise.all([
  fetch(url),
  minDelay(1200), // например, 800–1200 мс достаточно для UX
]);
```
