# Nuxt callOnce Module

store

```ts
import { ref } from "vue";
import { defineStore } from "pinia";
export const useFavoritesStore = defineStore("favorites", () => {
  const favorites_ids = ref<number[]>([]);
  function setFavoritesIds(ids: number[]) {
    favorites_ids.value = ids;
  }
  function removeFromFavorites(id: number) {
    favorites_ids.value = favorites_ids.value.filter((favId) => favId !== id);
  }

  async function fetchFavorites() {
    try {
      const data = await $fetch<number[]>("/api/posts");
      console.log(data, "data");
    } catch (error) {
      console.error("Error fetching favorites:", error);
    }
  }
  return {
    favorites_ids,
    setFavoritesIds,
    removeFromFavorites,
    fetchFavorites,
  };
});
```

page

```vue
<script setup lang="ts">
import { useFavoritesStore } from "~/store/useFavoritesStore";

const favorites_store = useFavoritesStore();
await callOnce(favorites_store.fetchFavorites);
</script>
```
