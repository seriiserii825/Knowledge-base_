<template>
  <div>
    <div>
      <h2>{{ title }}</h2>
      <input type="checkbox" value="fb" v-model="socials">
      <input type="checkbox" value="vk" v-model="socials">
      <input type="checkbox" value="inst" v-model="socials">
      <ul>
        <li v-for="s of socials">{{ s }}</li>
      </ul>
    </div>

    <app-list></app-list>
  </div>
</template>

<script>
import ListMixin from "./ListMixin";

export default {
  data() {
    return {
      title: "Fiat",
      socials: ['fb']
    }
  },
}
</script>
