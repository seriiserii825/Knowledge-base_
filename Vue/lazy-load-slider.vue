
<script lang="ts" setup="">
import {onMounted, PropType, ref} from "vue";
import IAddSliderArrow from "../../icons/IAddSliderArrow.vue";

const props = defineProps({
  slides: {
    type: Array as PropType<string[]>,
    required: true,
  },
  href: {
    type: String,
    required: false,
  },
});

function slidePrev() {
  if (current.value === 0) {
    current.value = props.slides.length - 1;
  } else {
    current.value--;
  }
}

function slideNext() {
  if (current.value === props.slides.length - 1) {
    current.value = 0;
  } else {
    current.value++;
  }
}

const current = ref(0);
const show_lazy_images = ref(false);

onMounted(() => {
  setTimeout(() => {
    show_lazy_images.value = true;
  }, 2000);
});
</script>
<template>
  <div class="main-slider">
    <div class="main-slider__arrow main-slider__arrow--prev" @click="slidePrev">
      <IAddSliderArrow/>
    </div>
    <a :href="href"
       class="main-slider__item"
       :class="{ current: current === index }"
       v-for="(item, index) in slides"
       :key="index"
    >
      <img v-if="index === 0" :src="item" alt=""/>
      <img v-else-if="show_lazy_images" :src="item" alt=""/>
    </a>
    <div class="main-slider__arrow main-slider__arrow--next" @click="slideNext">
      <IAddSliderArrow/>
    </div>
    <ul class="main-slider__dots">
      <li
          v-for="(item, index) in slides.length"
          :class="{ current: current === index }"
          @click="current = index"
      ></li>
    </ul>
  </div>
</template>
