import gsap from 'gsap';
export default function pageIntroAnimation() {
  const title = document.querySelector('.page-intro__title') as HTMLElement;
  const title_text = title?.textContent as string;
  const letters = title_text.split('');
  title.textContent = '';
  letters.map((letter) => {
    const safe = letter === ' ' ? '&nbsp;' : letter;
    title.innerHTML += `<span class="letter">${safe}</span>`;
  });

  let tl = gsap.timeline();
  tl.from('.page-intro__img', {
    filter: 'grayscale(100%) blur(4px)',
    duration: 3,
    ease: 'power2.out'
  });
  tl.from(
    '.letter',
    {
      y: '100%',
      // x: '34px',
      opacity: 0.2,
      color: '#3A7CA5',
      duration: 1,
      ease: 'power3.out',
      stagger: {
        each: 0.08,
        from: 'start',
        // repeat: -1,
        // yoyo: true
      },
      clearProps: 'transform,opacity'
    },
    '-=2.5'
  );
}
