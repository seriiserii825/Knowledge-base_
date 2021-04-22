import { createStore } from 'vuex'

export default createStore({
  state: {
    cnt: 1,
    price: 1000
  },
  strict: process.env.NODE_ENV !== 'production'
})
