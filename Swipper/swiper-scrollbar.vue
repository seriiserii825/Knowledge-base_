<script setup lang="ts">
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Scrollbar } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/pagination';
import 'swiper/css/scrollbar'; // ← Make sure this line is included!
import { PropType, ref } from 'vue';
import { TAmbiti } from '../../types/TProductAmbitiResponse';
import AmbitiSlide from './AmbitiSlide.vue';

const modules = ref([Scrollbar]);

defineProps({
  ambiti: {
    type: Array as PropType<TAmbiti[]>,
    required: true
  }
});

const active_slide = ref(10000);

function emitActiveSlide(index: number) {
  active_slide.value = index;
}
</script>
<template>
  <div class="ambiti-slider">
    <swiper
      :slidesPerView="'auto'"
      :spaceBetween="8"
      class="mySwiper"
      :modules="modules"
      :scrollbar="{ draggable: true }"
    >
      <swiper-slide v-for="(ambito, index) in ambiti" :key="index">
        <AmbitiSlide
          :slide_is_active="active_slide === index"
          :ambito="ambito"
          :index="index"
          @emit_active_slide="emitActiveSlide"
        />
      </swiper-slide>
    </swiper>
  </div>
</template>
