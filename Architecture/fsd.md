# FSD структура для простого проекта недвижимости

## 1. Главная идея

FSD делит проект не просто на `components`, `api`, `stores`, а по смыслу:

```text
app       // настройки приложения
pages     // страницы
widgets   // крупные блоки страницы
features  // действия пользователя
entities  // бизнес-сущности
shared    // общий переиспользуемый код
```

Главное правило зависимостей:

```text
app
 ↓
pages
 ↓
widgets
 ↓
features
 ↓
entities
 ↓
shared
```

Нижний слой не должен импортировать верхний.

Например:

```text
features/filter-estates может импортировать entities/estate
entities/estate не должен импортировать features/filter-estates
```

---

# 2. Документация по папкам

## app

`app` — всё, что нужно для запуска приложения.

Здесь лежит глобальная настройка проекта:

```text
app/
├── router/
├── providers/
├── styles/
├── config/
├── layouts/
└── main.ts
```

Примеры:

```text
app/router        // роуты
app/providers     // Pinia, i18n, plugins
app/styles        // глобальные стили
app/config        // глобальные настройки
app/layouts       // основные layout'ы
main.ts           // точка входа
```

В `app` не кладём карточки недвижимости, фильтры, кнопки избранного.

---

## pages

`pages` — страницы сайта.

Страница собирает готовые виджеты.

```text
pages/
├── home/
├── estate-catalog/
├── estate-details/
├── favorites/
└── contacts/
```

Пример:

```text
pages/home/ui/HomePage.vue
```

Страница может использовать:

```text
widgets
features
entities
shared
```

Но страница не должна содержать много логики внутри себя.

---

## widgets

`widgets` — крупные блоки страницы.

Например:

```text
widgets/
├── header/
├── footer/
├── estate-list/
├── estate-map/
├── estate-search/
├── featured-estates/
├── recent-estates-slider/
└── reviews/
```

Widget обычно собирает:

```text
entities + features + shared/ui
```

Пример:

```text
EstateSearchWidget
├── FilterEstates feature
├── EstateList widget/entity
└── shared/ui components
```

---

## features

`features` — действия пользователя.

Правило:

> Если пользователь что-то делает — это feature.

Примеры:

```text
features/
├── filter-estates/
├── favorite-estate/
├── search-zone/
├── send-contact-request/
├── login/
├── register/
└── subscribe-newsletter/
```

Примеры действий:

```text
фильтровать недвижимость
добавить в избранное
искать зону
отправить заявку
войти в аккаунт
подписаться на новости
```

Feature может иметь внутри:

```text
ui/
model/
api/
lib/
index.ts
```

---

## entities

`entities` — бизнес-сущности.

Правило:

> Если объект существует в бизнесе — это entity.

Для недвижимости:

```text
entities/
├── estate/
├── location/
├── zone/
├── typology/
├── energy-class/
├── agent/
├── user/
└── review/
```

Примеры:

```text
Estate          // объект недвижимости
Location        // локация
Zone            // зона на карте
Typology        // квартира, вилла, дом
EnergyClass     // A, B, C, D
Agent           // агент
User            // пользователь
Review          // отзыв
```

Entity может иметь:

```text
ui/
model/
api/
lib/
index.ts
```

---

## shared

`shared` — общий код, который не знает про бизнес.

Правило:

> Если завтра удалить недвижимость и сделать интернет-магазин, shared почти не должен измениться.

```text
shared/
├── ui/
├── api/
├── lib/
├── composables/
├── constants/
├── types/
├── assets/
└── styles/
```

Примеры:

```text
shared/ui/AppButton.vue
shared/ui/AppInput.vue
shared/ui/AppSelect.vue
shared/ui/AppCheckbox.vue
shared/ui/AppModal.vue

shared/api/http.ts

shared/lib/formatPrice.ts
shared/lib/formatDate.ts

shared/composables/useDebounce.ts
shared/composables/useBreakpoints.ts
```

---

# 3. Вложенная структура простого проекта недвижимости

```text
src/
├── app/
│   ├── router/
│   │   └── index.ts
│   │
│   ├── providers/
│   │   ├── pinia.ts
│   │   └── i18n.ts
│   │
│   ├── styles/
│   │   ├── main.scss
│   │   ├── variables.scss
│   │   └── reset.scss
│   │
│   ├── config/
│   │   └── app.config.ts
│   │
│   ├── layouts/
│   │   └── MainLayout.vue
│   │
│   └── main.ts
│
├── pages/
│   ├── home/
│   │   ├── ui/
│   │   │   └── HomePage.vue
│   │   └── index.ts
│   │
│   ├── estate-catalog/
│   │   ├── ui/
│   │   │   └── EstateCatalogPage.vue
│   │   └── index.ts
│   │
│   ├── estate-details/
│   │   ├── ui/
│   │   │   └── EstateDetailsPage.vue
│   │   └── index.ts
│   │
│   ├── favorites/
│   │   ├── ui/
│   │   │   └── FavoritesPage.vue
│   │   └── index.ts
│   │
│   └── contacts/
│       ├── ui/
│       │   └── ContactsPage.vue
│       └── index.ts
│
├── widgets/
│   ├── header/
│   │   ├── ui/
│   │   │   ├── Header.vue
│   │   │   └── HeaderNav.vue
│   │   └── index.ts
│   │
│   ├── footer/
│   │   ├── ui/
│   │   │   └── Footer.vue
│   │   └── index.ts
│   │
│   ├── estate-search/
│   │   ├── ui/
│   │   │   └── EstateSearch.vue
│   │   └── index.ts
│   │
│   ├── estate-list/
│   │   ├── ui/
│   │   │   └── EstateList.vue
│   │   └── index.ts
│   │
│   ├── estate-map/
│   │   ├── ui/
│   │   │   ├── EstateMap.vue
│   │   │   └── EstateMapMarker.vue
│   │   ├── model/
│   │   │   └── useEstateMap.ts
│   │   └── index.ts
│   │
│   ├── featured-estates/
│   │   ├── ui/
│   │   │   └── FeaturedEstates.vue
│   │   └── index.ts
│   │
│   └── reviews/
│       ├── ui/
│       │   └── Reviews.vue
│       └── index.ts
│
├── features/
│   ├── filter-estates/
│   │   ├── ui/
│   │   │   ├── EstateFilter.vue
│   │   │   ├── PriceFilter.vue
│   │   │   ├── TypologyFilter.vue
│   │   │   ├── RoomsFilter.vue
│   │   │   ├── EnergyClassFilter.vue
│   │   │   └── LocationFilter.vue
│   │   │
│   │   ├── model/
│   │   │   ├── useEstateFilter.ts
│   │   │   ├── types.ts
│   │   │   └── constants.ts
│   │   │
│   │   ├── lib/
│   │   │   └── buildEstateFilterQuery.ts
│   │   │
│   │   └── index.ts
│   │
│   ├── favorite-estate/
│   │   ├── ui/
│   │   │   └── FavoriteButton.vue
│   │   │
│   │   ├── model/
│   │   │   ├── useFavoriteEstate.ts
│   │   │   └── types.ts
│   │   │
│   │   ├── api/
│   │   │   └── favoriteEstate.api.ts
│   │   │
│   │   └── index.ts
│   │
│   ├── search-zone/
│   │   ├── ui/
│   │   │   └── ZoneSearch.vue
│   │   ├── model/
│   │   │   └── useZoneSearch.ts
│   │   └── index.ts
│   │
│   └── send-contact-request/
│       ├── ui/
│       │   └── ContactAgentForm.vue
│       ├── model/
│       │   ├── useContactRequest.ts
│       │   └── types.ts
│       ├── api/
│       │   └── contactRequest.api.ts
│       └── index.ts
│
├── entities/
│   ├── estate/
│   │   ├── ui/
│   │   │   ├── EstateCard.vue
│   │   │   ├── EstateGallery.vue
│   │   │   └── EstatePrice.vue
│   │   │
│   │   ├── model/
│   │   │   ├── types.ts
│   │   │   └── estate.store.ts
│   │   │
│   │   ├── api/
│   │   │   └── estate.api.ts
│   │   │
│   │   ├── lib/
│   │   │   └── formatEstateAddress.ts
│   │   │
│   │   └── index.ts
│   │
│   ├── location/
│   │   ├── ui/
│   │   │   └── LocationBadge.vue
│   │   ├── model/
│   │   │   └── types.ts
│   │   ├── api/
│   │   │   └── location.api.ts
│   │   └── index.ts
│   │
│   ├── typology/
│   │   ├── model/
│   │   │   └── types.ts
│   │   ├── api/
│   │   │   └── typology.api.ts
│   │   └── index.ts
│   │
│   ├── energy-class/
│   │   ├── model/
│   │   │   └── types.ts
│   │   ├── api/
│   │   │   └── energyClass.api.ts
│   │   └── index.ts
│   │
│   ├── zone/
│   │   ├── model/
│   │   │   └── types.ts
│   │   ├── api/
│   │   │   └── zone.api.ts
│   │   └── index.ts
│   │
│   └── review/
│       ├── ui/
│       │   └── ReviewCard.vue
│       ├── model/
│       │   └── types.ts
│       ├── api/
│       │   └── review.api.ts
│       └── index.ts
│
└── shared/
    ├── ui/
    │   ├── AppButton.vue
    │   ├── AppInput.vue
    │   ├── AppSelect.vue
    │   ├── AppCheckbox.vue
    │   ├── AppRadio.vue
    │   ├── AppModal.vue
    │   ├── AppLoader.vue
    │   └── AppSlider.vue
    │
    ├── api/
    │   ├── http.ts
    │   └── endpoints.ts
    │
    ├── lib/
    │   ├── formatPrice.ts
    │   ├── formatDate.ts
    │   ├── debounce.ts
    │   └── createQueryParams.ts
    │
    ├── composables/
    │   ├── useDebounce.ts
    │   ├── useBreakpoints.ts
    │   ├── useClickOutside.ts
    │   └── useIntersectionObserver.ts
    │
    ├── constants/
    │   ├── routes.ts
    │   └── map.ts
    │
    ├── types/
    │   └── api.ts
    │
    ├── assets/
    │   ├── icons/
    │   └── images/
    │
    └── styles/
        ├── variables.scss
        └── mixins.scss
```

---

# 4. Что лежит внутри каждого слайса

Обычно внутри `feature`, `entity` или `widget` могут быть такие папки:

```text
ui/
model/
api/
lib/
index.ts
```

## ui

Vue-компоненты.

```text
ui/
├── EstateFilter.vue
├── EstateCard.vue
└── FavoriteButton.vue
```

## model

Состояние, типы, composables, store.

```text
model/
├── types.ts
├── useEstateFilter.ts
├── estate.store.ts
└── constants.ts
```

## api

Запросы к серверу.

```text
api/
└── estate.api.ts
```

## lib

Внутренние функции только для этого слайса.

```text
lib/
└── buildEstateFilterQuery.ts
```

Если функция нужна всему проекту — переносим в:

```text
shared/lib
```

## index.ts

Публичный экспорт слайса.

```ts
export { default as EstateFilter } from "./ui/EstateFilter.vue";
export { useEstateFilter } from "./model/useEstateFilter";
export type { EstateFilters } from "./model/types";
```

Использование:

```ts
import { EstateFilter } from "@/features/filter-estates";
```

---

# 5. Пример фильтра недвижимости

Фильтр — это `feature`, потому что пользователь выполняет действие.

```text
features/filter-estates/
├── ui/
│   ├── EstateFilter.vue
│   ├── PriceFilter.vue
│   ├── TypologyFilter.vue
│   ├── RoomsFilter.vue
│   ├── EnergyClassFilter.vue
│   └── LocationFilter.vue
│
├── model/
│   ├── useEstateFilter.ts
│   └── types.ts
│
├── lib/
│   └── buildEstateFilterQuery.ts
│
└── index.ts
```

Но данные для фильтра лучше брать из `entities`:

```text
entities/location
entities/typology
entities/energy-class
```

Например:

```ts
import { getLocations } from "@/entities/location";
import { getTypologies } from "@/entities/typology";
import { getEnergyClasses } from "@/entities/energy-class";
```

Почему?

Потому что `location`, `typology`, `energy-class` — это бизнес-данные.

А `filter-estates` — это действие пользователя.

---

# 6. Пример shared/ui

Базовые компоненты не должны знать про недвижимость.

```text
shared/ui/
├── AppButton.vue
├── AppInput.vue
├── AppSelect.vue
├── AppCheckbox.vue
└── AppRadio.vue
```

Их можно использовать внутри фильтра:

```vue
<script setup lang="ts">
  import AppSelect from "@/shared/ui/AppSelect.vue";
  import AppCheckbox from "@/shared/ui/AppCheckbox.vue";
</script>

<template>
  <AppSelect />
  <AppCheckbox />
</template>
```

---

# 7. Простое правило выбора папки

## Это app?

Глобальная настройка приложения?

```text
router
providers
global styles
layout
main.ts
```

→ `app`

---

## Это page?

Полноценная страница сайта?

```text
HomePage
CatalogPage
EstateDetailsPage
ContactsPage
```

→ `pages`

---

## Это widget?

Крупный блок страницы?

```text
Header
Footer
EstateMap
EstateList
FeaturedEstates
Reviews
```

→ `widgets`

---

## Это feature?

Пользователь выполняет действие?

```text
filter estates
add favorite
login
send contact request
search zone
```

→ `features`

---

## Это entity?

Объект существует в бизнесе?

```text
estate
location
zone
typology
energy class
review
user
agent
```

→ `entities`

---

## Это shared?

Можно использовать почти в любом проекте?

```text
button
input
select
modal
http client
formatDate
useDebounce
```

→ `shared`

---

# 8. Короткий пример зависимости

Страница каталога:

```text
pages/estate-catalog
```

использует:

```text
widgets/estate-search
widgets/estate-list
```

`widgets/estate-search` использует:

```text
features/filter-estates
```

`features/filter-estates` использует:

```text
entities/location
entities/typology
entities/energy-class
shared/ui
```

`entities/location` использует:

```text
shared/api
shared/types
```

Итоговая цепочка:

```text
pages/estate-catalog
  ↓
widgets/estate-search
  ↓
features/filter-estates
  ↓
entities/location
  ↓
shared/api
```

Это правильно.
