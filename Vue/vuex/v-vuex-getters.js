export default Vuex.Store({
  getters: {
    cnt: (state) => state.cnt,
    price: (state) => state.price,
    status: (state) => state.status,
    total(state) {
      return state.cnt * state.price
    },
    has(state) {
      return function (id) {
        return state.products.some((item) => item.id === id)
      }
    }
  },
}
