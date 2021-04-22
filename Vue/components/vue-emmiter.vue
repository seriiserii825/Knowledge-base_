#=================== Main
export const emmitCounter = new Vue();

#=================== App
<Counter></Counter>

#=================== Car
<template> 
<button @click="updateCounter">Update counter</button>
</template>

<script>
import {emmitCounter} from "@/main";


methods: {
  updateCounter(){
    emmitCounter.$emit('updateCounter');
  }
}
</script>

#=================== Counter
<template>
  <div>Counter: {{ counter }}</div>
</template>

<script>
import {emmitCounter} from "@/main";

export default {
  data() {
    return {
      counter: 0
    }
  },
  created() {
    emmitCounter.$on('updateCounter', () => {
      this.counter++;
    });
  }
}
</script>
