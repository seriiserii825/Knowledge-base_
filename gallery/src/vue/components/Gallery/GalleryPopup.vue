<script setup lang="ts">
import { onMounted, PropType, ref } from "vue";
import { TGalleryItem } from "../../types/TGalleryResponse";
import IClose from "../../icons/IClose.vue";
import ILeft from "../../icons/ILeft.vue";
const emits = defineEmits(['emit_close']);
const props = defineProps({
  images: {
    type: Array as PropType<TGalleryItem[]>,
    required: true,
  },
  current_index: {
    type: Number,
    required: true,
  },
});

const index = ref(0);
const show_image = ref(false);

function goPrev() {
  show_image.value = false;
  if (index.value > 0) {
    index.value--;
  } else {
    index.value = props.images.length - 1;
  }
  setTimeout(() => {
    show_image.value = true;
  }, 50);
}

function goNext() {
  show_image.value = false;
  if (index.value < props.images.length - 1) {
    index.value++;
  } else {
    index.value = 0;
  }
  setTimeout(() => {
    show_image.value = true;
  }, 10);
}

onMounted(() => {
  index.value = props.current_index;
  show_image.value = true;

  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape") {
      show_image.value = false;
      setTimeout(() => {
        emits("emit_close");
      }, 300);
    }
    if (event.key === "ArrowLeft") {
      goPrev();
    }
    if (event.key === "ArrowRight") {
      goNext();
    }
  });
});
</script>

<template>
  <div class="gallery-popup">
    <div v-if="images.length" class="gallery-popup__body">
      <Transition name="fade">
        <img v-if="show_image" :src="images[index].url" :alt="images[index].alt" />
      </Transition>
      <button class="gallery-popup__close" @click="$emit('emit_close')">
        <IClose />
      </button>
      <footer class="gallery-popup__buttons">
        <div class="gallery-popup__btn" @click="goPrev">
          <ILeft />
        </div>
        <div class="gallery-popup__btn" @click="goNext">
          <ILeft />
        </div>
      </footer>
    </div>
    <div v-else class="gallery-popup__empty">
      <p>No images found</p>
    </div>
  </div>
</template>
<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>

