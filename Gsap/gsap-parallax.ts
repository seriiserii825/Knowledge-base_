import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";
export default function footerParallax() {
  gsap.registerPlugin(ScrollTrigger);
  const footer_top = document.querySelector(".footer-top") as HTMLElement;
  let yPercent = 22;
  if (window.innerWidth < 992) {
    yPercent = 28; // на мобильных устройствах не используем параллакс
  } else if (window.innerWidth < 576) {
    yPercent = 32; // на планшетах параллакс чуть меньше
  }
  gsap.set(footer_top, {
    yPercent, // изначально опускаем на 20 % собственной высоты
    force3D: true, // для лучшей производительности
    willChange: "transform", // для лучшей производительности
  });
  gsap.to(footer_top, {
    yPercent: -50, // поднимаем на 20 % собственной высоты
    ease: "none", // без инерции — чистый параллакс
    scrollTrigger: {
      trigger: footer_top, // начинаем, когда top .main касается top viewport
      start: "top 50%", // анимация начинается, когда .main касается 50 % высоты viewport
      end: "bottom top", // анимация длится, пока .main полностью не выйдет
      scrub: 1, // «привязываем» прогресс к скроллу
      // markers: true
    },
  });
}
