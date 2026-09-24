import { type Ref, onBeforeUnmount, ref, watch } from "vue";

/**
 * Debounced copy of a ref.
 *
 * Returns a new ref that follows `source`, but updates only after `delay` ms
 * have passed without `source` changing. Typical use: search inputs, where
 * the input should react instantly (v-model on `source`), but filtering /
 * API requests should run only when the user stops typing (use the debounced ref).
 *
 * @param source  ref to watch (e.g. the v-model of an input)
 * @param delay   wait time in ms after the last change (default 300)
 * @returns       ref with the debounced value (initially equals source.value)
 *
 * Notes:
 * - Must be called inside setup() / <script setup> — uses onBeforeUnmount
 *   to clear a pending timer when the component is destroyed.
 * - Vue 3.
 */
export default function useDebounce<T>(source: Ref<T>, delay = 300): Ref<T> {
  const debounced = ref(source.value) as Ref<T>;
  let timer: ReturnType<typeof setTimeout> | undefined;

  watch(source, (newValue) => {
    clearTimeout(timer);
    timer = setTimeout(() => {
      debounced.value = newValue;
    }, delay);
  });

  onBeforeUnmount(() => clearTimeout(timer));

  return debounced;
}

/*
USAGE EXAMPLE — local filtering of a list

<script setup lang="ts">
import { computed, ref } from 'vue';
import useDebounce from '@/composables/useDebounce';

const value = ref('');
const debouncedValue = useDebounce(value, 300);

const filteredProducts = computed(() => {
  const query = debouncedValue.value.trim().toLowerCase();
  if (!query) return products.value;
  return products.value.filter((p) => p.title.toLowerCase().includes(query));
});
</script>

<template>
  <input v-model="value" type="text" />
  <ul v-if="debouncedValue && filteredProducts.length">
    <li v-for="p in filteredProducts" :key="p.id">{{ p.title }}</li>
  </ul>
</template>


USAGE EXAMPLE — API request after the user stops typing

const search = ref('');
const debouncedSearch = useDebounce(search, 500);

watch(debouncedSearch, async (query) => {
  if (!query) return;
  results.value = await fetch(`/wp-json/api/search?s=${encodeURIComponent(query)}`)
    .then((r) => r.json());
});


Used in: lc-manitoba theme — src/vue/composables/useDebounce.ts,
         modules/search-products/SearchProducts.vue
*/
