// hooks/useDebounce.ts
import { useEffect, useState } from "react";

export function useDebounce<T>(value: T, delay = 500): T {
  const [debouncedValue, setDebouncedValue] = useState(value);

  useEffect(() => {
    const timer = setTimeout(() => {
      setDebouncedValue(value);
    }, delay);

    // Очистка — очень важно!
    return () => clearTimeout(timer);
  }, [value, delay]);

  return debouncedValue;
}

// usage

const [search, setSearch] = useState("");

const debouncedSearch = useDebounce(search, 500);

useEffect(() => {
  // Здесь можно выполнять запрос к API с использованием debouncedSearch
  console.log("Debounced Search:", debouncedSearch);
}, [debouncedSearch]);
