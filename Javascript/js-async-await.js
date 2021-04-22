  async registerUser ({commit}, {email, password}) {
    commit('clearError')
    commit('setLoading', true)
    try {
      const user = await firebase.auth().createUserWithEmailAndPassword(email, password)
      commit('setUser', new User(user.uid))
      commit('setLoading', false)
    } catch (error) {
      commit('setLoading', false)
      commit('setError', error.msg)
      throw error
    }
  }

this.$store.dispatch('registerUser', user)
  .then(() => {
    this.$router.push('/')
  })
  .catch(err => console.log(err))
