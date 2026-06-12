<script setup lang="ts">
  import { ref } from "vue";

  interface Option {
    id: number;
    label: string;
  }

  interface Props {
    options: Option[];
  }

  defineProps<Props>();

  const emit = defineEmits<{
    (e: "select", option: Option): void;
  }>();

  const isOpen = ref(false);
  const activeIndex = ref(-1);

  function selectOption(option: Option) {
    emit("select", option);

    isOpen.value = false;
    activeIndex.value = -1;
  }

  function onKeydown(event: KeyboardEvent, options: Option[]) {
    if (!options.length) return;

    if (event.key === "ArrowDown") {
      event.preventDefault();

      isOpen.value = true;
      activeIndex.value = (activeIndex.value + 1) % options.length;
    }

    if (event.key === "ArrowUp") {
      event.preventDefault();

      isOpen.value = true;
      activeIndex.value = activeIndex.value <= 0 ? options.length - 1 : activeIndex.value - 1;
    }

    if (event.key === "Enter" && activeIndex.value >= 0) {
      event.preventDefault();

      selectOption(options[activeIndex.value]);
    }

    if (event.key === "Escape") {
      isOpen.value = false;
      activeIndex.value = -1;
    }
  }
</script>

<template>
  <div class="keyboard-select" tabindex="0" @keydown="onKeydown($event, options)">
    <button type="button" class="keyboard-select__button" @click="isOpen = !isOpen">
      Select option
    </button>

    <ul v-if="isOpen" class="keyboard-select__list">
      <li
        v-for="(option, index) in options"
        :key="option.id"
        class="keyboard-select__item"
        :class="{ 'is-active': index === activeIndex }"
        @click="selectOption(option)"
      >
        {{ option.label }}
      </li>
    </ul>
  </div>
</template>
