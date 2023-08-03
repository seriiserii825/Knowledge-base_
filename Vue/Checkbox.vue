<script setup>
const emits = defineEmits(['update:checked', 'updateValue']);

const props = defineProps({
  label: {
    type: String,
    default: 'Checkbox'
  },
  name: {
    type: String,
    default: 'checkbox'
  },
  id: {
    type: [String, Number],
    required: true
  },
  value: {
    type: String,
    required: false
  },
  checked: {
    type: Boolean,
    required: true
  },
  group: {
    type: Boolean,
    default: false
  },
  privacy: {
    type: Boolean,
    default: false
  },
  privacyLabel: {
    type: String,
    default: 'privacy policy'
  }
})

function toggleCheckbox(event) {
  if (props.group) {
    emits('updateValue', {id: props.id, checked: event.target.checked});
  } else {
    emits('update:checked', event.target.checked);
  }
}

</script>
<template>
  <div class='checkbox prevent-select'>
    <input
        :name="name"
        type="checkbox"
        :id="id"
        :value="value"
        :checked="checked"
        @input="toggleCheckbox($event)"
    >
    <label class="checkbox--privacy" v-if="privacy" :for="id">{{ label }}
      <router-link to="/privacy-policy">{{ privacyLabel }}</router-link>
    </label>
    <label v-else :for="id"><span>{{ label }}</span></label>
  </div>
</template>
<style lang="scss">
.checkbox {
  position: relative;
  z-index: 1;
  display: block;
  margin-bottom: 1rem;
  min-height: 1.5rem;
  input {
    position: absolute;
    left: 0;
    z-index: -1;
    width: 1.6rem;
    height: 1.6rem;
    opacity: 0;
    &:checked + label {
      &::after {
        opacity: 1;
      }
    }
  }
  label {
    position: relative;
    display: block;
    margin-bottom: 0;
    padding-left: 2.8rem;
    min-height: 2rem;
    vertical-align: top;
    font-size: 1.2rem;
    line-height: 1.4rem;
    font-weight: 500;
    overflow: hidden;
    cursor: pointer;
    span {
      position: relative;
      top: 1px;
    }
    &::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      display: block;
      width: 1.6rem;
      height: 1.6rem;
      pointer-events: none;
      background-color: white;
      border: 1px solid var(--accent);
      border-radius: 50%;
    }
    &::after {
      content: "";
      position: absolute;
      top: 0.5rem;
      left: 0.5rem;
      display: block;
      width: 0.8rem;
      height: 0.8rem;
      background: var(--accent);
      border-radius: 50%;
      opacity: 0;
    }
    &.checkbox--privacy {
      a {
        text-decoration: underline;
        &:hover {
          text-decoration: none;
        }
      }
    }
  }
}
</style>
