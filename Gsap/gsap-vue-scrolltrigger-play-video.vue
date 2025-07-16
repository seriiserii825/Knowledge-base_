<script setup lang="ts">
import { onMounted, onBeforeUnmount, ref } from 'vue';
import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

defineProps({
  video_url: {
    type: String,
    required: true
  }
});

const is_playing = ref(false);
const video_player = ref<HTMLVideoElement | null>(null);
let scrollTriggerInstance: ScrollTrigger | null = null;

function playVideo() {
  is_playing.value = true;
  video_player.value?.play().catch((error) => {
    console.error('Error playing video:', error);
  });
}

function pauseVideo() {
  is_playing.value = false;
  video_player.value?.pause();
}

onMounted(() => {
  scrollTriggerInstance = ScrollTrigger.create({
    trigger: video_player.value,
    start: 'top 80%',
    end: 'bottom 20%',
    onEnter: () => playVideo(),
    onEnterBack: () => playVideo(),
    onLeave: () => pauseVideo(),
    onLeaveBack: () => pauseVideo(),
    markers: false // set to true for debug
  });
});

onBeforeUnmount(() => {
  scrollTriggerInstance?.kill();
});
</script>

<template>
  <div class="linea-video">
    <video ref="video_player" :src="video_url" muted loop></video>
  </div>
</template>
