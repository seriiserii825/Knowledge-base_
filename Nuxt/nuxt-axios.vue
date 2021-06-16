<template lang="pug">
  .container
    ul
      li(v-for="user in users" :key="user.id")
        strong {{ user.name }}
        em {{ user.email }}
</template>

<script>
export default {
  async asyncData({ $axios }) {
    try {
      const users = await $axios.$get('https://jsonplaceholder.typicode.com/users');
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
