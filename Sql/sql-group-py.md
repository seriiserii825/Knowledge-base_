# SQL GROUP BY - Как это работает

## Основная идея

`GROUP BY` группирует строки с одинаковыми значениями в указанных колонках и позволяет применять агрегатные функции к каждой группе.

## Простой пример

### Таблица products:

| id  | name     | category    | price |
| --- | -------- | ----------- | ----- |
| 1   | Laptop   | Electronics | 1000  |
| 2   | Mouse    | Electronics | 25    |
| 3   | Desk     | Furniture   | 300   |
| 4   | Chair    | Furniture   | 150   |
| 5   | Keyboard | Electronics | 50    |

### Запрос с GROUP BY:

```sql
SELECT category, COUNT(*) AS product_count
FROM products
GROUP BY category;
```

### Результат:

| category    | product_count |
| ----------- | ------------- |
| Electronics | 3             |
| Furniture   | 2             |

**Что произошло:**

- SQL взял все строки с `category = 'Electronics'` и сгруппировал их вместе
- Взял все строки с `category = 'Furniture'` и сгруппировал их вместе
- Для каждой группы посчитал количество строк

## Агрегатные функции с GROUP BY

```sql
SELECT category,
       COUNT(*) AS product_count,
       AVG(price) AS avg_price,
       MIN(price) AS min_price,
       MAX(price) AS max_price,
       SUM(price) AS total_price
FROM products
GROUP BY category;
```

### Результат:

| category    | product_count | avg_price | min_price | max_price | total_price |
| ----------- | ------------- | --------- | --------- | --------- | ----------- |
| Electronics | 3             | 358.33    | 25        | 1000      | 1075        |
| Furniture   | 2             | 225.00    | 150       | 300       | 450         |

## Группировка по нескольким колонкам

```sql
SELECT category,
       brand,
       COUNT(*) AS product_count,
       AVG(price) AS avg_price
FROM products
GROUP BY category, brand;
```

Создаст отдельную группу для каждой уникальной комбинации `category` и `brand`.

## Важное правило!

**В SELECT можно использовать только:**

1. Колонки из GROUP BY
2. Агрегатные функции (COUNT, AVG, SUM, MIN, MAX и т.д.)

### ❌ Неправильно:

```sql
SELECT category, name, COUNT(*)
FROM products
GROUP BY category;
```

`name` нельзя использовать, потому что его нет в GROUP BY!

### ✅ Правильно:

```sql
SELECT category, COUNT(*)
FROM products
GROUP BY category;
```

## HAVING - фильтрация групп

`WHERE` фильтрует строки ДО группировки.
`HAVING` фильтрует группы ПОСЛЕ группировки.

```sql
-- Показать только категории, где больше 2 продуктов
SELECT category, COUNT(*) AS product_count
FROM products
GROUP BY category
HAVING COUNT(*) > 2;
```

### Результат:

| category    | product_count |
| ----------- | ------------- |
| Electronics | 3             |

## Порядок выполнения SQL запроса

```sql
SELECT category, COUNT(*) AS product_count
FROM products
WHERE price > 50
GROUP BY category
HAVING COUNT(*) > 1
ORDER BY product_count DESC;
```

**Порядок выполнения:**

1. `FROM` - берём таблицу products
2. `WHERE` - фильтруем строки (price > 50)
3. `GROUP BY` - группируем по category
4. `HAVING` - фильтруем группы (COUNT(\*) > 1)
5. `SELECT` - выбираем колонки
6. `ORDER BY` - сортируем результат

## Практические примеры

### Продажи по месяцам:

```sql
SELECT DATE_FORMAT(order_date, '%Y-%m') AS month,
       COUNT(*) AS order_count,
       SUM(total) AS revenue
FROM orders
GROUP BY DATE_FORMAT(order_date, '%Y-%m')
ORDER BY month;
```

### Топ-5 категорий по выручке:

```sql
SELECT category,
       SUM(price * quantity) AS total_revenue
FROM sales
GROUP BY category
ORDER BY total_revenue DESC
LIMIT 5;
```

### Средний чек по городам:

```sql
SELECT city,
       COUNT(*) AS order_count,
       AVG(total) AS avg_order_value
FROM orders
GROUP BY city
HAVING COUNT(*) > 10;
```

## Агрегатные функции

- `COUNT(*)` - количество строк в группе
- `COUNT(column)` - количество НЕ NULL значений
- `COUNT(DISTINCT column)` - количество уникальных значений
- `SUM(column)` - сумма значений
- `AVG(column)` - среднее значение
- `MIN(column)` - минимальное значение
- `MAX(column)` - максимальное значение

## Без GROUP BY

Если использовать агрегатную функцию БЕЗ GROUP BY, получим одну строку для всей таблицы:

```sql
SELECT COUNT(*) AS total_products,
       AVG(price) AS avg_price
FROM products;
```

Результат - одна строка со статистикой по всем продуктам.
