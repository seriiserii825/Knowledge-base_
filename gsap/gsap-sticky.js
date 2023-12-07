import gsap from 'gsap';
import ScrollTrigger from "gsap/ScrollTrigger";

export default function singleProductImageFixed() {
    gsap.registerPlugin(ScrollTrigger);
    const wrap = document.querySelector('.single-product__wrap');
    const img = document.querySelector('.single-product__gallery');
    const content_height = document.querySelector(".single-product__content").offsetHeight;
    const img_height = img.offsetHeight;
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

