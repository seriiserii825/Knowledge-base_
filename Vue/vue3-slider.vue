<script lang="ts" setup>
import "vue3-carousel/dist/carousel.css";
import {Carousel, Slide, Navigation} from "vue3-carousel";
import {IAgentsList} from "../../interfaces/agents/IAgentsList";
import {PropType} from "vue";
import AgentItem from "../agents/AgentItem.vue";

const props = defineProps({
  title: {
    type: String,
    required: true,
  },
  items: {
    type: Array as PropType<IAgentsList[]> | null,
    required: false,
  },
});
const breakpoints = {
  // 700px and up
  300: {
    itemsToShow: 1,
  },
  700: {
    itemsToShow: 2,
  },
  // 1024 and up
  1024: {
    itemsToShow: 2,
  },
  1400: {
    itemsToShow: 3,
  },
};
</script>
<template>
  <div class="agency-team">
    <h2 class="agency-team__title">{{ title }}</h2>
    <carousel v-if="items && items.length > 0" :items-to-show="10" :breakpoints="breakpoints">
      <slide v-for="item in items" :key="item.id_agente">
        <AgentItem :item="item" />
      </slide>
      <template #addons>
        <navigation />
      </template>
    </carousel>
  </div>
</template>
