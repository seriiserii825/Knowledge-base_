import { ref, onMounted, onUnmounted } from 'vue';

export const useWindowSize = () => {
  const width = ref(0);
  const height = ref(0);

  const updateSize = () => {
    width.value = window.innerWidth;
    height.value = window.innerHeight;
  };

  onMounted(() => {
    updateSize();
    window.addEventListener('resize', updateSize);
  });

  onUnmounted(() => {
    window.removeEventListener('resize', updateSize);
  });

  return {
    width,
    height,
  };
};
