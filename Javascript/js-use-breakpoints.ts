import { computed } from "vue";
import { ref, onMounted, onUnmounted } from "vue";
export const useWindowSize = () => {
  const width = ref(0);
  const height = ref(0);
  const updateSize = () => {
    width.value = window.innerWidth;
    height.value = window.innerHeight;
  };
  onMounted(() => {
    updateSize();
    window.addEventListener("resize", updateSize);
  });
  onUnmounted(() => {
    window.removeEventListener("resize", updateSize);
  });
  return {
    width,
    height,
  };
};
const BREAKPOINTS = {
  desktop: 1200,
  tablet: 992,
  mobile: 768,
  mobileSmall: 576,
  xsMobile: 380,
} as const;
export default function useBreakpoints() {
  const { width } = useWindowSize();
  const isDesktop = computed(() => width.value <= BREAKPOINTS.desktop);
  const isTablet = computed(() => width.value <= BREAKPOINTS.tablet);
  const isMobile = computed(() => width.value <= BREAKPOINTS.mobile);
  const isSmallMobile = computed(() => width.value <= BREAKPOINTS.mobileSmall);
  const isXsMobile = computed(() => width.value <= BREAKPOINTS.xsMobile);
  return {
    BREAKPOINTS,
    isDesktop,
    isTablet,
    isMobile,
    isSmallMobile,
    isXsMobile,
  };
}
