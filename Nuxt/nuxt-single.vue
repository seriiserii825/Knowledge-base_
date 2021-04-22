<template>
  <div>
    <h1>User: {{ user.name }}</h1>
    <hr>
    <div>{{ user.email }}</div>
  </div>
</template>

<script>
export default {
  async asyncData({ params, error, store }) {
    try {
      const user = await store.dispatch('users/fetchUserById', params.id)
      return { user };
    } catch (e) {
      error(e)
    }
  },
  validate({ params }) {
    return /^\d+$/.test(params.id);
  }
}
</script>

