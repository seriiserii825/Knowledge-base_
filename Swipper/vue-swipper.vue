<script setup lang="ts">
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import type { INavigation } from "~/interfaces/INavigation";
const emits = defineEmits(["emit_top_menu"]);

const props = defineProps({
  top_menu: Array as PropType<INavigation[]>,
  active_top_menu: Number,
});

const swiperRef = ref<any>(null);
const show_arrows = ref(false);

function onClickSlide(index: number, item: INavigation) {
  if (swiperRef.value) {
    swiperRef.value.slideTo(index, 500); // Move clicked slide to center
  }

  emits("emit_top_menu", item);
}

function slidePrev() {
  if (swiperRef.value) {
    swiperRef.value.slidePrev();
  }
}

function slideNext() {
  if (swiperRef.value) {
    swiperRef.value.slideNext();
  }
}

function onSwiper(swiper: any) {
  swiperRef.value = swiper;
}

onMounted(() => {
  const nav_links = document.querySelector(".nav-links") as HTMLElement;
  const nav_links_width = nav_links?.offsetWidth;
  const swiper_slide_all = document.querySelectorAll(".swiper-slide");
  const swiper_slides_width = Array.from(swiper_slide_all).reduce(
    (acc, cur) => acc + (cur as HTMLElement).offsetWidth,
    0
  );
  if (swiper_slides_width > nav_links_width + 40) {
    show_arrows.value = true;
  }
});
</script>

<template>
  <div class="nav-links">
    <div v-if="show_arrows" @click="slidePrev" class="nav-links__btn nav-links__btn--prev">
      <div class="nav-links__inner">
        <IconsINav />
      </div>
    </div>
    <div v-if="show_arrows" @click="slideNext" class="nav-links__btn nav-links__btn--next">
      <div class="nav-links__inner">
        <IconsINav />
      </div>
    </div>
    <Swiper
      :slides-per-view="'auto'"
      :centered-slides="false"
      @swiper="onSwiper"
    >
      <SwiperSlide
        v-for="(item, index) in top_menu"
        :key="item.id"
        @click="onClickSlide(index, item)"
        :class="{ active: item.id === active_top_menu }"
      >
        <span>
          <strong>{{ item.title }}</strong>
        </span>
      </SwiperSlide>
    </Swiper>
  </div>
</template>
<style lang="scss">
.nav-links {
  position: relative;
  padding: 6px 6px 0;
  &__btn {
    position: absolute;
    top: 0;
    left: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 20px;
    height: 100%;
    background: linear-gradient(90deg, #fff 0%, rgba(255, 255, 255, 0) 100%);
    z-index: 10;
    cursor: pointer;
    &.nav-links__btn--next {
      left: initial;
      right: 4px;
      background: linear-gradient(90deg, rgba(255, 255, 255, 0) 0%, #fff 100%);
      svg {
        transform: rotate(180deg);
      }
    }
  }
  &__inner {
    display: flex;
    justify-content: center;
    align-items: center;
    flex: 0 0 12px;
    height: 12px;
    border-radius: 5px;
    background: #edecec;
  }
  .swiper-slide {
    position: relative;
    width: auto;
    &::before {
      content: "";
      position: absolute;
      bottom: -6px;
      left: -1px;
      display: block;
      width: calc(100% + 1px);
      height: 24px;
      z-index: 1;
    }
    &.active {
      &::before {
        background: #f3f3f3;
      }
      span {
        color: #4076ff;
        background: #f3f3f3;
        &::before {
          background: url("/images/nav-left.svg") no-repeat center;
        }
        &::after {
          background: url("/images/nav-left.svg") no-repeat center;
        }
      }
      strong {
        &::before {
          background: #4076ff;
        }
      }
    }
  }
  span {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 8px 22px;
    color: #646464;
    border-radius: 18px;
    border: 1px solid #f3f3f3;
    cursor: pointer;
    transition: all 0.4s;
    z-index: 2;
    &:hover {
      background: #f3f3f3;
    }
    &::before {
      content: "";
      position: absolute;
      bottom: -7px;
      left: -26px;
      display: block;
      width: 24px;
      height: 24px;
      background: transparent;
    }
    &::after {
      content: "";
      position: absolute;
      bottom: -7px;
      right: -25px;
      display: block;
      width: 24px;
      height: 24px;
      transform: rotateY(180deg);
      background: transparent;
    }
  }
  strong {
    position: relative;
    font-weight: normal;
    &::before {
      content: "";
      position: absolute;
      bottom: 2px;
      left: 0;
      display: block;
      width: 100%;
      height: 1px;
      background: #646464;
      opacity: 0.4;
    }
  }
}
</style>
