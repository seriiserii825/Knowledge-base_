import gsap from "gsap";
export default function pageIntroAnimation() {
  const line = document.querySelector(".page-intro__line") as HTMLElement;
  line.style.display = "block";
  gsap.from(".page-intro__title span", {
    x: "-110%",
    duration: 1.5,
    delay: 1,
    ease: "power4.out",
  });
  gsap.to(".page-intro__line", {
    display: "none",
    duration: 0.4,
    delay: 1.2,
    ease: "power4.out",
  });
}
