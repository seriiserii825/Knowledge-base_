# Лучшие курсы и туториалы по AdonisJS для создания API

## 🎯 Рекомендуемые курсы

### 1. **Adocasts - Let's Learn AdonisJS 6** (БЕСПЛАТНО) ⭐ Лучший выбор

**Ссылка:** https://adocasts.com/series/lets-learn-adonisjs-6

**Что включает:**

- Пошаговое изучение AdonisJS 6 с нуля
- Routing, Controllers, Services
- Lucid ORM (работа с базой данных)
- Authentication (аутентификация)
- Validation (валидация)
- Redis интеграция
- Видео-формат с высоким качеством

**Почему это лучший выбор:**

- Создано Tom (создателем Adocasts) - один из лучших преподавателей AdonisJS
- Актуальный контент для AdonisJS 6
- Бесплатный и качественный
- Пошаговый подход для начинающих

---

### 2. **FreeCodeCamp - Build a RESTful API with AdonisJS** (БЕСПЛАТНО)

**Ссылка:** https://www.freecodecamp.org/news/build-a-restful-api-with-adonisjs/

**Что включает:**

- Создание полноценного Todo API
- Настройка базы данных
- Migrations и Models
- Controllers и Routes
- Authentication с API Tokens
- Authorization

**Проект:** Todo Application API

---

### 3. **Medium - Authentication with AdonisJS v6 and Access Tokens** (БЕСПЛАТНО)

**Ссылка:** https://medium.com/@maximemrf/authentication-with-adonisjs-v6-and-access-token-oat-6c8029827562

**Что включает:**

- Установка AdonisJS 6 с API kit
- OAT (Opaque Access Token) аутентификация
- Register/Login/Logout
- Практический пример

---

### 4. **Educative - Building Full-Stack Web Applications with AdonisJS** (ПЛАТНО)

**Ссылка:** https://www.educative.io/courses/building-full-stack-web-applications-adonisjs

**Что включает:**

- Routes, Controllers, Middleware, Hooks
- Интерактивные примеры кода
- Тесты и упражнения
- Сертификат по завершению

**Цена:** Платная подписка Educative

---

## 📚 Туториалы и статьи

### 5. **MasteringBackend - AdonisJS Tutorial: The Ultimate Guide**

**Ссылка:** https://masteringbackend.com/posts/adonisjs-tutorial-the-ultimate-guide/

Всеобъемлющий гайд по AdonisJS с примерами и сравнениями с другими фреймворками.

### 6. **DEV Community - Creating an API using AdonisJS (Series)**

**Ссылка:** https://dev.to/nilomiranda/creating-an-api-using-adonisjs-part-1-2mk0

Серия статей по созданию API с пошаговыми инструкциями.

### 7. **Verpex - Build a Restful API with AdonisJS**

**Ссылка:** https://verpex.com/blog/website-tips/build-a-restful-api-with-adonisjs

Детальный туториал с CRUD операциями.

---

## 🚀 Готовые примеры и Boilerplates

### 1. **AdonisJS 6 REST API Boilerplate by rayhannovelo**

**GitHub:** https://github.com/rayhannovelo/AdonisJS-6-REST-API

**Что включает:**

- ✅ User Authentication (Access Tokens)
- ✅ User Authorization (Bouncer)
- ✅ Database (Lucid ORM)
- ✅ Validation (VineJS)
- ✅ Middleware
- ✅ Exception Handling
- ✅ CRUD Examples (users, posts)

### 2. **AdonisJS V6 API REST Boilerplate**

**DEV Community:** https://dev.to/tagada216/adonis-js-v6-api-rest-boilerplate-9ae

**Что включает:**

- Email/Password аутентификация
- Готовая структура проекта
- Все необходимые пакеты настроены

### 3. **AdonisJS REST API by saidqb**

**GitHub:** https://github.com/saidqb/adonisjs-rest-api

**Что включает:**

- API Key аутентификация
- Access Token
- CRUD примеры
- Helpers и Constants

---

## 🎓 Как начать обучение

### Шаг 1: Установка (5 минут)

```bash
# Убедитесь что у вас Node.js >= 20.6
node -v

# Создайте новый API проект
npm init adonisjs@latest my-api -- -K=api --auth-guard=access_tokens

# Перейдите в папку
cd my-api

# Запустите миграции
node ace migration:run

# Запустите сервер
node ace serve --hmr
```

### Шаг 2: Пройдите базовый курс (2-3 дня)

1. **День 1:** Пройдите первые 10 уроков Adocasts

   - Основы роутинга
   - Controllers
   - Models и ORM

2. **День 2:** Продолжите Adocasts

   - Authentication
   - Validation
   - Services

3. **День 3:** Практика с туториалом FreeCodeCamp
   - Создайте Todo API
   - Настройте аутентификацию

### Шаг 3: Практика (1 неделя)

Создайте свой первый проект:

- **Вариант 1:** Blog API (посты, комментарии, пользователи)
- **Вариант 2:** E-commerce API (продукты, корзина, заказы)
- **Вариант 3:** Task Manager API (задачи, проекты, команды)

---

## 📖 Официальная документация

**AdonisJS Documentation:** https://docs.adonisjs.com

Разделы для API:

- Introduction & Preface
- HTTP Layer (Routes, Controllers, Middleware)
- Database (Lucid ORM)
- Authentication
- Validation
- Testing

---

## 💡 Дополнительные ресурсы

### GitHub Topics

**Ссылка:** https://github.com/topics/adonisjs-api

Здесь вы найдете множество примеров проектов на AdonisJS.

### Awesome AdonisJS Tutorial

**GitHub:** https://github.com/RK-developer/awesome-adonisjs-tutorial

Коллекция лучших туториалов по AdonisJS.

---

## 🎯 Рекомендуемый план обучения (2 недели)

### Неделя 1: Теория и основы

- **День 1-2:** Adocasts уроки 1-10 (Routing, Controllers)
- **День 3-4:** Adocasts уроки 11-20 (Database, Models)
- **День 5-7:** FreeCodeCamp туториал (полный Todo API)

### Неделя 2: Практика

- **День 1-3:** Создайте свой API (выберите идею)
- **День 4-5:** Добавьте аутентификацию
- **День 6-7:** Добавьте валидацию, тесты, деплой

---

## ⚡ Quick Start - Минимальный API (10 минут)

Если хотите быстро попробовать AdonisJS:

```bash
# 1. Создайте проект
npm init adonisjs@latest quick-api -- -K=api

# 2. Создайте контроллер
node ace make:controller Post

# 3. Добавьте роуты в start/routes.ts
import router from '@adonisjs/core/services/router'
const PostsController = () => import('#controllers/posts_controller')

router.get('/posts', [PostsController, 'index'])
router.post('/posts', [PostsController, 'store'])

# 4. Запустите
node ace serve --hmr
```

Откройте http://localhost:3333/posts - ваш первый API endpoint готов!

---

## 🎬 Видео курсы (YouTube)

### 1. **AdonisJS Basics - Laravel Dev POV**

Серия видео для разработчиков Laravel

### 2. **AdonisJS 4.1 Crash Course for Beginners**

Быстрый старт для начинающих

### 3. **Full Stack Todo List Tutorial using AdonisJS**

Полный туториал с примером

---

## 🌟 Мой топ-3 для быстрого старта

1. **🥇 Adocasts (бесплатно, видео)** - лучший для визуального обучения
2. **🥈 FreeCodeCamp туториал (бесплатно, статья)** - отличный практический пример
3. **🥉 GitHub Boilerplate (бесплатно, код)** - клонируйте и изучайте реальный код

---

## 💬 Сообщество и поддержка

- **Discord:** Официальный Discord сервер AdonisJS
- **Twitter:** @adonisframework
- **Forum:** https://forum.adonisjs.com

---

## ✅ Чеклист навыков для API разработки

После прохождения курсов вы должны уметь:

- [ ] Создавать новый AdonisJS API проект
- [ ] Определять routes и controllers
- [ ] Работать с Lucid ORM (models, migrations)
- [ ] Создавать CRUD операции
- [ ] Настраивать аутентификацию (Access Tokens)
- [ ] Добавлять валидацию (VineJS)
- [ ] Обрабатывать ошибки
- [ ] Писать middleware
- [ ] Настраивать relationships (один-ко-многим, многие-ко-многим)
- [ ] Деплоить приложение

---

**Удачи в изучении AdonisJS! 🚀**

Начните с Adocasts, это действительно лучший ресурс для новичков.
