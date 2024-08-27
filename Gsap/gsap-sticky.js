import gsap from 'gsap';
import ScrollTrigger from "gsap/ScrollTrigger";

export default function singleProductImageFixed() {
  gsap.registerPlugin(ScrollTrigger);
  const wrap = document.querySelector('.single-product__wrap');
  const img = document.querySelector('.single-product__gallery');
  const img_height = img.offsetHeight;
  const content = document.querySelector(".single-product__content");
  const content_height = content.querySelector(".single-product__content").offsetHeight;
  const total_height = content_height - img_height;
  ScrollTrigger.create({
    trigger: wrap,
    start: "top 0",
    // end: "bottom 90%",
    end: () => `+=${total_height}`,
    pin: img,
    pinSpacing: false,
    markers: true,
  });
}

