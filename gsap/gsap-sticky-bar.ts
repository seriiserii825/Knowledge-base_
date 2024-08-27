import gsap from 'gsap';
import ScrollTrigger from "gsap/ScrollTrigger";
export default function infoHeaderSticky() {
  gsap.registerPlugin(ScrollTrigger);
  const info_header = document.querySelector('.info-tab__header') as HTMLElement | null;
  const body = document.querySelector('body');
  const info_tab = document.querySelector('.info-tab') as HTMLElement | null;
  if (!info_header) return;
  if (!body) return;
  ScrollTrigger.create({
    trigger: info_tab,
    start: "top 0",
    // end: "bottom 90%",
    pinSpacing: false,
    // markers: true,
    onEnter: () => {
      headerActive();
    },
    onEnterBack: () => {
      headerActive();
    },
    onLeave: () => {
      headerDeactive();
    },
    onLeaveBack: () => {
      headerDeactive();
    },
    // markers: true
  });

  function headerActive() {
    info_header?.classList.add('fixed');
    body.style.paddingTop = `${info_header?.offsetHeight}px`;
    // console.log(getScrollBarWidth(), "getScrollBarWidth()");
    const window_width = window.innerWidth;
    info_header.style.width = window_width - getScrollBarWidth() + 'px';
  }
  function headerDeactive() {
    info_header?.classList.remove('fixed');
    body.style.paddingTop = `0`;
    info_header.style.width = `100%`;
  }

  function getScrollBarWidth() {
    // Create a div element
    var scrollDiv = document.createElement("div");

    // Set its style properties
    scrollDiv.style.width = "100px";
    scrollDiv.style.height = "100px";
    scrollDiv.style.overflow = "scroll";
    scrollDiv.style.position = "absolute";
    scrollDiv.style.top = "-9999px";

    // Append the div to the document
    document.body.appendChild(scrollDiv);

    // Calculate the scrollbar width
    var scrollbarWidth = scrollDiv.offsetWidth - scrollDiv.clientWidth;

    // Remove the div from the document
    document.body.removeChild(scrollDiv);
    return scrollbarWidth;
  }
}

