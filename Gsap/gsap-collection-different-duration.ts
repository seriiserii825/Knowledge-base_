import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';
export default function aboutLoopAnimation() {
  gsap.registerPlugin(ScrollTrigger);
  const items = document.querySelectorAll('.about-loop__item');

  items.forEach((item, index) => {
    const img = item.querySelector('.about-loop__img');
    const text = item.querySelector('.about-loop__text');
    const direction = index % 2 === 0 ? 1 : -1; // Alternate direction for each item
    let tl = gsap.timeline({
      scrollTrigger: {
        trigger: item,
        start: 'top 80%',
        markers: true
      }
    });
    tl.from(img, {
      xPercent: 40 * direction,
      duration: 1.5,
      ease: 'power2.out'
    });
    tl.from(
      img,
      {
        filter: 'grayscale(100%) blur(1px)',
        duration: 2.5,
        ease: 'none'
      },
      '<'
    ); // start at same time
    tl.from(
      text,
      {
        y: 20,
        opacity: 0,
        duration: 1.5,
        ease: 'power2.out'
      },
      '-=2'
    ); // Overlap with previous animation
  });
}
