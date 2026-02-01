# SQL Агрегатные функции

## Обзор

Агрегатные функции выполняют вычисления над набором строк и возвращают одно значение. Используются для анализа данных, подсчета статистики и получения сводной информации.

---

## Основные агрегатные функции

### COUNT() - Подсчет количества строк

Возвращает количество строк, соответствующих условию.

**Синтаксис:**
```sql
COUNT(*) | COUNT(column_name) | COUNT(DISTINCT column_name)
```

**Примеры:**
```sql
-- Подсчитать все товары
SELECT COUNT(*) FROM products;

-- Подсчитать товары с заполненным описанием
SELECT COUNT(description) FROM products;

-- Подсчитать уникальные категории
SELECT COUNT(DISTINCT category_id) FROM products;

-- Подсчитать товары дороже 100
SELECT COUNT(*) FROM products WHERE price > 100;
```

**Особенности:**
- `COUNT(*)` - считает все строки, включая NULL
- `COUNT(column_name)` - считает только НЕ NULL значения
- `COUNT(DISTINCT column_name)` - считает уникальные значения

---

### SUM() - Сумма значений

Возвращает сумму всех значений в числовом столбце.

**Синтаксис:**
```sql
SUM(column_name)
```

**Примеры:**
```sql
-- Общая стоимость всех товаров
SELECT SUM(price) FROM products;

-- Сумма цен товаров из категории 5
SELECT SUM(price) FROM products WHERE category_id = 5;

-- Сумма товаров магазина 3
SELECT SUM(price) FROM products WHERE store_id = 3;
```

**Особенности:**
- Игнорирует NULL значения
- Работает только с числовыми столбцами
- Возвращает NULL если нет подходящих строк

---

### AVG() - Среднее значение

Возвращает среднее арифметическое значений в числовом столбце.

**Синтаксис:**
```sql
AVG(column_name)
```

**Примеры:**
```sql
-- Средняя цена всех товаров
SELECT AVG(price) FROM products;

-- Средняя цена товаров категории 8
SELECT AVG(price) FROM products WHERE category_id = 8;

-- Средняя цена с округлением до 2 знаков
SELECT ROUND(AVG(price), 2) FROM products;
```

**Особенности:**
- Игнорирует NULL значения
- Возвращает десятичное число
- NULL если нет подходящих строк

---

### MIN() - Минимальное значение

Возвращает наименьшее значение в столбце.

**Синтаксис:**
```sql
MIN(column_name)
```

**Примеры:**
```sql
-- Самая низкая цена
SELECT MIN(price) FROM products;

-- Минимальная цена в категории 5
SELECT MIN(price) FROM products WHERE category_id = 5;

-- Самая ранняя дата создания категории
SELECT MIN(createdAt) FROM categories;

-- Первый цвет в алфавитном порядке
SELECT MIN(name) FROM colors;
```

**Особенности:**
- Работает с числами, датами и строками
- Игнорирует NULL значения
- Для строк - первое значение в алфавитном порядке

---

### MAX() - Максимальное значение

Возвращает наибольшее значение в столбце.

**Синтаксис:**
```sql
MAX(column_name)
```

**Примеры:**
```sql
-- Самая высокая цена
SELECT MAX(price) FROM products;

-- Максимальная цена в магазине 3
SELECT MAX(price) FROM products WHERE store_id = 3;

-- Самая поздняя дата обновления
SELECT MAX(updatedAt) FROM categories;

-- Последний цвет в алфавитном порядке
SELECT MAX(name) FROM colors;
```

**Особенности:**
- Работает с числами, датами и строками
- Игнорирует NULL значения
- Для строк - последнее значение в алфавитном порядке

---

## Комбинирование функций

Можно использовать несколько агрегатных функций в одном запросе:

```sql
-- Статистика по товарам
SELECT 
  COUNT(*) AS total_products,
  SUM(price) AS total_value,
  AVG(price) AS average_price,
  MIN(price) AS cheapest,
  MAX(price) AS most_expensive
FROM products;

-- Статистика по категории 5
SELECT 
  COUNT(*) AS count,
  ROUND(AVG(price), 2) AS avg_price,
  MIN(price) AS min_price,
  MAX(price) AS max_price
FROM products 
WHERE category_id = 5;
```

---

## Использование с WHERE

Агрегатные функции применяются ПОСЛЕ фильтрации WHERE:

```sql
-- Средняя цена товаров дороже 50
SELECT AVG(price) FROM products WHERE price > 50;

-- Количество товаров в магазине 3 с описанием
SELECT COUNT(*) FROM products 
WHERE store_id = 3 AND description IS NOT NULL;

-- Сумма дешевых товаров (до 100)
SELECT SUM(price) FROM products WHERE price < 100;
```

---

## Псевдонимы (AS)

Присваивание понятных имен результатам:

```sql
SELECT 
  COUNT(*) AS total_products,
  AVG(price) AS average_price,
  MIN(price) AS min_price,
  MAX(price) AS max_price
FROM products;
```

**Результат:**
```
total_products | average_price | min_price | max_price
---------------|---------------|-----------|----------
      50       |     85.50     |   18.50   |  199.00
```

---

## Работа с NULL

```sql
-- COUNT(*) считает все строки, включая NULL
SELECT COUNT(*) FROM products;  -- 50

-- COUNT(column) считает только НЕ NULL
SELECT COUNT(description) FROM products;  -- 35

-- Разница показывает количество NULL
SELECT 
  COUNT(*) AS total,
  COUNT(description) AS with_description,
  COUNT(*) - COUNT(description) AS without_description
FROM products;
```

---

## Математические операции

```sql
-- Общая выручка, если продать все товары
SELECT SUM(price) AS total_revenue FROM products;

-- Средняя цена с налогом 20%
SELECT AVG(price * 1.2) AS avg_with_tax FROM products;

-- Разница между макс и мин ценой
SELECT MAX(price) - MIN(price) AS price_range FROM products;

-- Процент товаров с описанием
SELECT 
  ROUND(COUNT(description) * 100.0 / COUNT(*), 2) AS percent_with_description
FROM products;
```

---

## Округление результатов

### ROUND() - Округление

```sql
-- Округлить до целого
SELECT ROUND(AVG(price)) FROM products;

-- Округлить до 2 знаков после запятой
SELECT ROUND(AVG(price), 2) FROM products;

-- Округлить сумму
SELECT ROUND(SUM(price), 2) FROM products;
```

### CEIL() / CEILING() - Округление вверх

```sql
-- Округлить среднюю цену вверх
SELECT CEIL(AVG(price)) FROM products;
```

### FLOOR() - Округление вниз

```sql
-- Округлить среднюю цену вниз
SELECT FLOOR(AVG(price)) FROM products;
```

---

## Практические примеры

### Анализ товаров

```sql
-- Полная статистика по товарам
SELECT 
  COUNT(*) AS total_products,
  COUNT(DISTINCT category_id) AS unique_categories,
  COUNT(DISTINCT color_id) AS unique_colors,
  ROUND(AVG(price), 2) AS avg_price,
  MIN(price) AS cheapest_product,
  MAX(price) AS most_expensive_product,
  SUM(price) AS total_inventory_value
FROM products;
```

### Анализ по магазину

```sql
-- Статистика товаров магазина 3
SELECT 
  COUNT(*) AS products_count,
  ROUND(AVG(price), 2) AS average_price,
  MIN(price) AS min_price,
  MAX(price) AS max_price,
  SUM(price) AS total_value
FROM products
WHERE store_id = 3;
```

### Анализ по категории

```sql
-- Статистика по категории "Sport" (id = 8)
SELECT 
  COUNT(*) AS sport_products,
  ROUND(AVG(price), 2) AS avg_sport_price,
  MIN(price) AS cheapest_sport_item,
  MAX(price) AS most_expensive_sport_item
FROM products
WHERE category_id = 8;
```

### Анализ ценовых диапазонов

```sql
-- Количество товаров в разных ценовых категориях
SELECT COUNT(*) AS cheap_products 
FROM products WHERE price < 50;

SELECT COUNT(*) AS medium_products 
FROM products WHERE price BETWEEN 50 AND 100;

SELECT COUNT(*) AS expensive_products 
FROM products WHERE price > 100;
```

### Проверка качества данных

```sql
-- Сколько товаров без описания
SELECT 
  COUNT(*) AS total,
  COUNT(description) AS with_description,
  COUNT(*) - COUNT(description) AS without_description
FROM products;

-- Сколько категорий без описания
SELECT COUNT(*) FROM categories WHERE description IS NULL;
```

---

## Важные замечания

⚠️ **Ограничения:**
- Нельзя смешивать агрегатные функции и обычные столбцы без GROUP BY
- Агрегатные функции игнорируют NULL (кроме COUNT(*))
- WHERE выполняется ДО агрегации

✅ **Лучшие практики:**
- Всегда используй AS для понятных имен
- Округляй результаты AVG для читаемости
- Используй COUNT(DISTINCT) для подсчета уникальных значений
- Проверяй NULL значения при анализе данных

---

## Следующий шаг

После освоения агрегатных функций переходи к **GROUP BY** и **HAVING** для группировки данных и фильтрации групп!
