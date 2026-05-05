<script setup lang="ts">
  import { ref, PropType } from "vue";
  import { Swiper, SwiperSlide } from "swiper/vue";
  import { Scrollbar } from "swiper/modules";
  import "swiper/css";
  import "swiper/css/scrollbar";
  import type { Swiper as SwiperType } from "swiper";
  import { ITerm } from "../../interfaces/ITerm";
  import ISliderArrowRight from "../../icons/ISliderArrowRight.vue";
  defineProps({
    typologies: {
      type: Array as PropType<ITerm[]>,
      required: true,
    },
  });
  const swiperInstance = ref<SwiperType | null>(null);
  const isBeginning = ref(true);
  const isEnd = ref(false);
  function onSwiper(swiper: SwiperType) {
    swiperInstance.value = swiper;
    isBeginning.value = swiper.isBeginning;
    isEnd.value = swiper.isEnd;
  }
  function onSlideChange(swiper: SwiperType) {
    isBeginning.value = swiper.isBeginning;
    isEnd.value = swiper.isEnd;
  }
  function slidePrev() {
    swiperInstance.value?.slidePrev();
  }
  function slideNext() {
    swiperInstance.value?.slideNext();
  }
  function getSliderImage(term: ITerm): string {
    const image = term.slider_image ? term.slider_image : term.image;
    return image ? image : "";
  }
</script>
<template>
  <section class="typology-slider">
    <Swiper
      :slides-per-view="'auto'"
      :space-between="8"
      :modules="[Scrollbar]"
      :scrollbar="{ el: '.typology-slider__scrollbar', draggable: true }"
      @swiper="onSwiper"
      @slideChange="onSlideChange"
    >
      <SwiperSlide v-for="item in typologies" :key="item.id">
        <div class="typology-slider__item">
          <img :src="getSliderImage(item)" :alt="item.name" class="typology-slider__img" />
          <h3 class="typology-slider__title">{{ item.name }}</h3>
        </div>
      </SwiperSlide>
    </Swiper>
    <footer class="typology-slider__footer">
      <div class="typology-slider__arrows">
        <button
          class="typology-slider__arrow typology-slider__arrow--prev"
          :disabled="isBeginning"
          @click="slidePrev"
        >
          <ISliderArrowRight />
        </button>
        <button
          class="typology-slider__arrow typology-slider__arrow--next"
          :disabled="isEnd"
          @click="slideNext"
        >
          <ISliderArrowRight />
        </button>
      </div>
      <div class="typology-slider__scrollbar swiper-scrollbar"></div>
    </footer>
  </section>
</template>
<style lang="scss">
  .typology-slider {
    .swiper-slide {
      width: 420px !important;
    }
    &__item {
      position: relative;
      aspect-ratio: 1/1.41;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      padding: 20px 15px;
      img {
        position: absolute;
        top: 0;
        left: 0;
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: -1;
      }
    }
    &__title {
      font-size: 21.6px;
      font-style: normal;
      font-weight: var(--font-weight-700, 700);
      line-height: var(--line-height-29_35, 29.35px);
    }
    &__footer {
      display: flex;
      align-items: center;
      gap: 16px;
      margin-top: 20px;
    }
    &__arrows {
      display: flex;
      flex-shrink: 0;
      gap: 4px;
    }
    &__scrollbar {
      position: static !important;
      flex: 0 0 304px;
      height: 2px !important;
      border-radius: 2px;
      color: #fff;
      background: rgba(0, 0, 0, 0.15);
      .swiper-scrollbar-drag {
        height: 100%;
        border-radius: 2px;
        background: #000;
      }
    }
    &__arrow {
      display: flex;
      justify-content: center;
      align-items: center;
      flex: 0 0 48px;
      height: 48px;
      border-radius: 24px;
      border: none;
      background: white;
      cursor: pointer;
      &:disabled {
        opacity: 0.25;
        cursor: not-allowed;
      }
      &--prev {
        svg {
          position: relative;
          transform: rotate(180deg);
        }
      }
    }
  }
</style>
