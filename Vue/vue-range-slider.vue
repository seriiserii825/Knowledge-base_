============================================ docs
https://github.com/vueform/slider#multiple-slider
yarn add @vueform/slider

============================================== Parent
<script lang="ts" setup>
const local_slider = ref([1, 10]);

function changeLocalValue(value) {
  local_slider.value = value;
}

const energy_array = [
  {
    name: "A",
    value: "A",
  },
  {
    name: "B",
    value: "B",
  },
  {
    name: "C",
    value: "C",
  },
  {
    name: "D",
    value: "D",
  },
  {
    name: "E",
    value: "E",
  },
  {
    name: "F",
    value: "F",
  },
  {
    name: "G",
    value: "G",
  },
  {
    name: "ND",
    value: "ND",
  },
];

const energy_slider = ref([1, 8]);

function changeClaseEnergeticaValue(value) {
  energy_slider.value = value;
}
</script>
<template>
  <CustomRangeSlider
    :min="1"
    :max="20"
    :value_range="local_slider"
    min_label="Locali"
    max_label="Locali +"
    label="Locali"
    @emit_change="changeLocalValue"
  />

  <CustomRangeSlider
    :min="1"
    :max="8"
    :value_range="energy_slider"
    min_label=""
    max_label=""
    label="Classe energetica"
    @emit_change="changeClaseEnergeticaValue"
    :alternate_options="energy_array"
  />
</template>

============================================== Component
<script lang="ts" setup>
import Slider from "@vueform/slider";
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
  alternate_options: {
    type: Array,
    required: false,
  },
});

const proportions = ref(1);

const value = ref([1, 10]);

const type = "Range";
const changed_values = ref([]);
const min_value = ref(0);
const max_value = ref(0);

function onChange(args) {
  changeValues(args);
  const min = args[0];
  const max = args[1];
  emits("emit_change", [min, max]);
}

function changeValues(values) {
  changed_values.value = values;
  if (props.alternate_options && props.alternate_options.length) {
    console.log(props.alternate_options[values[0]], "props.alternate_options");
    console.log(values[0], "values");
    min_value.value = props.alternate_options[values[0] - 1].name;
    max_value.value = props.alternate_options[values[1] - 1].name;
  } else {
    min_value.value = values[0];
    max_value.value = values[1];
  }
  changed_values.value = [values[0], values[1]];
}

onMounted(() => {
  proportions.value = 100 / props.max;
  changeValues(props.value_range);
});
</script>
<template>
  <div class="v-popup__label">{{ label }}</div>
  <Slider
    v-if="changed_values && changed_values.length"
    v-model="changed_values"
    :min="min"
    :max="max"
    @update="onChange"
    :tooltips="false"
  />
  <div class="v-popup__info">
    <span>{{ min_value }} {{ min_label }} </span> -
    <span>{{ max_value }} {{ max_label }}</span>
  </div>
</template>
<style>
@import "@vueform/slider/themes/default.css";
</style>
