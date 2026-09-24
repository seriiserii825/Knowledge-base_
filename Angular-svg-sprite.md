# Angular SVG Sprite

## Overview

SVG Sprite позволяет хранить все SVG-иконки проекта в одном файле `sprite.svg` и использовать их через идентификатор.

Например:

```html
<app-icon name="search" />
<app-icon name="heart" [size]="32" />
<app-icon name="arrow-right" [size]="20" />
```

Исходные SVG можно экспортировать напрямую из Figma.

---

## 1. Структура проекта

Создаем следующую структуру:

```text
project/
├── scripts/
│   └── generate-icons.mjs
│
├── src/
│   ├── icons/
│   │   ├── search.svg
│   │   ├── user.svg
│   │   ├── heart.svg
│   │   ├── close.svg
│   │   └── arrow-right.svg
│   │
│   └── app/
│       └── shared/
│           └── components/
│               └── icon/
│                   └── icon.ts
│
├── public/
│   └── icons/
│       └── sprite.svg
│
└── package.json
```

Папка:

```text
src/icons/
```

содержит исходные SVG, экспортированные из Figma.

Файл:

```text
public/icons/sprite.svg
```

генерируется автоматически и не должен редактироваться вручную.

---

## 2. Экспорт SVG из Figma

Экспортируем каждую иконку отдельно в формате SVG.

Например:

```text
search.svg
user.svg
heart.svg
close.svg
arrow-right.svg
```

Название файла будет использоваться как ID иконки.

Например:

```text
search.svg
```

превратится в:

```svg
<symbol id="search" viewBox="0 0 24 24">
    ...
</symbol>
```

А:

```text
arrow-right.svg
```

превратится в:

```svg
<symbol id="arrow-right" viewBox="0 0 24 24">
    ...
</symbol>
```

Поэтому SVG лучше сразу называть понятно:

```text
search.svg
user.svg
heart.svg
arrow-left.svg
arrow-right.svg
chevron-down.svg
close.svg
menu.svg
```

---

## 3. Установка svgstore

Устанавливаем пакет:

```bash
npm install -D svgstore
```

Он будет использоваться только во время разработки/build, поэтому устанавливаем его как `devDependency`.

---

## 4. Создание генератора Sprite

Создаем:

```text
scripts/generate-icons.mjs
```

Содержимое:

```js
import fs from 'node:fs'
import path from 'node:path'
import svgstore from 'svgstore'

const iconsDir = path.resolve('src/icons')
const outputFile = path.resolve('public/icons/sprite.svg')

const sprites = svgstore({
  inline: true,
})

const files = fs
  .readdirSync(iconsDir)
  .filter(file => file.endsWith('.svg'))

for (const file of files) {
  const id = path.basename(file, '.svg')

  const svg = fs.readFileSync(
    path.join(iconsDir, file),
    'utf8'
  )

  sprites.add(id, svg)
}

fs.mkdirSync(path.dirname(outputFile), {
  recursive: true,
})

fs.writeFileSync(
  outputFile,
  sprites.toString()
)

console.log(`✓ Generated ${files.length} icons`)
console.log(`✓ ${outputFile}`)
```

---

## 5. Добавление npm команды

В `package.json` добавляем:

```json
{
  "scripts": {
    "icons": "node scripts/generate-icons.mjs"
  }
}
```

Теперь можно выполнить:

```bash
npm run icons
```

Команда:

1. читает все `.svg` из `src/icons`;
2. берет имя каждого файла;
3. использует имя как `id`;
4. превращает SVG в `<symbol>`;
5. объединяет все иконки;
6. создает `public/icons/sprite.svg`.

Например:

```text
src/icons/
├── search.svg
├── user.svg
├── heart.svg
├── close.svg
└── arrow-right.svg
```

превратятся в один:

```text
public/icons/sprite.svg
```

примерно следующего вида:

```svg
<svg xmlns="http://www.w3.org/2000/svg">

  <symbol id="search" viewBox="0 0 24 24">
    ...
  </symbol>

  <symbol id="user" viewBox="0 0 24 24">
    ...
  </symbol>

  <symbol id="heart" viewBox="0 0 24 24">
    ...
  </symbol>

  <symbol id="close" viewBox="0 0 24 24">
    ...
  </symbol>

  <symbol id="arrow-right" viewBox="0 0 24 24">
    ...
  </symbol>

</svg>
```

---

## 6. Автоматическая генерация перед запуском Angular

Чтобы не запускать `npm run icons` вручную, можно использовать npm scripts `prestart` и `prebuild`.

Например:

```json
{
  "scripts": {
    "icons": "node scripts/generate-icons.mjs",

    "prestart": "npm run icons",
    "start": "ng serve",

    "prebuild": "npm run icons",
    "build": "ng build"
  }
}
```

Теперь:

```bash
npm start
```

автоматически выполнит:

```text
npm run icons
↓
ng serve
```

А:

```bash
npm run build
```

автоматически выполнит:

```text
npm run icons
↓
ng build
```

Таким образом workflow становится:

```text
Figma
  ↓
Export SVG
  ↓
src/icons/
  ↓
npm start / npm run build
  ↓
generate-icons.mjs
  ↓
public/icons/sprite.svg
  ↓
Angular <app-icon>
```

---

# Angular Icon Component

## 7. Создание типа IconName

Чтобы TypeScript проверял существующие названия иконок, создаем union type.

Например:

```ts
export type IconName =
  | 'search'
  | 'user'
  | 'heart'
  | 'close'
  | 'arrow-left'
  | 'arrow-right'
```

Это дает autocomplete в IDE и защищает от ошибок.

Например:

```html
<app-icon name="search" />
```

валидно.

А:

```html
<app-icon name="seacrh" />
```

будет ошибкой TypeScript/Angular.

---

## 8. Полный Icon Component

Создаем:

```text
src/app/shared/components/icon/icon.ts
```

```ts
import {
  ChangeDetectionStrategy,
  Component,
  input,
} from '@angular/core'

export type IconName =
  | 'search'
  | 'user'
  | 'heart'
  | 'close'
  | 'arrow-left'
  | 'arrow-right'

@Component({
  selector: 'app-icon',
  standalone: true,
  template: `
    <svg
      [attr.width]="width()"
      [attr.height]="height()"
      [attr.aria-hidden]="!label()"
      [attr.aria-label]="label() || null"
      [attr.role]="label() ? 'img' : null"
      focusable="false"
    >
      <use [attr.href]="iconPath"></use>
    </svg>
  `,
  styles: `
    :host {
      display: inline-flex;
      flex-shrink: 0;
      line-height: 0;
    }

    svg {
      display: block;
    }
  `,
  changeDetection: ChangeDetectionStrategy.OnPush,
})
export class Icon {
  name = input.required<IconName>()

  size = input<number | string>()

  width = input<number | string>(24)
  height = input<number | string>(24)

  label = input<string>()

  get iconPath(): string {
    return `/icons/sprite.svg#${this.name()}`
  }

  get iconWidth(): number | string {
    return this.size() ?? this.width()
  }

  get iconHeight(): number | string {
    return this.size() ?? this.height()
  }
}
```

Если нужен один параметр `size`, лучше использовать следующую версию template:

```ts
template: `
  <svg
    [attr.width]="iconWidth"
    [attr.height]="iconHeight"
    [attr.aria-hidden]="!label()"
    [attr.aria-label]="label() || null"
    [attr.role]="label() ? 'img' : null"
    focusable="false"
  >
    <use [attr.href]="iconPath"></use>
  </svg>
`,
```

Таким образом можно использовать как `size`, так и отдельные `width` / `height`.

---

# Использование

## 9. Импорт компонента

В standalone компоненте:

```ts
import { Component } from '@angular/core'

import { Icon } from '@/shared/components/icon/icon'

@Component({
  selector: 'app-header',
  standalone: true,
  imports: [
    Icon,
  ],
  templateUrl: './header.html',
})
export class Header {}
```

---

## 10. Простая иконка

```html
<app-icon name="search" />
```

По умолчанию:

```text
24 × 24
```

---

## 11. Изменение размера

```html
<app-icon
  name="search"
  [size]="32"
/>
```

Результат:

```text
32 × 32
```

Можно использовать разные размеры:

```html
<app-icon name="search" [size]="16" />

<app-icon name="search" [size]="20" />

<app-icon name="search" [size]="24" />

<app-icon name="search" [size]="32" />

<app-icon name="search" [size]="48" />
```

---

## 12. Width и Height отдельно

Это полезно для иконок, которые не квадратные.

```html
<app-icon
  name="arrow-right"
  [width]="32"
  [height]="16"
/>
```

---

# Цвет иконок

## 13. currentColor

Если иконка должна менять цвет через CSS, внутри SVG желательно использовать:

```svg
fill="currentColor"
```

или:

```svg
stroke="currentColor"
```

Например:

```svg
<path
  d="..."
  fill="currentColor"
/>
```

или:

```svg
<path
  d="..."
  stroke="currentColor"
  stroke-width="2"
/>
```

Тогда цвет SVG наследуется из CSS-свойства:

```css
color
```

---

## 14. Изменение цвета через CSS

Например:

```html
<button class="favorite">
  <app-icon name="heart" [size]="20" />

  Add to favorites
</button>
```

```scss
.favorite {
  color: #333;

  &:hover {
    color: #335cd8;
  }
}
```

И текст, и SVG поменяют цвет.

---

## 15. Только цвет иконки

Можно стилизовать сам компонент:

```scss
app-icon {
  color: #335cd8;
}
```

Или:

```html
<app-icon
  class="search-icon"
  name="search"
  [size]="24"
/>
```

```scss
.search-icon {
  color: #335cd8;
}
```

---

# Accessibility

## 16. Декоративные иконки

Большинство иконок внутри кнопок являются декоративными:

```html
<button>
  <app-icon name="search" />

  Search
</button>
```

В таком случае компонент автоматически использует:

```html
aria-hidden="true"
```

потому что текст `Search` уже объясняет назначение кнопки.

---

## 17. Иконка без текста

Если иконка сама несет смысл:

```html
<app-icon
  name="search"
  label="Search"
/>
```

компонент создаст:

```html
<svg
  role="img"
  aria-label="Search"
>
  ...
</svg>
```

Но для кнопок без видимого текста лучше задавать `aria-label` самой кнопке:

```html
<button aria-label="Search">
  <app-icon name="search" />
</button>
```

---

# Добавление новой иконки

Допустим, в Figma появилась новая иконка:

```text
calendar.svg
```

## Шаг 1

Экспортируем ее в:

```text
src/icons/calendar.svg
```

## Шаг 2

Добавляем название в `IconName`:

```ts
export type IconName =
  | 'search'
  | 'user'
  | 'heart'
  | 'close'
  | 'arrow-left'
  | 'arrow-right'
  | 'calendar'
```

## Шаг 3

Генерируем sprite:

```bash
npm run icons
```

Либо просто:

```bash
npm start
```

если настроен `prestart`.

## Шаг 4

Используем:

```html
<app-icon
  name="calendar"
  [size]="24"
/>
```

---

# Итоговая схема

```text
Figma
│
│ Export SVG
▼
src/icons/
│
├── search.svg
├── user.svg
├── heart.svg
├── close.svg
└── calendar.svg
│
│ npm run icons
▼
scripts/generate-icons.mjs
│
▼
public/icons/sprite.svg
│
├── #search
├── #user
├── #heart
├── #close
└── #calendar
│
▼
Angular
│
▼
<app-icon name="search" />
<app-icon name="heart" [size]="32" />
<app-icon name="calendar" [size]="24" />
```

---

# Основные команды

Установить генератор:

```bash
npm install -D svgstore
```

Сгенерировать sprite:

```bash
npm run icons
```

Запустить Angular с предварительной генерацией sprite:

```bash
npm start
```

Production build с предварительной генерацией sprite:

```bash
npm run build
```

---

# Кратко

Исходные иконки хранятся отдельно:

```text
src/icons/*.svg
```

Команда:

```bash
npm run icons
```

собирает их в:

```text
public/icons/sprite.svg
```

Каждый filename становится ID:

```text
search.svg      → #search
heart.svg       → #heart
arrow-right.svg → #arrow-right
```

Angular-компонент:

```html
<app-icon name="search" />
```

внутри использует:

```html
<svg>
  <use href="/icons/sprite.svg#search"></use>
</svg>
```

Размер:

```html
<app-icon
  name="search"
  [size]="32"
/>
```

Цвет контролируется через:

```scss
app-icon {
  color: #335cd8;
}
```

если SVG использует:

```svg
fill="currentColor"
```

или:

```svg
stroke="currentColor"
```
