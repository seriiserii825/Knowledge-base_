<script setup lang="ts">
  import { defineProps, watch } from "vue";

  const { count = 0, label = "Count" } = defineProps<{
    count?: number;
    label?: string;
  }>();

  watch(
    () => count,
    (newCount) => {
      console.log(`Count changed to: ${newCount}`);
    },
  );
</script>
<template>
  <div>
    <p>{{ label }}: {{ count }}</p>
  </div>
</template>
