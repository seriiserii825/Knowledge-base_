<script lang="ts" setup>
import {ref} from "vue";
import debounce from "lodash.debounce";

const debouncedHandler = debounce(event => {
  onInput();
}, 1000);

const props = defineProps({
  placeholder: {
    type: String,
    required: true,
  },
});

const emits = defineEmits(["emit_search_name"]);
const search_input = ref("");

function onInput() {
  console.log('useDebounce');
  emits("emit_search_name", search_input.value);
}
</script>
<template>
  <div class="agency-name">
    <input @input="debouncedHandler" v-model="search_input" :placeholder="placeholder"/>
  </div>
</template>
