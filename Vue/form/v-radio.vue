<template>
  <div>
    <div>
      <h2>{{ title }}</h2>
      <input type="radio" value="fb" v-model="socials">
      <input type="radio" value="vk" v-model="socials">
      <input type="radio" value="inst" v-model="socials">
      <p>{{ socials }}</p>
    </div>

    <app-list></app-list>
  </div>
</template>

<script>
export default {
  data() {
    return {
      title: "Fiat",
      socials: 'vk'
    }
  },
}
</script>
