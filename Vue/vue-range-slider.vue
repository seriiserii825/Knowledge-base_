============================================ docs
package.json
dependencies
"@syncfusion/ej2-vue-inputs": "^22.2.7",

============================================== Parent
<script lang="ts" setup>
const local_initial_value = [1, 50];
const local_changed_values = ref([1, 10]);

function changeLocalValue(value) {
  local_changed_values.value = value;
}
</script>
<template>
  <CustomRangeSlider
    :min="1"
    :max="20"
    :value_range="local_initial_value"
    min_label="Locali"
    max_label="Locali +"
    label="Locali"
    @emit_change="changeLocalValue"
  />
</template>

============================================== Component
<script lang="ts" setup>
import { SliderComponent as EjsSlider } from "@syncfusion/ej2-vue-inputs";
import { onMounted, ref } from "vue";

const emits = defineEmits(["emit_change"]);

const props = defineProps({
  label: {
    type: String,
    required: true,
  },
  value_range: {
    type: Array,
    required: true,
  },
  min: {
    type: Number,
    required: true,
  },
  max: {
    type: Number,
    required: true,
  },
  min_label: {
    type: String,
    required: false,
    default: "",
  },
  max_label: {
    type: String,
    required: false,
    default: "",
  },
});

const proportions = ref(1);

const type = "Range";
const changed_values = ref([]);
const min_value = ref(0);
const max_value = ref(0);

function onChange(args) {
  changeValues(args.value[0], args.value[1]);
  const min = Math.round(args.value[0] / proportions.value);
  const max = Math.round(args.value[1] / proportions.value);
  emits("emit_change", [min, max]);
}

function changeValues(min, max) {
  min_value.value = Math.round(min / proportions.value);
  max_value.value = Math.round(max / proportions.value);
  changed_values.value = [min, max];
}

onMounted(() => {
  proportions.value = 100 / props.max;
  changeValues(props.value_range[0], props.value_range[1]);
});
</script>
<template>
  <div class="v-popup__label">{{ label }}</div>
  <ejs-slider
    v-if="changed_values.length"
    id="type"
    :value="changed_values"
    :type="type"
    :change="onChange"
  ></ejs-slider>
  <div class="v-popup__info">
    <span>{{ min_value }} {{ min_label }} </span> -
    <span>{{ max_value }} {{ max_label }}</span>
  </div>
</template>
<style>
@import "@syncfusion/ej2-base/styles/material.css";
@import "@syncfusion/ej2-buttons/styles/material.css";
@import "@syncfusion/ej2-popups/styles/material.css";
@import "@syncfusion/ej2-vue-inputs/styles/material.css";
</style>
