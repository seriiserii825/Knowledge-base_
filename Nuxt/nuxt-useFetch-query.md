# Nuxt useFetch with Query Parameters

```vue
<script setup lang="ts">
import type { TCategory } from "~/server/mock/data";
const route = useRoute();
const router = useRouter();

const selected = ref<string>(route.query.category as string || null);

const { data: categories } = await useFetch<TCategory[]>("/api/categories");

watch(selected, () => {
  router.replace({query: { category: selected.value }});
});

const query = computed(() => ({
  category: route.query.category || undefined,
}));

// posts filtered by category
const { data: filteredPosts } = await useFetch("/api/posts", {
  query,
  key: 'posts-filter'
});
</script>

<template>
  <div>
    <select v-model="selected">
      <option :value="null">Categories</option>
      <option v-for="c in categories" :key="c.value" :value="c.value">{{ c.text }}</option>
    </select>

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
