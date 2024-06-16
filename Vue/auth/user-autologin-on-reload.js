//main.js
firebase.auth().onAuthStateChanged(user => {
  if (user) {
    this.$store.dispatch('autoLoginUser', user)
  }
})

// store user
autoLoginUser ({commit}, payload) {
  commit('setUser', new User(payload.id))
}
