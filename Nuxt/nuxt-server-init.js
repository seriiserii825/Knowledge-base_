// in store/index.js

export const actions = {
  async nuxtServerInit({ dispatch }) {
    await dispatch('users/fetchUsers')
  }
}


