<script setup lang="ts">
import { onMounted, ref } from "vue";
import { axiosWp } from "../utils/axiosWp";
import { TGalleryItem, TGalleryResponse } from "../types/TGalleryResponse";
import Paginate from "../components/Paginate.vue";
import GalleryPopup from "../components/Gallery/GalleryPopup.vue";
const title = ref("Gallery");
const gallery = ref<TGalleryItem[]>([]);
const per_page = ref(10);
const current_page = ref(1);
const gallery_ref = ref<HTMLElement | null>(null);
const show_popup = ref(false);
const gallery_items = ref<TGalleryItem[][]>([]);
const current_index = ref(0);

function showPopup(url: string) {
  const index = gallery.value.findIndex((item) => item.url === url);
  if (index !== -1) {
    show_popup.value = true;
    current_index.value = index;
  }
}

async function getData() {
  const url = window.location.origin + "/wp-json/gallery/v1/all";
  try {
    const resonse = await axiosWp(url);
    const data = resonse.data as TGalleryResponse;
    title.value = data.title;
    gallery.value = data.gallery;
    if (data.per_page) {
      per_page.value = parseInt(data.per_page);
    }
    const total = data.gallery.length;
    const total_pages = Math.ceil(total / per_page.value);
    for (let i = 0; i < total_pages; i++) {
      const start = i * per_page.value;
      const end = start + per_page.value;
      gallery_items.value.push(data.gallery.slice(start, end));
    }
  } catch (error) {
    console.log(error, "error from Gallery view");
  }
}

function updateCurrentPage(page: number) {
  current_page.value = 0;
  if (gallery_ref.value) {
    const scrollTop = gallery_ref.value.getBoundingClientRect().top + window.scrollY - 100;
    window.scrollTo({
      top: scrollTop,
      behavior: "smooth",
    });
  }
  setTimeout(() => {
    current_page.value = page;
  }, 50);
}

onMounted(async () => {
  await getData();
});
</script>

<template>
  <div class="gallery-view">
    <section class="custom-gallery">
      <div class="container">
        <h2 class="custom-gallery__title title">{{ title }}</h2>
      </div>
      <section class="custom-gallery__body" v-if="gallery_items.length" ref="gallery_ref">
        <div class="custom-gallery__container">
          <transition name="fade">
            <div v-if="current_page !== 0" class="custom-gallery__grid">
              <div
                v-for="item in gallery_items[current_page - 1]"
                :key="item.id"
                class="custom-gallery__item"
              >
                <img @click="showPopup(item.url)" :src="item.url" :alt="item.alt" />
              </div>
            </div>
          </transition>
        </div>
        <Paginate
          v-if="gallery_items.length > 1"
          :current_page="current_page"
          :total_pages="gallery_items.length"
          @update_current="updateCurrentPage"
        />
      </section>
      <div v-else class="custom-gallery__empty">
        <p>No images found</p>
      </div>
    </section>
    <GalleryPopup
      v-if="show_popup"
      @emit_close="show_popup = false"
      :images="gallery"
      :current_index="current_index"
    />
  </div>
</template>
<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
