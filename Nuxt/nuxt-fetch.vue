#store
<script>
export const state = () => {
  return {
    users: []
  }
}

export const mutations = {
  setUser(state, users) {
    state.users = users
  }
}

export const actions = {
  async fetchUsers({ commit }) {
    try {
      const users = await this.$axios.$get('https://jsonplaceholder.typicode.com/users');
      commit('setUser', users);
    } catch (e) {
      throw e
    }
  },
  async fetchUserById({}, payload) {
    try {
      return await this.$axios.$get('https://jsonplaceholder.typicode.com/users/' + payload)
    } catch (e) {
      throw e
    }
  }
}

export const getters = {
  users(state) {
    return state.users;
  }
}
</script>


#users

<template lang="pug">
  .container
    ul
      li(v-for="user in users" :key="user.id")
        nuxt-link(:to="`/users/${user.id}`")
          strong {{ user.name }}
          em {{ user.email }}
</template>

<script>
export default {
  async fetch({ store }) {
    try {
      if (store.getters['users/users'].length === 0) {
        await store.dispatch('users/fetchUsers');
      }
    } catch (e) {
      console.log(e, 'e')
    }
  },
  computed: {
    users() {
      return this.$store.getters['users/users'];
    }
  }
}
</script>

<style lang="scss" scoped>
li a {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
}
</style>
