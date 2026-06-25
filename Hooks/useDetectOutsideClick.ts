import { type Ref, onBeforeUnmount, onMounted } from "vue";

export default function useDetectOutsideClick(
  component: Ref<HTMLElement | null>,
  clicked_component: Ref<HTMLElement | null>,
  callback: () => void,
) {
  if (!component || !clicked_component) return;

  const listener = (event: MouseEvent) => {
    const target = event.target as Node | null;
    const element = component.value;

    if (!element || !target) return;
    const is_clicked_component = clicked_component.value?.contains(target);
    if (is_clicked_component) {
      return;
    }

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

useDetectOutsideClick(dropdown, toggle_btn, () => {
  isOpen.value = false;
});
</script>

<template>
    <button ref="toggle_btn" class="share-estate__icon" @click="toggleOpen">
      <IconShare />
    </button>
  <div
    v-if="isOpen"
    ref="dropdown"
    class="dropdown"
  >
    Dropdown content
  </div>
</template>
*/
