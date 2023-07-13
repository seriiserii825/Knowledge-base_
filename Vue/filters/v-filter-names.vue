#=========== App.vue
<template>
  <div id="app">
    <input type="text" v-model="searchInput">
    <ul>
      <li v-for="name in filteredNames" :key="name"> {{ name }}</li>
    </ul>
  </div>
</template>

<script>

export default {
  data() {
    return {
      searchInput: '',
      names: ['Max', 'Vlad', 'Elena']
    }
  },
  computed: {
    filteredNames(){
      return this.names.filter(item => {
        return item.toLowerCase().indexOf(this.searchInput.toLowerCase()) !== -1;
      });
    }
  }
};
</script>
