<script setup lang="ts">
const {error} = defineProps<{
  error: NuxtError
}>()
</script>

<template>
  <h1>{{ error.statusCode }}</h1>
</template>
