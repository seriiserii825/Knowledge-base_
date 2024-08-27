import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";
export default function animateNumbers() {
  gsap.registerPlugin(ScrollTrigger);

  let once = false;

  ScrollTrigger.create({
    trigger: ".years",
    start: "top 0",
    // end: "bottom 90%",
    pinSpacing: false,
    // markers: true,
    onEnter: () => {
      if (!once) {
        const numbers = document.querySelectorAll(".numbers__title");
        numbers.forEach((number, index) => {
          const span = number.querySelector("span");
          const final_val = parseInt(span?.textContent);
          span.textContent = "0";
          if (index === 0) {
            increment(span, final_val, 40);
          } else if (index === 1) {
            increment(span, final_val, 100);
          } else {
            increment(span, final_val, 30);
          }
        });
      }
      once = true;
    },
  });
  function increment(elem, finalVal, timeout) {
    let currVal = parseInt(elem.innerHTML);
    let interval = setInterval(() => {
      if (currVal < finalVal) {
        currVal++;
        elem.innerHTML = currVal;
      } else {
        clearInterval(interval);
      }
    }, timeout);
  }
}
