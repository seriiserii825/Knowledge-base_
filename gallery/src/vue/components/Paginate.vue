<script setup>
import PaginationIcon from "../icons/PaginationIcon.vue";

const emits = defineEmits(["update_current"]);
const props = defineProps({
  current_page: {
    type: Number,
    required: true,
  },
  total_pages: {
    type: Number,
    required: true,
  },
});

function updateCurrent(e, index) {
  e.preventDefault();
  if (index < 1 || index > props.total_pages) {
    return;
  }
  emits("update_current", index);
}
</script>
<template>
  <ul class="paginate">
    <li :class="{ disabled: current_page === 1 }" class="paginate__arrow">
      <PaginationIcon @click="updateCurrent($event, current_page - 1)" />
    </li>
    <li
      v-for="(item, index) in total_pages"
      :key="index"
      :class="{ active: current_page === index + 1 }"
    >
      <a @click="updateCurrent($event, index + 1)" href="#">{{ item }}</a>
    </li>
    <li
      :class="{ disabled: current_page === total_pages }"
      class="paginate__arrow paginate__arrow--right"
    >
      <PaginationIcon @click="updateCurrent($event, current_page + 1)" />
    </li>
  </ul>
</template>

