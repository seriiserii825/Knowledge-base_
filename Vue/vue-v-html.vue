<script setup>
  import DOMPurify from "dompurify";

  const safeHtml = DOMPurify.sanitize(apiContent);
</script>

<template>
  <div v-html="safeHtml"></div>
</template>
