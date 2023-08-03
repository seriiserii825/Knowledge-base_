<script setup>
import SectionHeader from "../../components/globals/SectionHeader.vue";
import PreCode from "../../components/ui/PreCode.vue";
import {onUnmounted, ref} from "vue";
import usePrism from "../../hooks/usePrism";
import Radio from "../../components/ui/Radio.vue";


const footballs_clubs = ref([
  {id: 'f1', title: "Liverpool"},
  {id: 'f2', title: "Manchester United"},
  {id: 'f3', title: "Chelsea"},
  {id: 'f4', title: "Arsenal"}
]);

const selected_footballs_clubs = ref('Arsenal');

const code_js = `
const footballs_clubs = ref([
  {id: 'f1', title: "Liverpool"},
  {id: 'f2', title: "Manchester United"},
  {id: 'f3', title: "Chelsea"},
  {id: 'f4', title: "Arsenal"}
]);

const selected_footballs_clubs = ref('Arsenal');
`;

const code_vue = `
<Radio v-for="item in footballs_clubs"
       :key="item.id"
       :id="item.id"
       :value="item.title"
       :label="item.title"
       name="football_clubs"
       v-model:radio="selected_footballs_clubs"
/>
`;
onUnmounted(() => {
  usePrism();
});
</script>
<template>
  <div class='radio-view'>
    <SectionHeader title="Radio"/>
    <br><br>
    <h3>Selected footballs clubs: </h3>
    <br>
    <div>{{ selected_footballs_clubs }}</div>
    <br><br>
    <Radio v-for="item in footballs_clubs"
           :key="item.id"
           :id="item.id"
           :value="item.title"
           :label="item.title"
           name="football_clubs"
           v-model:radio="selected_footballs_clubs"
    />
    <br><br>
    <PreCode class-name="language-javascript">{{ code_js }}</PreCode>
    <br><br>
    <PreCode>{{ code_vue }}</PreCode>
  </div>
</template>
<style lang="scss" scoped>

</style>
