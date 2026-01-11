export function useDebounce<T extends (...args: any[]) => void>(fn: T, delay = 500) {
  const timeout = ref<NodeJS.Timeout | null>(null);

  const debouncedFn = (...args: Parameters<T>) => {
    if (timeout.value) {
      clearTimeout(timeout.value);
    }

    timeout.value = setTimeout(() => {
      fn(...args);
    }, delay);
  };

  const cancel = () => {
    if (timeout.value) {
      clearTimeout(timeout.value);
      timeout.value = null;
    }
  };

  onUnmounted(cancel);

  return { debouncedFn, cancel };
}

/// use
const page = ref(1);
const search = ref("");

const { debouncedFn: debouncedSearch } = useDebounce(() => {
  page.value = 1;
  refetch();
}, 500);

watch(search, () => {
  debouncedSearch();
});
