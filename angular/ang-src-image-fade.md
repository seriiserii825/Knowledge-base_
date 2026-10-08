# Рабочий пример: fade-эффект при смене изображения (product-slider)

Реализовано через нативный Angular `animate.enter` / `animate.leave`
(Angular 18+, без пакета `@angular/animations`). Каждый слайд рендерится
в своём собственном `@if`-блоке — поэтому при переключении слайда Angular
реально удаляет старый `<img>` из DOM (срабатывает `animate.leave`) и
создаёт новый (срабатывает `animate.enter`), а не просто меняет `src` у
существующего узла.

Путь в проекте: `src/app/components/single-product/product-slider/`

## product-slider.ts

```ts
import { Component, input, signal } from '@angular/core'

import { ImageUrlPipe } from '@/shared/pipes/image-url-pipe'
import { IProduct } from '@/shared/types/IProduct'

@Component({
  imports: [ImageUrlPipe],
  selector: 'app-product-slider',
  styles: ``,
  templateUrl: './product-slider.html',
})
export class ProductSlider {
  product = input.required<IProduct>()

  currentSlide = signal(0)

  onSlideChange(index: number) {
    this.currentSlide.set(index)
  }
}
```

## product-slider.html

```html
<div class="flex flex-col gap-4">
  @if (product().images.length) {
    <div
      class="relative aspect-square overflow-hidden rounded-2xl bg-slate-100">
      @for (image of product().images; track image; let idx = $index) {
        @if (idx === currentSlide()) {
          <img
            [src]="image | imageUrl"
            alt="Sencha Green Tea"
            class="absolute inset-0 h-full w-full object-cover"
            animate.enter="fade-in"
            animate.leave="fade-out" />
        }
      }
    </div>
    @if (product().images.length > 1) {
      <div class="flex gap-4">
        @for (item of product().images; track item; let i = $index) {
          <button
            type="button"
            (click)="onSlideChange(i)"
            class="size-24 overflow-hidden rounded-xl border-2 border-transparent bg-slate-100 transition-colors hover:border-slate-300"
            [class.border-slate-300]="currentSlide() === i">
            <img
              [src]="item | imageUrl"
              alt="Sencha Green Tea"
              class="h-full w-full object-cover" />
          </button>
        }
      </div>
    }
  }
</div>
```

## Глобальные стили (`src/styles.css`)

Keyframes сами по себе ничего не анимируют — Angular навешивает именно
CSS-**класс** с именем из `animate.enter`/`animate.leave` и ждёт событие
`animationstart`/`animationend` на элементе. Поэтому нужен не только
`@keyframes`, но и класс, который на него ссылается через `animation:`:

```css
.fade-in {
  animation: fade-in 0.2s ease-out;
}

.fade-out {
  animation: fade-out 0.2s ease-in;
}

@keyframes fade-in {
  from {
    opacity: 0;
    transform: translateY(4px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes fade-out {
  from {
    opacity: 1;
    transform: translateY(0);
  }
  to {
    opacity: 0;
    transform: translateY(-4px);
  }
}
```

## Ключевые моменты, из-за которых эффект сначала не работал

1. **Атрибут должен быть `animate.leave` (через точку), а не
   `animate-leave` (через дефис).** Angular-компилятор распознаёт ровно
   `animate.enter`/`animate.leave` — дефисный вариант он просто
   игнорирует как обычный статический HTML-атрибут.
2. **Нужны CSS-классы `.fade-in`/`.fade-out`, а не только `@keyframes`.**
   Angular добавляет на элемент класс по имени из `animate.enter`/`leave`
   и слушает `animationstart`/`animationend` — голый `@keyframes` без
   класса, который на него ссылается через `animation: <name> ...`,
   никак не срабатывает.
3. **`animate.enter`/`animate.leave` триггерятся вставкой/удалением
   DOM-узла, а не изменением атрибута `[src]` у одного и того же узла.**
   Если просто менять `[src]` у постоянного `<img>`, анимация не
   запустится — браузер не удаляет и не вставляет элемент, он лишь
   обновляет его содержимое.
4. **`@for` с одним элементом и меняющимся `track`-ключом — ненадёжный
   способ форсировать пересоздание узла.** Первая попытка была такой:
   ```html
   @for (image of [product().images[currentSlide()]]; track currentSlide()) {
     <img [src]="image | imageUrl" animate.enter="fade-in" animate.leave="fade-out" />
   }
   ```
   Технически похоже на keyed-diff, но на практике фейд не проигрывался.
   Надёжный вариант — отдельный `@if`-блок на каждый слайд (как в этом
   файле), это тот же паттерн, что уже использовался в проекте для
   `login-page.html` (`@if`/`@else` между формой логина и регистрации).
5. **`position: absolute` + `inset-0` на `<img>` и `position: relative`
   на контейнере** — чтобы во время 200ms, пока одновременно существуют
   уходящий (fade-out) и приходящий (fade-in) `<img>`, они накладывались
   друг на друга (кросс-фейд), а не распирали `flex`-контейнер в две
   колонки.
