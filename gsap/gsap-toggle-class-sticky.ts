import gsap from 'gsap';
import ScrollTrigger from "gsap/ScrollTrigger";
export default function infoHeaderSticky() {
  gsap.registerPlugin(ScrollTrigger);
  const info_header = document.querySelector('.info-tab__header') as HTMLElement | null;
  const body = document.querySelector('body');
  if (!info_header) return;
  if (!body) return;
  ScrollTrigger.create({
    trigger: info_header,
    start: "top 0",
    // end: "bottom 90%",
    pinSpacing: false,
    markers: true,
    onEnter: () => {
      info_header?.classList.add('fixed');
      body.style.paddingTop = `${info_header?.offsetHeight}px`;
    },
    onLeaveBack: () => {
      info_header?.classList.remove('fixed');
      body.style.paddingTop = `0`;
    },
  });
}
