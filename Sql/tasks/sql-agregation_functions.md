# 50 задач на SQL агрегатные функции

## Таблицы из проекта:

- `users` - пользователи
- `stores` - магазины
- `products` - товары
- `categories` - категории
- `colors` - цвета
- `reviews` - отзывы
- `orders` - заказы
- `order_items` - позиции заказов

---

## Уровень 1: Простые COUNT (1-10)

**1.** Подсчитать общее количество пользователей

```sql
SELECT COUNT(*) as users_count FROM users;
```

**2.** Подсчитать количество магазинов

```sql
SELECT COUNT(*) as shops_count FROM stores;
```

**3.** Подсчитать количество товаров

```sql
SELECT COUNT(*) as products_count FROM products;
```

**4.** Подсчитать количество категорий

```sql
SELECT COUNT(*) as categories_count FROM categories;
```

**5.** Подсчитать количество цветов

```sql
SELECT COUNT(*) as colors_count FROM colors;
```

**6.** Подсчитать количество отзывов

```sql
SELECT COUNT(*) as colors_count FROM colors;
```

**7.** Подсчитать количество заказов

```sql
SELECT COUNT(*) as orders_count FROM orders;
```

**8.** Подсчитать количество позиций в заказах (order_items)
`sql
    SELECT COUNT(*) as order_items_count FROM order_items;
    `

**9.** Подсчитать товары с ценой больше 100

```sql
SELECT COUNT(price) FROM products WHERE price < 100;
```

**10.** Подсчитать магазины с описанием (description IS NOT NULL)

```sql
SELECT COUNT(description) FROM stores;
```

---

## Уровень 2: COUNT с условиями (11-20)

**11.** Подсчитать товары из магазина с id = 3

```sql
SELECT COUNT(*) from products WHERE store_id = 3;
```

**12.** Подсчитать отзывы с рейтингом 5

```sql
SELECT COUNT(*) from reviews WHERE rating = 5;
```

**13.** Подсчитать заказы со статусом 'PAID'

```sql
SELECT COUNT(*) from orders WHERE status = 'PAID';
```

**14.** Подсчитать пользователей с ролью 'USER'

```sql
SELECT COUNT(*) from users where role = 'user';
```

**15.** Подсчитать категории из магазина с id = 2

```sql
SELECT COUNT(*) FROM categories where store_id = 2;
```

**16.** Подсчитать цвета из магазина с id = 3

```sql
SELECT COUNT(*) FROM colors where store_id = 3;
```

**17.** Подсчитать товары с ценой от 50 до 150

```sql
SELECT COUNT(*) FROM products where price BETWEEN 50 AND 150;
```

**18.** Подсчитать отзывы с рейтингом меньше 3

```sql
SELECT COUNT(*) FROM reviews WHERE rating < 3;
```

**19.** Подсчитать заказы, созданные после '2026-01-20'

```sql
SELECT COUNT(*) from orders where "createdAt" > '2026-01-20';
```

**20.** Подсчитать товары без описания (description IS NULL)

```sql
SELECT COUNT(*) from products WHERE description IS NULL;
```

---

## Уровень 3: SUM и AVG (21-30)

**21.** Вычислить общую сумму всех цен товаров

```sql
SELECT SUM(price) FROM products;
```

**22.** Найти среднюю цену товара

```sql
SELECT AVG(price) FROM products;
```

**23.** Вычислить сумму всех заказов (поле total)

```sql
SELECT SUM(total) FROM orders;
```

**24.** Найти среднюю стоимость заказа

```sql
SELECT AVG(price) FROM products;
```

**25.** Вычислить общую сумму цен в позициях заказов (order_items.price)

```sql
SELECT SUM(price) from order_items;
```

**26.** Найти среднюю цену товаров из категории с id = 5

```sql
SELECT AVG(price) FROM products WHERE category_id = 5;
```

**27.** Вычислить сумму товаров дешевле 100

```sql
SELECT SUM(price) FROM products WHERE price < 100;
```

**28.** Найти средний рейтинг отзывов

```sql
SELECT AVG(rating) FROM reviews;
```

**29.** Вычислить общее количество товаров во всех позициях заказов (SUM quantity)

```sql
SELECT AVG(quantity) FROM order_items;
```

**30.** Найти среднюю цену товаров из магазина с id = 3

---

## Уровень 4: MIN и MAX (31-40)

**31.** Найти минимальную цену товара

```sql
SELECT MIN(price) FROM products;
```

**32.** Найти максимальную цену товара

```sql
SELECT MAX(price) FROM products;
```

**33.** Найти самый низкий рейтинг отзыва

```sql
SELECT MIN(rating) FROM reviews;
```

**34.** Найти самый высокий рейтинг отзыва

```sql
SELECT MAX(rating) FROM reviews;
```

**35.** Найти минимальную сумму заказа

```sql
SELECT MIN(total) FROM orders;
```

**36.** Найти максимальную сумму заказа

```sql
SELECT MAX(total) FROM orders;
```

**37.** Найти самую раннюю дату создания пользователя

```sql
SELECT MIN("createdAt") FROM users;
```

**38.** Найти самую позднюю дату создания товара

```sql
SELECT MAX("createdAt") FROM products;
```

**39.** Найти минимальное количество товара в позиции заказа

```sql
SELECT MIN("quantity") FROM order_items;
```

**40.** Найти максимальное количество товара в позиции заказа

```sql
SELECT MAX("quantity") FROM order_items;
```

---

## Уровень 5: Комбинированные запросы (41-50)

**41.** Вывести количество товаров, среднюю цену, минимальную и максимальную цену

```sql
SELECT COUNT(*) AS product_count,
       AVG(price) AS avg_price,
       MIN(price) AS min_price,
       MAX(price) AS max_price
       FROM products;
```

**42.** Вывести количество отзывов, средний рейтинг, минимальный и максимальный рейтинг

```sql
SELECT  COUNT(*) AS review_count,
        AVG(rating) AS avg_rating,
        MIN(rating) AS avg_min,
        MAX(rating) AS avg_max
        FROM reviews;
```

**43.** Вывести количество заказов, общую сумму всех заказов, среднюю сумму заказа

```sql
SELECT  COUNT(*) AS order_count,
        SUM(total) AS order_total,
        AVG(total) AS avg_order
        FROM orders;
```

**44.** Для товаров дороже 100: вывести количество, среднюю цену, минимальную и максимальную цену

```sql
SELECT  COUNT(*) AS products_count,
        AVG(price) AS avg_products,
        MIN(price) AS min_price,
        MAX(price) AS max_price
        FROM products WHERE price > 100;
```

**45.** Для отзывов с рейтингом >= 4: вывести количество и средний рейтинг

```sql
SELECT  COUNT(*) AS count,
        AVG(rating) AS avg
        FROM reviews WHERE rating >= 4;
```

**46.** Для заказов со статусом 'PAID': вывести количество и общую сумму

```sql
SELECT  COUNT(*) AS count,
SUM(total) AS SUM
FROM orders WHERE status = 'PAID';
```

**48.** Вычислить разницу между максимальной и минимальной ценой товара

```sql

SELECT MAX(price) - MIN(price)
FROM products;
```

---

## Подсказки:

### Основные функции:

- `COUNT(*)` - подсчет всех строк
- `COUNT(column)` - подсчет НЕ NULL значений
- `SUM(column)` - сумма значений
- `AVG(column)` - среднее значение
- `MIN(column)` - минимальное значение
- `MAX(column)` - максимальное значение
- `ROUND(value, 2)` - округление до 2 знаков

### Использование:

```sql
-- Пример структуры запроса
SELECT
  COUNT(*) AS название,
  SUM(поле) AS название,
  AVG(поле) AS название
FROM таблица
WHERE условие;
```

### Таблицы и их основные поля:

- **users**: id, name, email, picture, role
- **stores**: id, title, description, user_id, picture
- **products**: id, title, description, price, store_id, category_id, color_id, user_id
- **categories**: id, title, description, store_id
- **colors**: id, name, value, store_id
- **reviews**: id, text, rating, user_id, product_id, store_id
- **orders**: id, status ('PENDING', 'PAID'), total, user_id
- **order_items**: id, order_id, product_id, store_id, quantity, price

Удачи! 🚀
