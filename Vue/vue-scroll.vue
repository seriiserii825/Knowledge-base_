<script>
function doScroll() {
  const target_top = target.value.getBoundingClientRect().top;
  const tabs_bar = document.querySelector('.single-agency-tabs__nav');
  if (target_top <= 0) {
    tabs_bar.classList.add('fixed');
  } else {
    tabs_bar.classList.remove('fixed');
  }
}

onMounted(() => {
  document.addEventListener('scroll', doScroll);
})
onUnmounted(() => {
  document.removeEventListener('scroll', doScroll);
});
</script>
<template>
  <div class="single-agency-tabs" ref="target"></div>
</template>

