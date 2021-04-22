  userLogOut ({ commit }) {
    firebase.auth().signOut()
    commit('setUser', null)
  }
