import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';
export default function contactsBlockAnimation() {
  gsap.registerPlugin(ScrollTrigger);
  const items = document.querySelectorAll('.contact-blocks__item');

  items.forEach((item, index) => {
    const label = item.querySelector('.contact-blocks__label');
    const icon = item.querySelector('.contact-blocks__label svg');
    const value = item.querySelector('.contact-blocks__value');
    let tl = gsap.timeline({
      scrollTrigger: {
        trigger: item,
        start: 'top 80%',
        markers: true
      }
    });
    const duration = 1.5;
    const inner_delay = '-=1';
    tl.from(item, {
      opacity: 0,
      y: 50,
      duration,
      delay: index * 0.3,
      ease: 'power2.out'
    });
    tl.from(
      label,
      {
        opacity: 0,
        duration,
        ease: 'power2.out'
      },
      inner_delay
    )
      .from(
        icon,
        {
          scale: 0.8,
          opacity: 0,
          duration,
          ease: 'power2.out'
        },
        inner_delay
      )
      .from(
        value,
        {
          opacity: 0,
          duration,
          ease: 'power2.out'
        },
        inner_delay
      );
  });
}
