import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";

export default function lessonsTypeFixedOnScroll() {
  gsap.registerPlugin(ScrollTrigger);

  const page_lessons = document.querySelector(".page-lessons");
  const lessons_type = document.querySelector(".lessons-type");

  if (!page_lessons || !lessons_type) return;

  // Function to dynamically calculate header height
  const getHeaderHeight = () => {
    const header = document.querySelector(".main-header");
    return header ? header.clientHeight : 0;
  };

  ScrollTrigger.create({
    trigger: page_lessons,
    start: () => `top ${getHeaderHeight()}px`, // Dynamically calculate start position
    pin: lessons_type,
    pinSpacing: false,
    // markers: true, // Uncomment for debugging
    onEnter: () => {
      lessons_type.classList.add("fixed");
    },
    onLeaveBack: () => {
      lessons_type.classList.remove("fixed");
    },
  });

  // Update ScrollTrigger on header height change
  window.addEventListener("resize", () => ScrollTrigger.refresh());
  let scrollTimeout;
  let first_check = true;
  window.addEventListener("scroll", () => {
    if (scrollTimeout) return;
    scrollTimeout = setTimeout(() => {
      const header = document.querySelector(".main-header");
      if (header?.classList.contains("active") && first_check) {
        ScrollTrigger.refresh();
        first_check = false;
      }
      scrollTimeout = null;
    }, 100); // Adjust timeout as needed
  });
}
