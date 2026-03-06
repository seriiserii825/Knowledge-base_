import Swiper from "swiper";
import { Autoplay, Pagination } from "swiper/modules";

export default function ourServicesSlider() {
  const swiperEl = document.querySelector<HTMLElement>(".swiper");
  if (!swiperEl) return;

  const prevBtn = document.querySelector<HTMLButtonElement>(".our-services .slider-btn--prev");
  const nextBtn = document.querySelector<HTMLButtonElement>(".our-services .slider-btn--next");

  const updateButtons = (s: Swiper) => {
    if (prevBtn) prevBtn.disabled = s.isBeginning;
    if (nextBtn) nextBtn.disabled = s.isEnd;
  };

  const swiper = new Swiper(swiperEl, {
    slidesPerView: "auto",
    speed: 1000,
    modules: [Autoplay],
    on: {
      init: updateButtons,
      slideChange: updateButtons,
    },
    // breakpoints: {
    //   320: {
    //     slidesPerView: 1
    //   },
    //   576: {
    //     slidesPerView: 1.6
    //   }
    // }
  });

  prevBtn?.addEventListener("click", () => {
    swiper.slidePrev();
  });

  nextBtn?.addEventListener("click", () => {
    swiper.slideNext();
  });
}
