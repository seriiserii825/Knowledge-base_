import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";

export default function fixedFilterTabs() {
  gsap.registerPlugin(ScrollTrigger);
  const products_filter_view = document.querySelector(".products-filter-view") as HTMLElement;
  const filter_tabs = document.querySelector(".filter-tabs") as HTMLElement;
  if (!products_filter_view || !filter_tabs) return;

  ScrollTrigger.create({
    trigger: products_filter_view,
    start: "top 0",
    // end: "bottom 100%",
    end: () => `${document.documentElement.scrollHeight - window.innerHeight}px`,
    pin: filter_tabs,
    pinSpacing: false,
    markers: true,
  });
}
