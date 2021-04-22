// file in middleware dir
export default function ({ store, redirect }) {
  if ( ! store.getters['login/isAuth']) {
    redirect('/login')
  }
}

//component
export default {
  middleware: ['auth']
}
