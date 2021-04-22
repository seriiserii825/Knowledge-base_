<template>
  <div>
    <div>
      <h2>{{ title }}</h2>
      <select v-model="defaultSocial">
        <option v-for="social in socials">{{ social }}</option>
      </select>
      <p>{{ defaultSocial }}</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      defaultSocial: 'fb',
      social: 'inst',
      socials: ['vk', 'fb', 'inst']
    }
  },
}
</script>
