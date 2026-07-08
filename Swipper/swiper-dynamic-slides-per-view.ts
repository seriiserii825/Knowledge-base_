import Swiper from "swiper";
import "swiper/css";

export default function servicesSliderSwiper() {
  const swiperEl = document.querySelector<HTMLElement>(".swiper.services-slider-swiper");
  if (!swiperEl) return;

  const prevBtn = swiperEl.querySelector<HTMLButtonElement>(".swiper-button-prev");
  const nextBtn = swiperEl.querySelector<HTMLButtonElement>(".swiper-button-next");

  const updateButtonsState = (swiperInstance: Swiper) => {
    if (prevBtn) prevBtn.disabled = swiperInstance.isBeginning;
    if (nextBtn) nextBtn.disabled = swiperInstance.isEnd;
  };

  function getSlidesPerView(width: number) {
    if (width < 576) return 1;
    if (width < 992) return 2;
    return 3;
  }

  const swiper = new Swiper(swiperEl, {
    slidesPerView: getSlidesPerView(window.innerWidth),
    spaceBetween: 32,
    speed: 1000,
    on: {
      init: updateButtonsState,
      slideChange: updateButtonsState,
    },
  });

  function updateSize() {
    swiper.params.slidesPerView = getSlidesPerView(window.innerWidth);
    swiper.update();
  }

  window.addEventListener("resize", updateSize);

  prevBtn?.addEventListener("click", () => {
    swiper.slidePrev();
  });

  nextBtn?.addEventListener("click", () => {
    swiper.slideNext();
  });
}
