<script setup lang="ts">
import { Swiper, SwiperSlide } from "swiper/vue";
import { ref, watch, toRef } from "vue";
import "swiper/css";

const props = defineProps({
  images: {
    type: Array as () => string[],
    required: true,
  },
  current_index: {
    type: Number,
    required: true,
  },
});

const currentIndex = toRef(props, "current_index");
const swiperInstance = ref<any>(null);

// Receive swiper instance when ready
function onSwiper(swiper: any) {
  swiperInstance.value = swiper;
  swiper.slideTo(currentIndex.value); // ensure it's in sync initially
}

// Watch prop and update slide
watch(currentIndex, (newIndex) => {
  if (swiperInstance.value) {
    swiperInstance.value.slideTo(newIndex);
  }
});
</script>

<template>
  <div class="custom-slider">
    <swiper
      :slides-per-view="1"
      :initial-slide="current_index"
      @swiper="onSwiper"
      class="my-swiper"
    >
      <swiper-slide v-for="(image, index) in images" :key="index">
        <img :src="image" alt="" />
      </swiper-slide>
    </swiper>
  </div>
</template>
