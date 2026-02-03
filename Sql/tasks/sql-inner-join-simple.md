# 30 Простых Задач на INNER JOIN

## Структура базы данных

**Таблицы:**

- `users` (id, name, email, password, picture, role, createdAt, updatedAt)
- `stores` (id, title, description, user_id, picture, createdAt, updatedAt)
- `categories` (id, title, description, store_id, createdAt, updatedAt)
- `colors` (id, name, value, store_id, createdAt, updatedAt)
- `products` (id, title, description, price, images, store_id, category_id, color_id, user_id, createdAt, updatedAt)
- `orders` (id, status, total, user_id, createdAt, updatedAt)
- `order_items` (id, order_id, quantity, price, product_id, store_id, createdAt, updatedAt)
- `reviews` (id, text, rating, user_id, product_id, store_id, createdAt, updatedAt)

---

## Задачи

### Задача 1

Получить список всех продуктов с названием их магазина.

```sql
SELECT p.id as product_id, p.title as product_title, s.title as store_title FROM products p
INNER JOIN stores s ON p.store_id = s.id ORDER BY p.id;
```

### Задача 2

Вывести все заказы с именами пользователей, которые их сделали.

```sql
SELECT u.name as user_name, o.id as order_id
FROM orders o
INNER JOIN
users u ON o.user_id = u.id;
```

### Задача 3

Показать все отзывы с названием продукта, которому они принадлежат.

```sql
SELECT p.title AS product_name, r.*
FROM reviews r
JOIN products p ON r.product_id = p.id
ORDER BY p.title, r.id;
```

### Задача 4

Получить список всех продуктов с названием их категории.

```sql
SELECT p.id as product_id, p.title as product_title, c.title as category_title
FROM products p
JOIN categories c
ON p.category_id = c.id
ORDER BY c.title
```

### Задача 5

Вывести все магазины с именами их владельцев.

```sql
SELECT s.id as store_id, s.title as store_title, u.name as user_name
FROM stores s
JOIN users u
ON s.user_id = u.id
```

### Задача 6

Показать все продукты с названием их цвета.

```sql
-- select string_agg(column_name, ', ' ORDER BY ordinal_position) as columns FROM information_schema.columns WHERE table_name = 'products';
-- select string_agg(column_name, ', ' ORDER BY ordinal_position) as columns FROM information_schema.columns WHERE table_name = 'colors';
SELECT p.id as product_id, p.title as product_title, c.name as color_name, c.value as color_value
FROM products p
JOIN colors c
ON p.color_id = c.id
ORDER BY c.name
```

### Задача 7

Получить список всех элементов заказа с названием продукта.

```sql
SELECT o.id as order_id, o.price as order_price, p.title as product_title
FROM order_items o
JOIN products p
ON o.product_id = p.id
```

### Задача 8

Вывести все категории с названием магазина, к которому они относятся.

```sql
SELECT s.title as store_title, c.id as category_id, c.title as category_title
FROM categories c
JOIN stores s
ON c.store_id = s.id
ORDER BY s.title
```

### Задача 9

Показать все цвета с названием магазина.

```sql
SELECT c.id as color_id, c.name as color_name, s.title as store_title
FROM colors c
JOIN stores s
ON c.store_id = s.id
```

### Задача 10

Получить все отзывы с именами пользователей, которые их оставили.

```sql
SELECT r.id, r.rating as review_rating, u.name as user_name
FROM reviews r
JOIN users u
ON r.user_id = u.id
```

### Задача 11

Вывести продукты дороже 1000 рублей с названием их магазина.

### Задача 12

Показать заказы со статусом 'PAID' и именами пользователей.

### Задача 13

Получить отзывы с рейтингом выше 4 и названием продукта.

### Задача 14

Вывести продукты из категории с id=1 вместе с названием категории.

### Задача 15

Показать все заказы пользователя с email='user@example.com'.

### Задача 16

Получить количество продуктов в каждом магазине (название магазина и количество).

### Задача 17

Вывести количество заказов для каждого пользователя (имя пользователя и количество).

### Задача 18

Показать среднюю цену продуктов в каждой категории (название категории и средняя цена).

### Задача 19

Получить общую сумму всех заказов для каждого пользователя (имя и сумма).

### Задача 20

Вывести количество отзывов для каждого продукта (название продукта и количество отзывов).

### Задача 21

Показать продукты и их магазины, отсортированные по цене от большей к меньшей.

### Задача 22

Получить заказы с общей суммой более 5000 рублей с именами пользователей.

### Задача 23

Вывести все элементы заказа с названием продукта и ценой, где количество больше 2.

### Задача 24

Показать продукты, созданные в 2024 году, с названием их магазина.

### Задача 25

Получить все магазины с количеством их продуктов, где продуктов больше 10.

### Задача 26

Вывести пользователей и количество их магазинов.

### Задача 27

Показать продукты с их категорией и цветом (три таблицы).

### Задача 28

Получить заказы с информацией о пользователе и количестве позиций в заказе.

### Задача 29

Вывести топ-5 самых дорогих продуктов с названием магазина и категории.

### Задача 30

Показать среднюю оценку (rating) для каждого продукта вместе с названием продукта и количеством отзывов.

---

## Примечания

- Все задачи решаются с использованием INNER JOIN
- Используйте алиасы для таблиц (например, u для users, s для stores)
- Обращайте внимание на названия столбцов с внешними ключами (они заканчиваются на \_id)
- Для агрегатных функций используйте GROUP BY
- Для фильтрации агрегированных данных используйте HAVING
