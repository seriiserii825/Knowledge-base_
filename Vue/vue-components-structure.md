### components structure

```txt
components/
├─ ui/                    # БАЗОВЫЕ (атомарные) компоненты — без логики, просто UI
│  ├─ Button.vue         # кнопки
│  ├─ Input.vue          # инпуты
│  ├─ Select.vue         # селекты
│  ├─ Checkbox.vue       # чекбоксы
│  ├─ Modal.vue          # модальные окна
│  └─ Card.vue           # карточки
│
├─ layout/               # ГЛОБАЛЬНЫЕ части интерфейса (каркас сайта)
│  ├─ Header.vue         # шапка сайта
│  ├─ Footer.vue         # футер
│  ├─ Navigation.vue     # меню / навигация
│  └─ Sidebar.vue        # боковая панель
│
├─ form/                 # ВСЁ, что связано с формами (логика + UI)
│  ├─ FormInput.vue      # обёртка над Input (label, ошибки)
│  ├─ FormSelect.vue     # select с логикой
│  ├─ FormCheckbox.vue   # чекбокс с логикой
│  ├─ FormField.vue      # универсальное поле формы
│  ├─ LoginForm.vue      # форма логина
│  ├─ RegisterForm.vue   # форма регистрации
│  └─ ContactForm.vue    # форма обратной связи
│
├─ sections/             # КРУПНЫЕ блоки страниц (секции)
│  ├─ home/              # секции главной страницы
│  │  ├─ HeroSection.vue
│  │  ├─ FeaturesSection.vue
│  │  └─ CTASection.vue
│  │
│  ├─ about/             # секции страницы "о нас"
│  │  └─ TeamSection.vue
│  │
│  ├─ blog/              # секции блога
│  │  └─ PostsSection.vue
│  │
│  └─ shared/            # секции, используемые на разных страницах
│     └─ FAQSection.vue
│
└─ shared/               # ОБЩИЕ компоненты (не атомы и не секции)
   ├─ Loader.vue         # загрузчик
   ├─ EmptyState.vue     # "нет данных"
   ├─ ErrorMessage.vue   # ошибка
   └─ Pagination.vue     # пагинация
```
