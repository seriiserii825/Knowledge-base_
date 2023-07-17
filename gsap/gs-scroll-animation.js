import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";
export default function featuresAnimation() {
    gsap.registerPlugin(ScrollTrigger);
    gsap
        .timeline({
            scrollTrigger: {
                trigger: ".features",
                start: "top 80%",
            }
        })
        .from(".features__item:nth-of-type(odd)", {
            x: 100,
            opacity: 0,
            duration: 1,
            stagger: 0.5
        })
        .from(".features__item:nth-of-type(even)", {
            x: -100,
            opacity: 0,
            duration: 1,
            stagger: 0.5
        }, "-=2")
        .from(".features__title", {
            y: 400,
            opacity: 0,
            duration: 3,
        }, "-=2.5")
        .from(".features__left", {
            opacity: 0,
            duration: 2,
        }, "-=1.5")
        .from(".features__right", {
            opacity: 0,
            duration: 2,
        }, "-=1.5");
}

