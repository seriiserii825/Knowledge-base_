<script setup>
  import DOMPurify from "dompurify";

  const safeHtml = DOMPurify.sanitize(apiContent);
</script>

<script>
  import DOMPurify from 'dompurify';

  export default function useSafeDisplay(value: string) {
    const sanitizedValue = DOMPurify.sanitize(value);
    return sanitizedValue;
  }
</script>

<template>
  <div v-html="safeHtml"></div>
</template>
