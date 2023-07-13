export default Vuex.Store({
  actions: {
    increase(store) {
      store.commit('setCnt', store.state.cnt - 1)
    },
    decrease(store) {
      store.commit('setCnt', store.state.cnt + 1)
    },
    setCnt(store, payload) {
      store.commit('setCnt', isNaN(payload) ? 1 : payload)
    },
    sendOrder(store) {
      store.commit('setStatus', 'pending')
      setTimeout(() => {
        store.commit('setStatus', 'done')
      }, 500)
    }
  },
}
//in component
  methods: {
    ...mapMutations(['increase', 'decrease', 'setCnt']),
    ...mapActions(['sendOrder']),
    onInput(e) {
      this.setCnt(e.target.value.trim())
    }
  }
