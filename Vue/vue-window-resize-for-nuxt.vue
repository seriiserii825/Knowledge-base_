<script setup lang="ts">
const window_width = ref(0);

function handleResize() {
  if (process.client) {
    window_width.value = window.innerWidth;
    console.log(window_width.value, "window_width.value");
  }
}

const is_mobile = computed(() => {
  return window_width.value <= 576;
});

onMounted(() => {
  if (process.client) {
    handleResize();
    window.addEventListener("resize", handleResize);
  }
});

onBeforeUnmount(() => {
  if (process.client) {
    window.removeEventListener("resize", handleResize);
  }
});
</script>

<template>
  <div class="header">
    <NuxtLink to="/" class="header__logo">
      <IconsILogo />
      <span>valutaimmobile.it</span>
    </NuxtLink>
    <NavMenu v-if="!is_mobile" />
    <div class="header__burger" v-if="is_mobile">
      <IconsIBurger />
    </div>
  </div>
</template>
