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

asyncData ({params, app, error }) {

    return app.$axios.$get(`/seller/${params.username}`).then(async sellerRes => {

        let [categoriesRes, reviewsRes, productsRes] = await Promise.all([
            app.$axios.$get(`/categories`),
            app.$axios.$get(`/seller/${params.username}/reviews`),
            app.$axios.$get(`/seller/${params.username}/products`)
        ])

        return {
            seller: sellerRes.data,
            metaTitle: sellerRes.data.name,
            categories: categoriesRes.data,
            reviewsSummary: reviewsRes.summary,
            products: productsRes.data,
        }

    }).catch(e => {
        error({ statusCode: 404, message: 'Seller not found' })
    });
},
