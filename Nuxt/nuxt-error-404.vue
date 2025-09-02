<script setup lang="ts">
import type {NuxtError} from '#app';

const {error} = defineProps<{ error: NuxtError }>();
</script>

<template>
  <div class="error">
    <h3>{{ error.statusCode }}</h3>
    <p>{{ error.statusMessage }}</p>
  </div>
</template>
