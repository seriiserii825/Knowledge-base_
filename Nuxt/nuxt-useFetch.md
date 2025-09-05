# useFetch

## Reactive url

```vue
<script setup lang="ts">
import useApiUrl from "~/composables/useApiUrl";
import type { TPost } from "~/types/TPost";

const userId = ref(1);

const api_url = useApiUrl();

const { data, error, pending } = await useFetch<TPost[]>(`${api_url}/posts`, {
  method: "GET",
  // ofetch option: use `query` (NOT body) for ?userId=...
  query: computed(() => ({ userId: userId.value })),
  watch: [userId], // refetch when userId changes
  key: () => `posts-${userId.value}`, // per-user cache key
});
if (error.value) {
  console.error("Error fetching posts:", error.value);
}
</script>

<template>
  <div class="home-page">
    <h1>Home</h1>
    <input type="text" v-model="userId" placeholder="Enter User ID" />
    <p v-if="pending">Loading posts...</p>
    <ul v-else>
      <li v-for="post in data" :key="post.id">
        <h2>{{ post.title }}</h2>
        <p>{{ post.body }}</p>
        <hr />
      </li>
    </ul>
  </div>
</template>
```

## Call multiple times when input changed

```vue
<script setup lang="ts">
import useApiUrl from "~/composables/useApiUrl";
import type { TPost } from "~/types/TPost";

const userId = ref(1);

const api_url = useApiUrl();

async function fetchPosts() {
  const { data, error } = await useFetch<TPost[]>(`${api_url}/posts`, {
    method: "POST",
    key: () => `posts-${userId.value}`, // per-user cache key
  });
  if (error.value) {
    console.error("Error fetching posts:", error.value);
  }
}
</script>

<template>
  <div class="home-page">
    <h1>Home</h1>
    <input type="text" v-model="userId" placeholder="Enter User ID" />
    <button @click="fetchPosts">fetch posts</button>
  </div>
</template>
```

**to stop watching a ref, use `watch: false`**

or can use refresh

```vue

const { data, error, refresh } = await useFetch<TPost[]>(`${api_url}/posts`, {
  method: "POST",
  key: () => `posts-${userId.value}`, // per-user cache key
  immediate: false, // do not fetch immediately
  watch: false,
});
if (error.value) {
  console.error("Error fetching posts:", error.value);
}

async function fetchPosts() {
  refresh()
}
```
