<script setup lang="ts">
  import { defineModel } from "vue";

  const count = defineModel<number>("count", { default: 0 });
</script>
<template>
  <div>
    <p>Count: {{ count }}</p>
    <button @click="count++">Increment</button>
  </div>
</template>

<!-- Range slider parent -->
<script setup lang="ts">
  import { defineModel } from "vue";

  const min = ref(0);
  const max = ref(100);
</script>
<template>
  <RangeSlider v-model:min="min" v-model:max="max" />
</template>

<!-- Range slider component -->
<script setup lang="ts">
  import { defineModel } from "vue";

  const min = defineModel<number>("min", { default: 0 });
  const max = defineModel<number>("max", { default: 100 });
</script>
<template>
  <div>
    <label for="min">Min: {{ min }}</label>
    <input id="min" type="range" :min="0" :max="100" v-model="min" />

    <label for="max">Max: {{ max }}</label>
    <input id="max" type="range" :min="0" :max="100" v-model="max" />
  </div>
</template>
