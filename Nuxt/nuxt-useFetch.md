### 1. Page component — await data before render

```vue
<script setup lang="ts">
// Navigation is BLOCKED until this resolves
const { data: posts } = await useFetch("/api/posts");
</script>

<template>
  <div>
    <PostCard v-for="post in posts" :key="post.id" :post="post" />
  </div>
</template>
```

### 2. Add a loading bar between navigations (in app.vue)

```vue
<template>
  <NuxtLoadingIndicator />
  <NuxtLayout>
    <NuxtPage />
  </NuxtLayout>
</template>
```

### 3. Lazy / non-blocking fetch — don't await

```vue
<script setup lang="ts">
// Navigation proceeds immediately, data loads in background
const { data, status } = useFetch("/api/posts");
</script>

<template>
  <div v-if="status === 'pending'">Loading...</div>
  <PostCard v-else v-for="post in data" :key="post.id" />
</template>
```

### 4. <Suspense> with a fallback for child components

```vue
<!-- parent.vue -->
<template>
  <Suspense>
    <template #default>
      <AsyncChildComponent />
      <!-- has await useFetch inside -->
    </template>
    <template #fallback>
      <div>Loading...</div>
      <!-- shown while child resolves -->
    </template>
  </Suspense>
</template>
```

### Your layout — one small improvement

```vue
<template>
  <div>
    <UIHeader v-if="data" :menu-items="data" />
    <div class="min-h-[60vh]">
      <slot />
      <!-- pages with await useFetch are auto-suspended here -->
    </div>
    <UIFooter />
  </div>
</template>
```

Since you await useFetch in the layout itself, the entire layout blocks until the menu data is ready — which is fine. But if you want the layout shell to appear immediately while only the <slot> content suspends, remove the await:

```vue
const { data, status } = useFetch<IMenuItem[]>(...) // no await
```
