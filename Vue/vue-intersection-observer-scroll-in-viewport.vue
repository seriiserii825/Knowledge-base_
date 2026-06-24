<script setup lang="ts">
  import { PropType, onBeforeUnmount, onMounted, ref } from "vue";

  import BtnRound from "@/modules/btn/BtnRound.vue";
  import { IExperts } from "@/src/vue/interfaces/IHomeResponse";

  const props = defineProps({
    experts: {
      type: Object as PropType<IExperts>,
      required: true,
    },
  });

  const experts_ref = ref<HTMLElement | null>(null);
  const video_experts_ref = ref<HTMLVideoElement | null>(null);
  const inViewport = ref(false);

  let observer: IntersectionObserver | null = null;

  onMounted(() => {
    observer = new IntersectionObserver(
      async ([entry]) => {
        inViewport.value = entry.isIntersecting;

        const video = video_experts_ref.value;
        if (!video) return;

        if (entry.isIntersecting) {
          try {
            await video.play();
          } catch (error) {
            console.warn("Video play blocked:", error);
          }
        } else {
          video.pause();
        }
      },
      {
        threshold: 0.3,
      },
    );

    if (experts_ref.value) {
      observer.observe(experts_ref.value);
    }
  });

  onBeforeUnmount(() => {
    observer?.disconnect();
  });
</script>

<template>
  <section ref="experts_ref" class="experts">
    <div class="experts__body">
      <video
        v-if="experts.video"
        ref="video_experts_ref"
        class="experts__video"
        muted
        loop
        autoplay
        playsinline
      >
        <source :src="experts.video" type="video/mp4" />
      </video>
      <img v-if="experts.image" :src="experts.image.url" alt="Experts Image" class="experts__img" />
      <div class="experts__content">
        <h2 class="experts__title">{{ experts.title }}</h2>
        <div class="experts__text">{{ experts.text }}</div>
        <footer class="experts__footer">
          <BtnRound :light="true" :title="experts.button_text" :url="experts.button_url" />
        </footer>
      </div>
    </div>
  </section>
</template>
