import gsap from 'gsap';
import ScrollTrigger from "gsap/ScrollTrigger";

export default function reiAnimation() {
    gsap.registerPlugin(ScrollTrigger);

    gsap.from("#js-rei .rei__items", {
        scrollTrigger: {
            start: "top: 60%",
            trigger: ".rei__items",
        },
        opacity: 0,
        y: -100,
        duration: 2,
    });
    gsap.from("#js-rei .rei__img", {
        scrollTrigger: {
            start: "top: 60%",
            trigger: ".rei__items",
        },
        opacity: 0,
        y: 100,
        duration: 2,
    });
}
