<script setup>
import SectionHeader from "../../components/globals/SectionHeader.vue";
import {onMounted, ref} from "vue";
import usePrism from "../../hooks/usePrism";
import PreCode from "../../components/ui/PreCode.vue";
import Checkbox from "../../components/ui/Checkbox.vue";
import CheckboxGroup from "../../components/ui/CheckboxGroup.vue";

const checkbox_is_active = ref(false);


const fruits = ref([
  {id: 1, title: "apple"},
  {id: 2, title: "pear"},
  {id: 3, title: "nuts"},
  {id: 4, title: "peach"},
  {id: 5, title: "banana"},
]);

const selected_fruits = ref([3]);

const code_js = `
const checkbox_is_active = ref(true);
`;
const code = `
<Checkbox
    value="checkbox"
    label="Checkbox"
    name="checkbox"
    id="0"
    v-model:checked="checkbox_is_active"/>
`;

const groupe_code_js = `
const fruits = ref([
  {id: 1, title: "apple"},
  {id: 2, title: "pear"},
  {id: 3, title: "nuts"},
  {id: 4, title: "peach"},
  {id: 5, title: "banana"},
]);

const selected_fruits = ref([3]);
`;

const group_code = `
<CheckboxGroup
    :options="fruits"
    name="fruits"
    v-model:value="selected_fruits"
/>
`;

onMounted(() => {
  usePrism();
});
</script>
<template>
  <div class='checkbox-view'>
    <SectionHeader title="Checkbox"/>
    <div>Checkbox is active: {{ checkbox_is_active }}</div>
    <br>
    <Checkbox
        value="checkbox"
        label="Checkbox"
        name="checkbox"
        id="0"
        v-model:checked="checkbox_is_active"/>
    <br><br>
    <PreCode class-name="language-javascript">{{ code_js }}</PreCode>
    <br><br>
    <PreCode>{{ code }}</PreCode>
    <br><br>
    <SectionHeader title="Checkbox Group"/>
    <br>
    <div>Selected fruits: {{ selected_fruits }}</div>
    <br>
    <CheckboxGroup
        :options="fruits"
        name="fruits"
        v-model:value="selected_fruits"
    />
    <br>
    <PreCode class-name="language-javascript">{{ groupe_code_js }}</PreCode>
    <br><br>
    <PreCode>{{ group_code }}</PreCode>
  </div>
</template>
<style lang="scss" scoped>
</style>
