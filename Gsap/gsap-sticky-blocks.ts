import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";

export default function experienceAnimation() {
  const section     = document.querySelector(".experiences__container") as HTMLElement;
  const boxes       = document.querySelectorAll(".experiences__inner")  as NodeListOf<HTMLElement>;

  if (!boxes.length) return;

  gsap.registerPlugin(ScrollTrigger);

  // 1. Создаём триггеры
  boxes.forEach((box, i) => makeTrigger(box, section, i));

  // 2. После полной загрузки страницы и всех картинок – пересчитываем
  window.addEventListener("load", () => ScrollTrigger.refresh());
}

function makeTrigger(box: HTMLElement, section: HTMLElement, index: number) {
  const item   = box.querySelector(".experiences__item") as HTMLElement;
  const starts = ["top 100", "top 260", "top 420"];      // Ваши смещения
  const window_height = window.innerHeight;

  let end = "bottom 90%";
  if (window_height == 900) {
    end = "bottom 110%";
  }
  if (window_height < 900) {
    end = "bottom 130%";
  }

  ScrollTrigger.create({
    trigger: box,
    start:   starts[index] || "top 100",
    endTrigger: section,
    end,

    pin: item,
    pinSpacing: false,

    /* ↓ избавляет от резких рывков при pinSpacing:false */
    anticipatePin: 1,

    /* ↓ если размеры изменятся – пересчитать всё автоматически */
    invalidateOnRefresh: true,
    markers: true,
  });
}
