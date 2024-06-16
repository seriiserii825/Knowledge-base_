export default Vuex.Store({
  mutations: {
    setCnt(state, cnt) {
      state.cnt = Math.max(1, cnt)
    },
    setStatus(state, status) {
      state.status = status
    },
  },
}
//in template
    ...mapActions(['sendOrder', 'increase', 'decrease', 'setCnt']),
    onInput(e) {
      const lastCnt = this.cnt
      this.setCnt(e.target.value)

      if (lastCnt === this.cnt && lastCnt.toString() !== e.target.value) {
        console.log('nz')
        this.$forceUpdate()
      }
    }
