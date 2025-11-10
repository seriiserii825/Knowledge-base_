import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

export default function assistanceAnimation() {
  gsap.registerPlugin(ScrollTrigger);
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  const tl = gsap.timeline({
    scrollTrigger: {
      trigger: '.assistance',
      start: '0% 80%',
      markers: false
    },
    defaults: { ease: 'power4.out' }
  });

  // 1) Title first
  tl.from('.assistance__title', { opacity: 0, y: 50, duration: 1 });

  // 2) Then items, each with its own internal sequence
  const items = gsap.utils.toArray('.assistance__item') as HTMLElement[];
  const itemGap = 0; // delay between items

  items.forEach((item, idx) => {
    const icon = item.querySelector('.assistance__icon svg');
    const label = item.querySelector('.assistance__label');
    const value = item.querySelector('.assistance__value');

    const itemTl = gsap.timeline({ defaults: { ease: 'power4.out' } });

    // Optional: bring the whole card in a touch first
    itemTl.from(item, { opacity: 0, y: 16, duration: 1 });
    const duration = 0.6;
    const item_delay = '-=0.4';
    if (icon)
      itemTl.from(icon, { x: 30, opacity: 0, duration }, item_delay);
    if (label) itemTl.from(label, { x: 20, opacity: 0, duration }, item_delay);
    if (value) itemTl.from(value, { x: 30, opacity: 0, duration }, item_delay);

    // Add this item’s animation after the title / previous item
    tl.add(itemTl);

    // Add a gap before the next item (not after the last)
    if (idx < items.length - 1) {
      tl.to({}, { duration: itemGap });
    }
  });
}
