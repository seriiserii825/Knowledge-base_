import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

export default function jobRevealSlow() {
gsap.registerPlugin(ScrollTrigger);

// =========================
// GLOBAL SPEED CONTROL
// =========================
const SPEED = 1; // 👈 меняй только это

const START = 'top 85%';
const EASE = 'power2.out';

const IMAGE_DURATION = 2.2 \* SPEED;
const IMAGE_EASE = 'power1.out';
const IMAGE_SCALE_FROM = 1.15;

const ITEMS_DURATION = 0.9 _ SPEED;
const ITEMS_STAGGER = 0.25 _ SPEED;
const ITEMS_OVERLAP = 0.6 \* SPEED;

const ITEMS_Y = 32;

// =========================

gsap.utils.toArray<HTMLElement>('.job').forEach((section) => {
const img = section.querySelector<HTMLImageElement>('.job**img img');
const items = section.querySelectorAll(
'.job**title, .job**description, .job**text, .btn'
);

    // initial states
    if (img) {
      gsap.set(img, {
        clipPath: 'inset(0 0 100% 0)',
        scale: IMAGE_SCALE_FROM
      });
    }

    gsap.set(items, {
      opacity: 0,
      y: ITEMS_Y
    });

    const tl = gsap.timeline({
      scrollTrigger: {
        trigger: section,
        start: START,
        toggleActions: 'play none none reverse'
      },
      defaults: {
        ease: EASE
      }
    });

    // image reveal
    if (img) {
      tl.to(img, {
        clipPath: 'inset(0 0 0% 0)',
        scale: 1,
        duration: IMAGE_DURATION,
        ease: IMAGE_EASE
      });
    }

    // content reveal
    tl.to(
      items,
      {
        opacity: 1,
        y: 0,
        duration: ITEMS_DURATION,
        stagger: ITEMS_STAGGER
      },
      img ? `-=${ITEMS_OVERLAP}` : 0
    );

});
}
