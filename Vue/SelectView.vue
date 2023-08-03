<script setup>
import SectionHeader from "../../components/globals/SectionHeader.vue";
import SelectComponent from "../../components/ui/SelectComponent.vue";
import {ref, onMounted} from "vue";
import PreCode from "../../components/ui/PreCode.vue";
import usePrism from "../../hooks/usePrism";

const options = [
  {id: 1, title: "BMW"},
  {id: 2, title: "Mercedes"},
  {id: 3, title: "Audi"},
  {id: 4, title: "Volkswagen"},
  {id: 5, title: "Porsche"},
];


const selected = ref(options[0]);

const fruits = [
  {id: 1, title: "Apple"},
  {id: 2, title: "Orange"},
  {id: 3, title: "Banana"},
  {id: 4, title: "Pineapple"},
  {id: 5, title: "Mango"}
];
const selected_fruits = ref([1, 2]);

const code_js_1 = `
const options = [
  {id: 1, title: "BMW"},
  {id: 2, title: "Mercedes"},
  {id: 3, title: "Audi"},
  {id: 4, title: "Volkswagen"},
  {id: 5, title: "Porsche"},
];


const selected = ref(options[0]);
`;

const code_html_1 = `
<div :style="{'max-width': '40rem'}">
  <SelectComponent
      label="Select a car"
      :tabindex="1"
      :options="options"
      v-model:value="selected"
  />
</div>
`;

const code_js_2  = `
const fruits = [
  {id: 1, title: "Apple"},
  {id: 2, title: "Orange"},
  {id: 3, title: "Banana"},
  {id: 4, title: "Pineapple"},
  {id: 5, title: "Mango"}
];
const selected_fruits = ref([1, 2]);
`;

const code_html_2 = `
<div :style="{'max-width': '40rem'}">
  <SelectComponent
      label="Select a car multiselect"
      :tabindex="2"
      :options="fruits"
      v-model:values="selected_fruits"
  />
</div>
`;

onMounted(() => {
  usePrism();
});
</script>
<template>
  <div class='select-view'>
    <SectionHeader title="Select"/>
    <div :style="{'max-width': '40rem'}">
      <SelectComponent
          label="Select a car"
          :tabindex="1"
          :options="options"
          v-model:value="selected"
      />
    </div>
    <br><br>
    <PreCode class-name="language-javascript">{{ code_js_1 }}</PreCode>
    <br><br>
    <PreCode>{{ code_html_1 }}</PreCode>
    <br><br>
    <SectionHeader title="Select multiselect"/>
    <div :style="{'max-width': '40rem'}">
      <SelectComponent
          label="Select a car multiselect"
          :tabindex="2"
          :options="fruits"
          v-model:values="selected_fruits"
      />
    </div>
    <PreCode class-name="language-javascript">{{ code_js_2 }}</PreCode>
    <br><br>
    <PreCode>{{ code_html_2 }}</PreCode>
    <br><br>
  </div>
</template>
<style lang="scss" scoped>

</style>
