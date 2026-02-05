import Swiper from "swiper";
import { Pagination } from "swiper/modules"; // ✅ JS logic for pagination

import "swiper/css";
import "swiper/css/pagination";

Swiper.use([Pagination]); // ✅ Register the module

export default function erapraAboutSwiper() {
  const swiper = new Swiper(".erapra-about__slider", {
    speed: 400,
    slidesPerView: "auto",
    initialSlide: 0,
    pagination: {
      el: ".swiper-pagination",
      clickable: true, // Optional but recommended
    },
  });
}
