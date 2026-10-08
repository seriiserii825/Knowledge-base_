# Fade-эффект в Angular — способы реализации

## 1. Нативный `animate.enter` / `animate-leave` (Angular 18+, без пакетов)

Начиная с Angular 18 (включая этот проект — Angular 22) есть встроенные
директивы `animate.enter` / `animate-leave`, которые не требуют пакета
`@angular/animations`. Они триггерятся **вставкой/удалением DOM-узла** —
то есть срабатывают, когда элемент появляется или исчезает из DOM через
`@if`, `@for`, `@switch`.

Механика простая: в атрибут передаётся имя CSS-класса (или нескольких),
который Angular сам вешает/снимает в нужный момент — а дальше работает
обычный CSS: либо `@keyframes`-анимация, либо `transition`.

**Реальный пример из этого проекта** — `src/app/pages/login-page/login-page.html:8-18`:

```html
@if (isLoginFormVisible()) {
  <app-login-form
    animate.enter="fade-in"
    animate-leave="fade-out"
    (switchToRegister)="isLoginFormVisible.set(false)" />
} @else {
  <app-register-form
    animate.enter="fade-in"
    animate-leave="fade-out"
    (switchToLogin)="isLoginFormVisible.set(true)" />
}
```

Ключевые кадры объявлены глобально — `src/styles.css:66-86`:

```css
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

Плюсы: ноль зависимостей, декларативно, работает из коробки с
`@if`/`@for`. Минус: работает только на вставку/удаление узла, не на
изменение атрибута существующего узла (см. раздел 5).

## 2. CSS-only через toggle класса + `transition`

Самый простой вариант без `@keyframes` вообще — держать булевый
flag/signal и навешивать класс, а fade делать через `transition: opacity`:

```html
<div [class.opacity-100]="visible()" [class.opacity-0]="!visible()"
     class="transition-opacity duration-300">
  Контент
</div>
```

```ts
visible = signal(false);
```

Разница с разделом 1: `transition` анимирует переход между двумя
состояниями одного и того же свойства (`opacity: 0` → `opacity: 1`) —
элемент не исчезает из DOM, просто меняется стиль. Это проще, но не
годится, если нужно убрать элемент из DOM после fade-out (для этого
либо `@keyframes` + `animate-leave`, либо `(transitionend)` + таймаут.

## 3. Пакет `@angular/animations`: `trigger` / `transition` / `style` / `animate`

Классический Angular Animations API (в этом проекте **не установлен** —
в `package.json` зависимости `@angular/animations` нет). Нужен, когда
требуется более тонкий контроль: `stagger` (анимация по очереди для
списка), `group`/`query` (анимировать несколько дочерних элементов),
программный запуск через `AnimationBuilder`.

Установка: `npm install @angular/animations`, подключение провайдера
`provideAnimationsAsync()` в `app.config.ts`.

```ts
import { trigger, transition, style, animate } from '@angular/animations';

@Component({
  animations: [
    trigger('fade', [
      transition(':enter', [
        style({ opacity: 0 }),
        animate('200ms ease-in', style({ opacity: 1 })),
      ]),
      transition(':leave', [
        animate('200ms ease-out', style({ opacity: 0 })),
      ]),
    ]),
  ],
})
export class SomeComponent {}
```

```html
<div *ngIf="visible" @fade>Контент</div>
```

Плюсы: мощный императивный контроль, `stagger`/`group`/`query`, тестируемость
через `AnimationBuilder`. Минус: лишняя зависимость и больше бойлерплейта —
если хватает раздела 1, он предпочтительнее.

## 4. View Transitions API через Angular Router (`withViewTransitions()`)

Для fade/cross-fade **между роутами** Angular Router умеет использовать
нативный браузерный View Transitions API:

```ts
provideRouter(routes, withViewTransitions());
```

```css
::view-transition-old(root),
::view-transition-new(root) {
  animation-duration: 300ms;
}
```

Это браузерный механизм (Chromium/эквиваленты), Angular просто оборачивает
навигацию в `document.startViewTransition()`. Хорош конкретно для переходов
между страницами, не для локальных UI-эффектов внутри компонента.

## 5. Нюанс: fade при смене `[src]` у `<img>`

Частая ловушка: вешаешь `animate.enter`/`animate-leave` на `<img>`, у
которого меняется только `[src]` — и ничего не происходит. Причина: эти
директивы триггерятся **пересозданием узла**, а не изменением атрибута.
Один и тот же DOM-элемент просто меняет картинку "на месте", без
удаления/вставки — анимация не запускается.

Приём, чтобы форсировать пересоздание узла: обернуть элемент в `@for` с
единственным элементом, где `track` — это само меняющееся значение
(например, индекс слайда). Тогда при каждом изменении Angular считает это
"другим" элементом коллекции → удаляет старый узел (срабатывает
`animate-leave`) и вставляет новый (`animate.enter`):

```html
@for (image of [images()[currentSlide()]]; track currentSlide()) {
  <img
    [src]="image"
    animate.enter="fade-in"
    animate-leave="fade-out" />
}
```

(Этот сценарий разбирали на примере `product-slider` в этом проекте —
`src/app/components/single-product/product-slider/`, где главное
изображение сейчас переключается мгновенно через `[src]`.)

## 6. Сравнение подходов

| Способ | Зависимости | Когда применять |
|---|---|---|
| `animate.enter`/`animate-leave` + CSS | нет | Дефолтный выбор: fade при `@if`/`@for`, уже используется в проекте |
| CSS toggle + `transition` | нет | Простой fade без удаления из DOM, без keyframes |
| `@angular/animations` | `@angular/animations` | Нужен `stagger`/`group`/`query`/программный контроль |
| `withViewTransitions()` | нет (нативный API браузера) | Fade между страницами при навигации роутера |

Для нового UI в этом проекте по умолчанию стоит брать способ 1 — он уже
принят как паттерн (`login-page`) и не тянет лишних зависимостей.
