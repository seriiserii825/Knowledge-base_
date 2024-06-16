import gsap from 'gsap';
import ScrollTrigger from "gsap/ScrollTrigger";
export default function ourMasterAnimation() {
  gsap.registerPlugin(ScrollTrigger);

  const percent = "35%";
  gsap.set('.our-master__item:first-of-type', {
    x: calcTransform("x", "calc(100% + 16px)"),
    scrollTrigger: {
      start: `top: ${percent}`,
      trigger: ".our-master",
      markers: true,
    },
  })
  gsap.set('.our-master__item:last-of-type', {
    x: calcTransform("x", "calc(-100% - 16px)"),
    scrollTrigger: {
      start: `top: ${percent}`,
      trigger: ".our-master",
      markers: true,
    },
  })
  function calcTransform(property: string, value: string) {
    let alias = {y: "translateY", x: "translateX", z: "translateZ", rotation: "rotate"};
    return function (i: any, target: any) {
      let transform = target.style.transform; // remember the original transform
      target.style.transform = (alias[property] || property) + "(" + value + ")"; // apply the new value
      let computed = parseFloat(gsap.getProperty(target, property, property.substr(0, 3) === "rot" ? "deg" : "px", true)); // grab the pixel value
      target.style.transform = transform; // revert
      gsap.getProperty(target, property, "px", true); // reset the cache so the new value is reflected
      return computed;
    };
  }
}
