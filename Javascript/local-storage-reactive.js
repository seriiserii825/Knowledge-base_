localStorage.setItem('foo-key', 'data to store')

window.dispatchEvent(new CustomEvent('foo-key-localstorage-changed', {
  detail: {
    storage: localStorage.getItem('foo-key')
  }
}));

mounted() {
  window.addEventListener('foo-key-localstorage-changed', (event) => {
    this.data = event.detail.storage;
  });
},
data() {
  return {
    data: null,
  }
}
