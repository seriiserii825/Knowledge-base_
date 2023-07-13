<script setup>
import {ref} from "@vue/reactivity";
import {Scrollbar, Navigation} from "swiper";
import {Swiper, SwiperSlide} from "swiper/vue";
import "swiper/css";
import "swiper/css/scrollbar";
import "swiper/css/navigation";
import {useSessionContentStore} from "../../stores/content-store";
import {storeToRefs} from "pinia";
import {onMounted} from "vue";
import {useCookies} from "vue3-cookies";
import {useAxiosToken} from "../../hooks/useAxiosToken";
import {computed} from "@vue/runtime-core";
const {cookies} = useCookies();
const loading = ref(true);
const sessionContentStore = useSessionContentStore();
const {session_content_pages, session_content} =
    storeToRefs(sessionContentStore);
const modules = ref([Scrollbar, Navigation]);
const emits = defineEmits(["emit_click", "emit_close"]);
const props = defineProps({
  current_page: {
    type: Number,
    required: true,
  },
  is_teacher: {
    type: Boolean,
    required: false,
  },
});
const current_slide = computed(() => {
  return session_content.value.current_slide;
});
function clickHandler(index) {
  if (props.is_teacher) {
    emits("emit_click", index);
    emits("emit_close");
  } else if (index <= current_slide.value) {
    emits("emit_click", index);
    emits("emit_close");
  }
}
const swiperOptions = {
  slidesPerView: 1,
  breakpoints: {
    576: {
      slidesPerView: 2,
    },
    768: {
      slidesPerView: 3,
    },
    1200: {
      slidesPerView: 4,
    },
    1400: {
      slidesPerView: 5,
    },
    1800: {
      slidesPerView: 6,
    },
  },
};
const init = async () => {
  const user_token = cookies.get("userToken");
  useAxiosToken(user_token);
  const session_content_id = localStorage.getItem("session_content_id");
  await sessionContentStore.storeSessionContentPages(session_content_id);
  loading.value = false;
};
onMounted(() => {
  init();
});
</script>
<template>
  <div v-if="!loading" class="pages-slider">
    <swiper
        class="swiper"
        :modules="modules"
        :slides-per-view="1"
        :space-between="32"
        :scrollbar="{ hide: false, draggable: true }"
        :navigation="true"
        :breakpoints="swiperOptions.breakpoints"
    >
      <swiper-slide
          v-for="page in session_content_pages.data.pages"
          :key="page.id"
      >
        <div
            :class="{
            'pages-slider__item--active': current_page === page.page_number,
            'pages-slider__item--more': page.page_number > current_slide,
            'pages-slider__item--pointer': props.is_teacher,
          }"
            class="pages-slider__item"
            @click="clickHandler(page.page_number)"
        >
          <div class="pages-slider__index">{{ page.page_number }}</div>
          <div class="pages-slider__title">
            {{ page.title }}
          </div>
          <div>{{ page.page_type === 0 ? "Slide" : "Domanda" }}</div>
        </div>
      </swiper-slide>
    </swiper>
  </div>
</template>
<style lang="scss">
.pages-slider {
  padding: 6.4rem 6.4rem 3.2rem;
  background: rgba(20, 26, 45, 0.7);
  backdrop-filter: blur(32px);
  @media screen and (max-width: 1200px) {
    padding: 3.2rem 3.2rem;
  }
  &__item {
    display: flex;
    justify-content: space-between;
    flex-direction: column;
    padding: 3.2rem;
    height: 28rem;
    background: #fff;
    border: 1px solid #464f69;
    border-radius: 16px;
    cursor: pointer;
    &--active {
      color: white;
      background: var(--accent);
      .pages-slider__index {
        color: var(--accent);
        border-color: white;
      }
    }
    &--more {
      color: white;
      background: #8fe1d2;
      cursor: not-allowed;
      .pages-slider__index {
        color: #8fe1d2;
        border-color: white;
      }
      &.pages-slider__item--pointer {
        cursor: pointer;
      }
    }
  }
  &__index {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 3.2rem;
    height: 3.2rem;
    font-size: 1.4rem;
    font-weight: 600;
    background: #fff;
    border: 1px solid black;
    border-radius: 50%;
  }
  &__title {
    height: 15.2rem;
    overflow: hidden;
  }
  .swiper {
    padding: 0 0 12rem;
  }
  .swiper-scrollbar {
    bottom: 4rem;
    left: 50%;
    transform: translateX(-50%);
    width: 90%;
    height: 2px;
    background: rgba(255, 255, 255, 0.2);
    @media screen and (max-width: 1200px) {
      width: 80%;
    }
    @media screen and (max-width: 768px) {
      width: 60%;
    }
  }
  .swiper-scrollbar-drag {
    top: -2px;
    height: 6px;
    background: #8fe1d2;
    cursor: grabbing;
  }
  .swiper-button-prev,
  .swiper-button-next {
    top: 89%;
    width: 4.8rem;
    height: 4.8rem;
    background: #8fe1d2;
    border-radius: 50%;
    &::after {
      display: none;
    }
    &::before {
      content: "";
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 10px;
      height: 20px;
      background: url("/images/arrow-left.svg") no-repeat center;
    }
  }
  .swiper-button-next {
    &::before {
      transform: translate(-50%, -50%) rotate(180deg);
    }
  }
}
</style>
