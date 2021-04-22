<template>
  <div>
    <div>
      <input type="text" v-model.number="data">
      <p>{{ data }}</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      data: 10
    }
  },
  watch: {
    data(value){
      console.log(value);
      console.log(typeof value);
    }
  }
}
</script>
