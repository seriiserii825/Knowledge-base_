export default function fixedHeader() {
  const header = document.querySelector('.main-header') as HTMLElement | null;
  if (!header) return;

  const body = document.body;
  const fixedClass = 'fixed';
  const smallClass = 'small';

  const headerTop = header.getBoundingClientRect().top + window.scrollY;
  const headerHeight = header.offsetHeight;

  window.addEventListener('scroll', () => {
    const scrollY = window.scrollY;

    // Toggle .fixed
    if (scrollY > headerTop) {
      if (!header.classList.contains(fixedClass)) {
        header.classList.add(fixedClass);
        body.style.paddingTop = `${headerHeight}px`;
      }
    } else {
      if (header.classList.contains(fixedClass)) {
        header.classList.remove(fixedClass);
        body.style.paddingTop = '0px';
      }
    }

    // Toggle .small after 50 px of scroll while fixed
    if (scrollY > headerTop + 100) {
      header.classList.add(smallClass);
    } else {
      header.classList.remove(smallClass);
    }
  });
}
