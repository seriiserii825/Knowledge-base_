import gsap from "gsap";

export default function homeIntroAnimation() {

    let tl = gsap.timeline();
    tl.to(".home-intro__image", {
        opacity: 1, duration: 1
    },).to(".home-intro__title", {
        opacity: 1, y: 0, duration: 2,
    }).to(".home-intro__btn", {
        opacity: 1, y: 0, duration: 2,
    }, "-=2").to(".home-filter__container", {
        opacity: 1, y: 0, duration: 2,
    }, "-=1.5")
}
