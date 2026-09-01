### Кастомный clip-path для картинки через inline SVG + CSS `clip-path: url(#...)`

Задача: обрезать картинку по сложной форме (со скошенными/срезанными углами), которую не сделать через `border-radius`, и при этом иметь возможность нарисовать поверх декоративную обводку той же формы (двухцветная рамка, как в Figma-макетах).

Решение — два элемента поверх друг друга:

1. Инлайновый SVG с `<clipPath>` (для обрезки картинки через CSS) + декоративный `<path>`-контур (для рамки поверх).
2. `<picture>/<img>` с `clip-path: url('#id-клипа')`.

#### 1. SVG-партиал (PHP-пример, но подходит для любого шаблонизатора)

```php
<svg width="791" height="618" viewBox="0 0 791 618" fill="none" xmlns="http://www.w3.org/2000/svg" class="block__img-frame">
<defs>
<clipPath id="block-image-clip" clipPathUnits="objectBoundingBox">
<path d="M0.628963 0.087370C0.635908 0.101476 ... Z"/>
</clipPath>
</defs>
<!-- декоративная обводка той же формы, отрисованная маской (обычная толщина линии не искажается clipPathUnits) -->
<mask id="block-outline-mask" fill="white">
<path d="M497.51 53.9945C503.003 62.7119 ... Z"/>
</mask>
<path d="..." fill="#C91F2C" mask="url(#block-outline-mask)"/>
</svg>
```

Ключевые моменты:

- `clipPathUnits="objectBoundingBox"` — координаты `path` внутри `clipPath` заданы в долях от 0 до 1 (а не в пикселях), поэтому клип автоматически растягивается под реальный размер картинки в разметке, не совпадающий с `viewBox` SVG.
- Путь для `clipPath` и путь для декоративного контура — это **одна и та же форма**, просто у первого координаты переведены в диапазон 0–1 (поделены на width/height), а у второго оставлены в пикселях viewBox'а для отрисовки обводки.
- Обводка через `mask`, а не просто `stroke`, — так толщина линии рамки не зависит от искажения формы и остаётся ровной по всему контуру.
- `id` у `clipPath` и `mask` должны быть уникальны на странице — если один и тот же SVG-партиал используется в нескольких блоках, префиксуйте id именем блока (`support-image-clip`, `home-intro-image-clip` и т.п.), иначе будет конфликт и клип сломается там, где подключён вторым.

#### 2. Разметка блока

```php
<div class="block__img">
  <?php get_template_part('modules/block/icon-block-image-clip-path'); ?>
  <picture><img src="..." alt=""></picture>
</div>
```

SVG-партиал подключается первым (он просто определяет `clipPath` и рисует поверх декоративную рамку), картинка — вторым.

#### 3. CSS

```scss
.block {
  &__img {
    position: relative;
    aspect-ratio: 1.28 / 1; // = 791/618, соотношение сторон исходного SVG

    .block__img-frame {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      z-index: 2; // поверх картинки
      pointer-events: none;
    }

    picture {
      position: absolute;
      display: block;
      inset: 11px; // отступ картинки внутрь рамки, если рамка толще самого клипа
    }

    img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
      clip-path: url('#block-image-clip');
    }
  }
}
```

#### Как получить путь для `clipPath`

Из Figma/дизайна экспортируется SVG с нужной формой (обычно это `path` с `fill`, без всякого клиппинга). Дальше:

1. Взять `d` этого path как есть — это и есть путь для декоративного контура (координаты в пикселях исходного `viewBox`).
2. Получить версию в `objectBoundingBox` — либо руками поделить каждую координату на `width`/`height` SVG, либо (проще) прогнать SVG через инструмент вроде [SVG Path Editor](https://yqnn.github.io/svg-path-editor/) / any online path-to-0..1-normalizer, либо попросить дизайнера/Figma-плагин сразу отдать normalized path.
3. Вставить нормализованный путь в `<clipPath clipPathUnits="objectBoundingBox">`.

#### Грабли

- Если вставить в `<clipPath>` путь **в пиксельных координатах вместо 0–1** (или наоборот) — либо клип не применится вообще, либо обрежет картинку в один угол/за пределы. `clipPathUnits="objectBoundingBox"` обязателен для координат 0–1.
- CSS `clip-path: url(...)` не работает на элементах с `display: none` внутри самого SVG-source, но сам SVG с `clipPath` можно спрятать (`display: none` на `<svg>` не годится в некоторых браузерах — надёжнее держать SVG в потоке, как в примере выше, а не прятать его).
- Не вставляйте в SVG-партиал случайно склеенный бинарный контент (например, вставленный по ошибке base64 картинки без обёртки в `<image>`/data-URI) — файл может стать несколько мегабайт и сломать парсинг SVG. Партиал должен содержать только векторные `path`/`mask`/`clipPath`.
