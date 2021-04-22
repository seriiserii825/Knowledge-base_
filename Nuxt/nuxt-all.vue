<template>
  <div>
    <h1>{{ pageTitle }}</h1>
    <ul>
      <li v-for="user in users" :key="user.id">
        <nuxt-link :to="`/users/${user.id}`">{{ user.name }} (<strong> {{ user.email }} </strong>)</nuxt-link>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  async fetch({ store, error }) {
    try {
      if(store.getters["users/users"].length === 0){
        await store.dispatch('users/fetchUsers')
      }
    } catch (e) {
      error(e)
    }
  },
  data() {
    return {
      pageTitle: 'User page'
    }
  },
  computed: {
    users() {
      return this.$store.getters["users/users"]
    }
  }
}
</script>
