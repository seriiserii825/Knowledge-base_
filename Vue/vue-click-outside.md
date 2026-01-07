### useClickOutside composable

```typescript
// composables/useClickOutside.ts
export function useClickOutside(elementRef: Ref<HTMLElement | null>, callback: () => void) {
  function handler(event: PointerEvent) {
    if (elementRef.value && !elementRef.value.contains(event.target as Node)) {
      callback();
    }
  }

  onMounted(() => {
    document.addEventListener("pointerdown", handler);
  });

  onUnmounted(() => {
    document.removeEventListener("pointerdown", handler);
  });
}
```

### Example usage

```vue
<template>
  <div ref="menuRef" class="menu">Click outside this menu to close it.</div>
</template>
<script lang="ts" setup>
import { ref } from "vue";
import { useClickOutside } from "./composables/useClickOutside";
const menuRef = ref<HTMLElement | null>(null);
const closeMenu = () => {
  console.log("Menu closed");
};
useClickOutside(menuRef, closeMenu);
</script>
```
