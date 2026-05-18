import { onBeforeUnmount, onMounted, type Ref } from "vue";

export default function useDetectOutsideClick(
  component: Ref<HTMLElement | null>,
  callback: () => void,
) {
  if (!component) return;

  const listener = (event: MouseEvent) => {
    const target = event.target as Node | null;
    const element = component.value;

    if (!element || !target) return;

    // click inside component → do nothing
    if (target === element || event.composedPath().includes(element)) {
      return;
    }

    // click outside component
    callback();
  };

  onMounted(() => {
    window.addEventListener("click", listener);
  });

  onBeforeUnmount(() => {
    window.removeEventListener("click", listener);
  });

  return { listener };
}

/*
USAGE EXAMPLE

<script setup lang="ts">
import { ref } from 'vue';
import useDetectOutsideClick from '@/composables/useDetectOutsideClick';

const isOpen = ref(true);
const dropdown = ref<HTMLElement | null>(null);

useDetectOutsideClick(dropdown, () => {
  isOpen.value = false;
});
</script>

<template>
  <div
    v-if="isOpen"
    ref="dropdown"
    class="dropdown"
  >
    Dropdown content
  </div>
</template>
*/
