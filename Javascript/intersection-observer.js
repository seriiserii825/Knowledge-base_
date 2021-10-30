export const animateOnScroll = () => {
  const options = {
    // родитель целевого элемента - область просмотра
    root: null,
    // без отступов
    rootMargin: '0px',
    // процент пересечения - половина изображения
    threshold: 0.1
  }

  // создаем наблюдатель
  const observer = new IntersectionObserver((entries, observer) => {
    // для каждой записи-целевого элемента
    entries.forEach(entry => {
      // если элемент является наблюдаемым
      if (entry.isIntersecting) {
        const block = entry.target
        // выводим информацию в консоль - проверка работоспособности наблюдателя
        console.log(block)
        // меняем фон контейнера
        block.classList.add('scrolled');
        // прекращаем наблюдение
        observer.unobserve(block);
      }
    })
  }, options)

  const arr = document.querySelectorAll('.js-scroll')
  arr.forEach(i => {
    observer.observe(i)
  })
}
