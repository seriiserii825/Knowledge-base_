<script setup lang="ts">
import { ref } from "vue";
const is_active = ref(false);
const toggle = () => {
  is_active.value = !is_active.value;
};
</script>
<template>
  <div @click="toggle" class="burger" :class="{ 'burger--active': is_active }">
    <div class="burger__line burger__line--top"></div>
    <div class="burger__line burger__line--middle"></div>
    <div class="burger__line burger__line--bottom"></div>
  </div>
</template>
<style lang="scss">
.burger {
  position: relative;
  display: block;
  width: 3rem;
  height: 3rem;
  background: #f3f3f3;
  border-radius: 50%;
  cursor: pointer;
  &--active .burger__line--top {
    top: 1.5rem;
    transform: translateX(-50%) rotate(45deg);
  }
  &--active .burger__line--middle {
    opacity: 0;
  }
  &--active .burger__line--bottom {
    top: 1.5rem;
    transform: translateX(-50%) rotate(-45deg);
  }
  &__line {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    display: block;
    width: 1.6rem;
    height: 1px;
    transition: all linear 0.1s;
    background-color: black;
  }
  &__line--top {
    top: 1rem;
  }
  &__line--middle {
    top: 1.5rem;
  }
  &__line--bottom {
    top: 2rem;
  }
}
</style>
