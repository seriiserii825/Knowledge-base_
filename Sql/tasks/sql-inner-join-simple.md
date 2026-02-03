# SQL JOIN Задачи

## Базовые JOIN (1-10)

### 1. Продукты и магазины

Вывести все продукты с названиями магазинов, где они продаются.

```sql
SELECT p.title as product_title, s.title as store_title
FROM products p
JOIN stores s
ON p.store_id = s.id
```

### 2. Пользователи и их заказы

Показать всех пользователей и количество их заказов (включая пользователей без заказов).

```sql
SELECT u.email as user_email, COUNT(o.id) as orders_count
FROM users u
LEFT JOIN orders o
ON o.user_id = u.id
GROUP BY u.email
ORDER BY COUNT(o.id) DESC
```

### 3. Категории без продуктов

Найти все категории, в которых нет ни одного продукта.

```sql
SELECT c.title, COUNT(p.id) as product_id
FROM categories c
LEFT JOIN products p
ON p.category_id = c.id
GROUP BY c.title
HAVING COUNT(p.id) = 0
```

### 4. Самый активный покупатель

Найти пользователя с наибольшим количеством заказов (имя пользователя и количество заказов).

```sql
SELECT u.email, COUNT(o.id) as orders_count
FROM users u
JOIN orders o
ON o.user_id = u.id
GROUP BY u.id
ORDER BY COUNT(o.id) DESC
LIMIT 1
```

### 6. Магазины и их выручка

Показать каждый магазин и общую сумму продаж всех его продуктов.

```sql
SELECT s.title, COALESCE(SUM(oi.quantity * oi.price), 0) AS total_sales
FROM stores s
JOIN order_items oi
ON oi.store_id = s.id
GROUP BY s.title
```

### 7. Продукты без отзывов

Найти все продукты, на которые не оставлено ни одного отзыва.

```sql
SELECT p.title, r.id
FROM products p
LEFT JOIN reviews r
ON r.product_id = p.id
WHERE r.id IS NULL
```

### 8. Топ-3 категории по количеству продуктов

Вывести три категории с наибольшим количеством продуктов.

```sql
SELECT c.title, COUNT(p.id) as product_count
FROM categories c
JOIN products p
ON p.category_id = c.id
GROUP BY c.title
ORDER BY COUNT(p.id) DESC
LIMIT 3
```

### 9. Пользователи и их последний заказ

Показать каждого пользователя и дату его последнего заказа.

```sql
SELECT u.email, MAX(o."createdAt") as last_date
FROM users u
JOIN orders o
ON o.user_id = u.id
GROUP BY u.email
```

### 10. Средний чек по магазинам

Вычислить средний размер заказа для каждого магазина.

```sql
SELECT s.title, ROUND(AVG(o.total), 2)
FROM stores s
JOIN orders o
ON o.store_id = s.id
GROUP BY s.id
```

## Средний уровень (11-20)

### 11. Продукты с высоким рейтингом

Найти продукты со средним рейтингом выше 4.5 и минимум 10 отзывами.

```sql
SELECT p.title, AVG(r.rating) as avg_rating, COUNT(r.id) review_count
FROM products p
JOIN reviews r
ON p.id = r.product_id
GROUP BY p.id
HAVING AVG(r.rating) > 3 AND COUNT(r.id) >= 6
```

### 12. Магазины без продаж

Найти магазины, у которых нет ни одного проданного продукта (нет заказов).

```sql
SELECT s.title, COUNT(o.id)
FROM stores s
LEFT JOIN orders o
ON o.store_id = s.id
GROUP BY s.id
HAVING COUNT(o.id) = 0
```

### 13. Самый популярный продукт по категориям

Для каждой категории найти продукт с наибольшим количеством отзывов.

```sql
SELECT
    c.title AS category_title,
    p.title AS product_title,
    COUNT(r.id) AS review_count
FROM categories c
JOIN products p ON p.category_id = c.id
LEFT JOIN reviews r ON r.product_id = p.id
GROUP BY c.id, c.title, p.id, p.title
HAVING COUNT(r.id) = (
    SELECT MAX(review_count)
    FROM (
        SELECT COUNT(r2.id) AS review_count
        FROM products p2
        LEFT JOIN reviews r2 ON r2.product_id = p2.id
        WHERE p2.category_id = c.id
        GROUP BY p2.id
    ) AS category_reviews
)
ORDER BY review_count DESC;
```

### 14. Пользователи, купившие из разных категорий

Найти пользователей, которые купили продукты минимум из 3 разных категорий.

### 15. Динамика продаж по месяцам

Показать общую сумму продаж по каждому месяцу за последний год.

### 16. Продукты одновременно в нескольких магазинах

Найти продукты, которые продаются в более чем одном магазине (если структура БД это позволяет).

### 17. Категории с самой высокой средней ценой

Вывести топ-5 категорий с самой высокой средней ценой продукта.

### 18. Пользователи без покупок за последние 6 месяцев

Найти пользователей, которые зарегистрированы, но не делали заказов последние 6 месяцев.

### 19. Отзывы с текстом и без

Показать количество отзывов с текстовым комментарием и без него по каждому продукту.

### 20. Корреляция цены и рейтинга

Вывести продукты, сгруппированные по ценовым диапазонам (0-1000, 1000-5000, 5000+) и их средний рейтинг.

## Продвинутый уровень (21-30)

### 21. Пользователи, купившие похожие продукты

Найти пары пользователей, которые купили хотя бы 3 одинаковых продукта.

### 22. Продукты с противоречивыми отзывами

Найти продукты, у которых есть отзывы и с рейтингом 5, и с рейтингом 1 (большой разброс мнений).

### 23. Самая прибыльная категория для каждого магазина

Для каждого магазина определить категорию, которая приносит наибольшую выручку.

### 24. Цепочка рекомендаций

Найти продукты, которые часто покупают вместе (в одном заказе) с конкретным продуктом.

### 25. Рост продаж год к году

Сравнить общую выручку текущего года с предыдущим годом по каждому магазину (процент роста).

### 26. Пользователи-рецензенты

Найти пользователей, которые оставляют отзывы, но сами ничего не покупали.

### 27. Продукты вне своей ценовой категории

Найти продукты, цена которых отклоняется от средней цены категории более чем на 50%.

### 28. Сезонность продаж по категориям

Определить, в какие месяцы каждая категория продаётся лучше всего.

### 29. Клиентская база магазинов

Найти пересечение клиентов между магазинами (сколько пользователей покупали в обоих магазинах).

### 30. RFM-анализ упрощённый

Для каждого пользователя вычислить: давность последней покупки (Recency), частоту покупок (Frequency) и общую сумму покупок (Monetary).
