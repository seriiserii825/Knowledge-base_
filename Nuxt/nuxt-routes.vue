<template>
  <!--id from file _id.vue-->
  <h1>{{ $route.params.id }}</h1>

  <a href="#" @click.prevent="goTo(elem)"></a>
</template>

<script>
export default {
  validate({params}){
    return /^\d+$/.test(params.id); //validation
  },
  methods: {
    goTo(elem) {
      this.$router.push('/users/' + elem);
    }
  }
}
</script>


<template lang="pug">
  ul
    li
      nuxt-link(to='/') Home
    li
      nuxt-link(to='/users/2') User 2
    li
      nuxt-link(to='/users/3') User 3
</template>
<style lang="scss">
.nuxt-link-exact-active {
  background-color: green;
}
</style>
