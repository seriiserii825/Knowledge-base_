import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";

export default function whyUsFixedScroll() {
  gsap.registerPlugin(ScrollTrigger);

  const section = document.querySelector(".why-us") as HTMLElement | null;
  const image = section?.querySelector(".why-us__image--first") as HTMLElement | null;
  const video = section?.querySelector(".why-us__video") as HTMLElement | null;
  if (!section || !image || !video) return;

  const EXTRA = 200; // доп. прокрутка после конца секции

  // --- PIN для картинки: вся секция + 200px ---
  ScrollTrigger.create({
    trigger: section,
    start: "top top",
    end: () => `+=${section.offsetHeight + EXTRA}`,
    pin: image,
    pinSpacing: true,
    markers: false,
    anticipatePin: 1,
    invalidateOnRefresh: true,
  });

  // --- PIN для видео: начинаем, когда видео целиком вошло в экран (bottom bottom),
  //     и держим до конца секции + 200px (та же конечная точка, что у картинки) ---
  ScrollTrigger.create({
    trigger: video,
    start: "bottom bottom", // момент, когда НИЗ видео совпал с НИЗОМ окна — значит, видео полностью в экране
    end: () => {
      // Рассчитываем ДЛИНУ пина от старта до точки (низ секции достиг низа окна) + EXTRA
      // Формула длины (в пикселях): (sectionTop + sectionHeight + EXTRA) - (videoTop + videoHeight)
      const sectionTop = section.offsetTop;
      const sectionHeight = section.offsetHeight;
      const videoTop = video.offsetTop;
      const videoHeight = video.offsetHeight;
      const distance =
        sectionTop + sectionHeight + EXTRA - (videoTop + videoHeight);
      return `+=${Math.max(0, distance)}`;
    },
    pin: true,         // фиксируем сам .why-us__video
    pinSpacing: true,  // оставляем место, чтобы не было «скачков»
    markers: false,
    anticipatePin: 1,
    invalidateOnRefresh: true,
  });

  // На случай динамического контента/ресайза
  ScrollTrigger.refresh(true);
}
