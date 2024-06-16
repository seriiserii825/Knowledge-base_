<script setup>
import Checkbox from "./Checkbox.vue";

const emits = defineEmits(['update:value']);

const props = defineProps({
  name: {
    type: String,
    required: true
  },
  value: {
    type: Array,
    required: true
  },
  options: {
    type: Array,
    required: true,
    validator: (values) => {
      const hasTitleKey = values.every(option => Object.keys(option).includes('title'));
      const hasIdKey = values.every(option => Object.keys(option).includes('id'));
      return hasTitleKey && hasIdKey;
    }
  },
})

function updateValue(params) {
  let values = [...props.value];
  if (params.checked) {
    values.push(params.id);
  } else {
    values.splice(values.indexOf(params.id), 1);
  }
  emits('update:value', values);
}
</script>
<template>
  <div class='checkbox-group'>
    <Checkbox
        v-for="option in options"
        :key="option.id"
        :id="option.id"
        :name="name"
        :label="option.title"
        :value="option.name"
        :checked="value.includes(option.id)"
        :group="true"
        @update-value="updateValue"
    />
  </div>
</template>
<style lang="scss" scoped>

</style>
