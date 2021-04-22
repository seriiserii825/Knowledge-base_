Все единицы измеряются в пикселях, но в js файлах пишутся без px.
clientWidth, clientHeight - высота и ширина без учета margin border. Зависит от box-sizing. 
offsetWidth, offsetHeight - высота, ширина + border + margin. 
scrollHeight - полная высота + полоса прокрутки, если блок находится в блоке с overflow scroll
scrollTop - контент сверху проскроленный, который не показывается. Это свойства может быть модифицированно. 
document.documentElement.scrollTop - scroll для документа
document.querySelector('.offer__slider-wrapper').getBoundingClientRect() - получает все координаты элемента, зависимо от скролла страницы
getComputedStyle(wrapper) - получаем стили прописанные в css, но не inline через js, но не можем их менять. 
Scroll to element
window.scrollTo({
  top: contactFormOffsetTop,
  behavior: "smooth"
});
document.documentElement.scrollTop = '0';
windwo.scrollBy(0, 400); - скролл от текущего положения вниз
windwo.scrollTo(0, 400); - скролл от вверха страницы
window.pageYOffset - прокручеваемая часть окна
document.documentElement.clientHeight = высота текущего окна браузера.
window.addEventListener('scroll', function() {
  console.log(window.pageYOffset);// скольок было проспкролленно с начала страницы
});


target.scrollHeight - вся высота скроллируемой части
target.clientHeight - высота блока, который мы видим
target.scrollTop - высота блока, которого не видим сверху
target.clientHeight + target.scrollTop === target.scrollHeight - было проскроллено до конца
