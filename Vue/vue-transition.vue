<template>
  <Transition name="property">
    <div v-if="show">hello</div>
  </Transition>
</template>
<style lang="scss">
// before enter
.property-enter-from {
  opacity: 0;
}
// after enter
.property-enter-to {
  opacity: 1;
}
// while enter
.property-enter-active {
  transition: opacity 0.5s;
}
// before leave
.property-leave-from {
  opacity: 1;
}
// after leave
.property-leave-to {
  opacity: 0;
}
// while leave
.property-leave-active {
  transition: opacity 0.3s;
}
</style>
