#====== main.js
<script charset="utf-8">
Vue.filter('toUpperCase', value => value.toUpperCase())
</script>

#======== App.vue

<template>
  <div id="app">
    <Car>
      <h2>{{ carName }}</h2>
      <h2>{{ carName | toLowerCase }}</h2>
      <h2>{{ carName | toUpperCase }}</h2>
    </Car>
  </div>
</template>

<script>

export default {
  filters: {
    toLowerCase(value){
      return value.toLowerCase();
    }
  }
};
</script>
