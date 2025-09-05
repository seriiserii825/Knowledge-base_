# Nuxt useFetch with debounced Query Parameters

```vue
<script setup lang="ts">
import { useDebounceFn } from "@vueuse/core";
import type { TCategory } from "~/server/mock/data";
const route = useRoute();
const router = useRouter();

const selected = ref<string | null>((route.query.category as string) || null);
const search = ref((route.query.search as string) || "");

const { data: categories } = await useFetch<TCategory[]>("/api/categories");

const changeRoute = useDebounceFn((selected, search) => {
  router.replace({
    query: {
      category: selected.value,
      search: search.value || undefined,
    },
  });
}, 300);

watch([selected, search], () => {
  changeRoute(selected, search);
});

const query = computed(() => ({
  category: route.query.category || undefined,
  search: route.query.search || undefined,
}));

// posts filtered by category
const { data: filteredPosts } = await useFetch("/api/posts", {
  query,
  key: "posts-filter",
});
</script>

<template>
  <div>
    <select v-model="selected">
      <option :value="null">Categories</option>
      <option v-for="c in categories" :key="c.value" :value="c.value">{{ c.text }}</option>
    </select>

    <hr />

    <input v-model="search" placeholder="Search posts..." />

    <h3>Posts</h3>
    <ul>
      <li v-for="p in filteredPosts" :key="p.id">
        <strong>{{ p.title }}</strong>
        <div>{{ p.body }}</div>
        <small>Categories: {{ p.categories.map((c) => (c ? c.text : "")).join(", ") }}</small>
      </li>
    </ul>
  </div>
</template>
```
