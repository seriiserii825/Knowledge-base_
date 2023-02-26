import gsap from 'gsap';
import ScrollTrigger from "gsap/ScrollTrigger";

export default function teamAnimation() {
    gsap.registerPlugin(ScrollTrigger);
    const team_item = gsap.utils.toArray(".item-team");

    team_item.forEach((item) => {
        gsap.from(item, {
            scrollTrigger: {
                start: "top: 100%",
                trigger: item,
            },
            opacity: 0,
            y: 100,
            duration: 0.5,
        });
    });
}
