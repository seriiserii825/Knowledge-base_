import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";
export default function serviziScroll() {
  gsap.registerPlugin(ScrollTrigger);
  const btn_all = document.querySelectorAll(".services-filter a");

  btn_all.forEach((btn) => {
    btn.addEventListener("click", function (e) {
      e.preventDefault();
      btn_all.forEach((btn) => btn.classList.remove("active"));
      this.classList.add("active");
      const href = this.getAttribute("href");
      const elem = document.querySelector(href);
      const top = elem.offsetTop;
      window.scrollTo({
        top: top - 100,
        behavior: "smooth",
      });
    });
  });

  const body = document.querySelector("body");
  if (!body) return;
  const body_rect = getComputedStyle(body);
  const body_padding_top = parseInt(body_rect.paddingTop);

  gsap.timeline({
    scrollTrigger: {
      start: "0% 0%",
      trigger: ".services-filter__wrap",
      // markers: true,
      onEnter: () => {
        const services_filter = document.querySelector(".services-filter");
        if (!services_filter) return;
        const rect = services_filter.getBoundingClientRect();
        const services_filter_height = rect.height;
        const body_total_height = services_filter_height + body_padding_top;
        if (!body_padding_top) return;
        if (body) {
          body.style.paddingTop = `${body_total_height}px`;
        }
        services_filter?.classList.add("fixed");
      },
      onLeaveBack: () => {
        document.querySelector(".services-filter")?.classList.remove("fixed");
        if (body && body_padding_top) {
          body.style.paddingTop = `${body_padding_top}px`;
        }
      },
    },
  });
  document.addEventListener(
    "scroll",
    function () {
      const scrollPosition =
        document.documentElement.scrollTop || document.body.scrollTop;
      btn_all.forEach((link) => {
        const href = link.getAttribute("href");
        const hash = href?.split("#")[1];
        if (hash) {
          const element = document.querySelector(href);
          if (
            scrollPosition >= element?.offsetTop - 100 &&
            scrollPosition < element?.offsetTop + element?.offsetHeight - 100
          ) {
            clearActive();
            link.classList.add("active");
          }
        }
      });
    },
    {
      passive: true,
    }
  );
  function clearActive() {
    btn_all.forEach((btn) => btn.classList.remove("active"));
  }
}
