### iOS Safari: SVG-иконки внутри `<button>` синие

Проблема: если иконка — это SVG с `fill: currentcolor` (например через глобальный класс типа `.svg-color svg *[fill] { fill: currentcolor; }`), и она лежит внутри `<button>`, то на iOS Safari `<button>` по умолчанию красит текст/цвет в системный акцентный синий. Родительский `color` при этом не наследуется автоматически, поэтому `currentcolor` в SVG подхватывает дефолтный синий iOS, а не нужный цвет.

На десктопе и в других браузерах бага не видно — там `<button>` и так наследует `color` от родителя.

```css
button {
  color: inherit; /* без этого на iOS будет системный синий */
  appearance: none; /* сбрасывает нативный chrome кнопки, который может переопределять color */
  background: transparent;
  border: none;
}
```

Оба свойства нужны вместе:

- `color: inherit` — явно наследует цвет от родителя вместо цвета браузера по умолчанию
- `appearance: none` — убирает нативный iOS-стайлинг самой кнопки (без него `color: inherit` иногда всё равно перебивается системным chrome)

Пример реального фикса (`nav-mobile.scss`):

```scss
.nav-mobile {
  color: black;

  &__item {
    color: inherit;
    background: transparent;
    border: none;
    appearance: none;
  }
}
```

Проверять всегда на реальном iOS Safari (или iOS-симуляторе) — в Chrome DevTools device emulation этот баг не воспроизводится.
