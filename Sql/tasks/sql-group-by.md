# 30 Задач SQL GROUP BY - TeaShop Database

## Структура базы данных

### Таблицы:

- **users** - пользователи (id, name, email, picture, role, createdAt)
- **stores** - магазины (id, title, description, user_id, picture, createdAt)
- **categories** - категории (id, title, description, store_id, createdAt)
- **colors** - цвета (id, name, value, store_id, createdAt)
- **products** - товары (id, title, description, price, images, store_id, category_id, color_id, user_id, createdAt)
- **orders** - заказы (id, status, total, user_id, createdAt)
- **order_items** - позиции заказа (id, order_id, product_id, quantity, price, store_id, createdAt)
- **reviews** - отзывы (id, text, rating, user_id, product_id, store_id, createdAt)

## Задачи

### Уровень 1: Базовые задачи

**1.** Посчитайте количество товаров в каждой категории.

```sql
SELECT category_id, COUNT(*) AS product_count
FROM products
GROUP BY category_id;
```

**2.** Выведите среднюю цену товаров для каждого магазина.

```sql
SELECT store_id, AVG(price) AS product_avg
FROM products
GROUP BY store_id;
```

**3.** Посчитайте количество заказов для каждого пользователя.

```sql
SELECT user_id, COUNT(*) AS orders_count
FROM orders
GROUP BY user_id;
```

**4.** Найдите количество отзывов для каждого товара.

```sql
SELECT store_id, COUNT(*) AS reviews_count
FROM reviews
GROUP BY store_id;
```

**5.** Выведите количество товаров каждого цвета.

```sql
SELECT color_id, COUNT(color_id) AS color_count
FROM products
GROUP BY color_id;
```

**6.** Посчитайте общее количество товаров в каждом магазине.

```sql
SELECT store_id, COUNT(*) AS products_count
FROM products
GROUP BY store_id;
```

**7.** Найдите средний рейтинг (rating) для каждого товара.

```sql
SELECT product_id, AVG(rating) AS rating_avg
FROM reviews
GROUP BY product_id;
```

**8.** Посчитайте количество пользователей, зарегистрированных в каждом году.

```sql
SELECT EXTRACT(YEAR FROM "createdAt") AS year, COUNT(*) AS user_count
FROM users
GROUP BY EXTRACT(YEAR FROM "createdAt")
ORDER BY year;
```

**9.** Выведите количество категорий в каждом магазине.

```sql
SELECT store_id, COUNT(\*) AS category_count
FROM categories
GROUP BY store_id
```

**10.** Найдите количество заказов со статусом PENDING и PAID отдельно.

### Уровень 2: Средние задачи

**11.** Для каждого магазина найдите минимальную, максимальную и среднюю цену товара.

```sql
SELECT store_id,
MIN(price) AS min_price,
MAX(price) AS max_price,
AVG(price) AS avg_price
FROM products
GROUP BY store_id;
```

**12.** Посчитайте общую сумму (total) всех заказов для каждого пользователя.

```sql
SELECT user_id,
SUM(total) as total
FROM orders
GROUP BY user_id
```

**13.** Найдите количество отзывов и средний рейтинг для каждого магазина.

```sql
SELECT store_id,
COUNT(*) as reviews_count,
AVG(rating) as avg_rating
FROM reviews
GROUP BY store_id;
```

**14.** Для каждой категории выведите количество товаров и их среднюю цену.

```sql
SELECT category_id,
COUNT(*) as product_count,
AVG(price) as avg_price
FROM products
GROUP BY category_id;
```

**15.** Посчитайте общее количество проданных единиц (quantity) для каждого товара.

```sql
SELECT product_id,
SUM(quantity) as qty
FROM order_items
GROUP BY product_id;
```

**16.** Найдите количество активных магазинов (у которых есть хотя бы один товар) для каждого пользователя.

```sql
SELECT user_id, COUNT(*) AS active_stores_count
FROM stores
WHERE id IN (SELECT DISTINCT store_id FROM products)
GROUP BY user_id;
```

**17.** Выведите количество заказов и общую сумму продаж для каждого магазина через таблицу order_items.

```sql
SELECT store_id, COUNT(*) as order_count, SUM(price) as total_sum FROM order_items GROUP BY store_id;
```

**18.** Для каждого цвета найдите количество товаров и их общую стоимость (price \* количество товаров).

```sql
SELECT color_id, COUNT(*) as product_count, SUM(price) as total_price from products GROUP BY color_id;
```

**20.** Найдите количество уникальных пользователей, оставивших отзывы в каждом магазине.

```sql
SELECT store_id, COUNT(DISTINCT user_id)  as count_users FROM reviews GROUP BY store_id;
```

### Уровень 3: Сложные задачи

# 10 Средних задач SQL GROUP BY + HAVING (БЕЗ JOIN)

## Структура базы данных TeaShop

### Основные таблицы:

- **users** (id, name, email, createdAt)
- **stores** (id, title, description, user_id, createdAt)
- **categories** (id, title, description, store_id, createdAt)
- **products** (id, title, price, store_id, category_id, color_id, createdAt)
- **orders** (id, status, total, user_id, createdAt)
- **order_items** (id, order_id, product_id, quantity, price, store_id, createdAt)
- **reviews** (id, text, rating, user_id, product_id, store_id, createdAt)
- **colors** (id, name, value, store_id, createdAt)

---

## Задачи (Средний уровень)

**1.** Найдите магазины, в которых больше 5 товаров. Выведите store_id и количество товаров.

```sql
SELECT store_id, COUNT(*) as products_count from products GROUP BY store_id HAVING COUNT(*) > 5;
```

**2.** Выведите категории, где средняя цена товара превышает 500. Покажите category_id и среднюю цену.

```sql
SELECT category_id, AVG(price) as avg_price FROM products GROUP BY category_id HAVING AVG(price) > 150;
```

**3.** Найдите пользователей, которые сделали более 3 заказов. Выведите user_id и количество заказов.

```sql
SELECT user_id, COUNT(*) order_count FROM orders GROUP BY user_id HAVING COUNT(*) >= 2;
```

**4.** Покажите товары, у которых больше 10 отзывов. Выведите product_id и количество отзывов.

```sql
SELECT product_id, COUNT(*) as reviews_count FROM reviews GROUP BY product_id HAVING COUNT(*) >= 5;
```

**5.** Найдите магазины, общая сумма продаж (через order_items) в которых превышает 10000. Выведите store_id и общую сумму.

**6.** Выведите цвета, которые используются более чем в 3 товарах. Покажите color_id, name цвета и количество товаров.

**7.** Найдите пользователей, средний рейтинг отзывов которых выше 4.0. Выведите user_id и средний рейтинг.

**8.** Покажите магазины, где минимальная цена товара меньше 100, а максимальная больше 1000. Выведите store_id, min и max цены.

**9.** Найдите месяцы 2024 года, в которых было создано более 5 заказов. Выведите месяц и количество заказов.

**10.** Выведите товары, общее количество проданных единиц (quantity) которых превышает 50. Покажите product_id и общее количество.

---

## Подсказки

### Основные агрегатные функции:

- `COUNT(*)` - количество строк
- `COUNT(DISTINCT column)` - количество уникальных значений
- `SUM(column)` - сумма
- `AVG(column)` - среднее значение
- `MIN(column)` - минимум
- `MAX(column)` - максимум

### HAVING - фильтрация групп

```sql
SELECT column, COUNT(*)
FROM table
GROUP BY column
HAVING COUNT(*) > 5;  -- фильтр ПОСЛЕ группировки
```

### Работа с датами

```sql
-- Извлечь год
EXTRACT(YEAR FROM createdAt)

-- Извлечь месяц
EXTRACT(MONTH FROM createdAt)

-- Для PostgreSQL также:
DATE_PART('year', createdAt)
DATE_PART('month', createdAt)
```

### Разница WHERE и HAVING

- **WHERE** - фильтрует строки ДО группировки
- **HAVING** - фильтрует группы ПОСЛЕ группировки

```sql
-- Пример:
SELECT store_id, COUNT(*) as product_count
FROM products
WHERE price > 100           -- фильтр строк
GROUP BY store_id
HAVING COUNT(*) > 5;        -- фильтр групп
```

Удачи! 🍵
