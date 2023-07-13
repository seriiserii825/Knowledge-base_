<template>
  <div id="app">
    <textarea v-model="textarea"></textarea>
    <p>{{ textarea }}</p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      textarea: 'Initial value'
    }
  },
};
</script>

<style>
body {
  color: white;
  background-color: #444;
}
textarea {
  height: 100px;
}
p {
  white-space: pre;
}
</style>
