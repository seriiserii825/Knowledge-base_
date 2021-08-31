const promise1 = new Promise((resolve, reject) => {
 setTimeout(() => {
  resolve('Promise1 выполнен');
 }, 2000);
});
const promise2 = new Promise((resolve, reject) => {
 setTimeout(() => {
  reject('Promise2 отклонен');
 }, 1500);
});
Promise.all([promise1, promise2])
  .then((data) => console.log(data[0], data[1]))
  .catch((error) => console.log(error));  // Promise2 отклонен


  fetch({ store }) {
    const result = [];
    if (store.getters['home/home'].length === 0) {
      result.push(store.dispatch('home/fetchHome'));
    }
    if (store.getters["solutions/getSolutions"].length === 0) {
      result.push(store.dispatch('solutions/fetchSolutions'));
    }
    if (store.getters["tipo/getTipo"].length === 0) {
      result.push(store.dispatch('tipo/fetchTipo'));
    }
    if (store.getters["portfolio/getPortfolio"].length === 0) {
      result.push(store.dispatch('portfolio/fetchPortfolio'));
    }
    if (store.getters["options/getOptions"].length === 0) {
      result.push(store.dispatch('options/fetchOptions'));
    }

    return Promise.all(result)
      .then((data) => console.log(data))
      .catch((error) => console.log(error));
  }



axios.$patch(
  process.env.baseUrl + "/api/v1/page/" + this.$route.params.id,
  formData
).catch(err => {
  if (err.response) {
    console.log(err.response.data.message, 'err.response.data.message');
    this.$message.error(err.response.data.message);
    this.loading = false;
  } else if (err.request) {
    this.$message.error(err.request);
    console.log(err.request, 'err.request')
    this.loading = false;
  }
});
