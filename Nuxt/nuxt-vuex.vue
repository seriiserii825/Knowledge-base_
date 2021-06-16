#users.js store
<script>
export const actions = {
  async fetchUsers() {
    try {
      return await this.$axios.$get('https://jsonplaceholder.typicode.com/users');
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
</script>

#users page
<template lang="pug">
  .container
    ul
      li(v-for="user in users" :key="user.id")
        strong {{ user.name }}
        em {{ user.email }}
</template>

<script>
export default {
  async asyncData({ store }) {
    try {
      const users = await store.dispatch('users/fetchUsers');
      return { users }
    } catch (e) {
      console.log(e, 'e')
    }
  }
}
</script>

<style lang="scss" scoped>

li {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
}
</style>

#single user page

<template>
  <div class="test">
    <!--id from file _id.vue-->
    <h1>{{ user.name }}</h1>
    <p>{{ user.email }}</p>
    <p>{{ user.id }}</p>

    <a href="#" @click.prevent="goTo(elem)"></a>
    <nuxt-link to="/">Go home</nuxt-link>
  </div>
</template>

<script>
export default {
  async asyncData({ params, error, store }) {
    try {
      const user = await store.dispatch('users/fetchUserById', params.id)
      return { user }
    } catch (e) {
      console.log(e, 'e')
    }

  },
  validate({ params }) {
    return /^\d+$/.test(params.id); //validation
  },
  methods: {
    goTo(elem) {
      this.$router.push('/users/' + elem);
    }
  }
}
</script>

