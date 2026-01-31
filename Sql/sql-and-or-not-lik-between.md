### Операторы сравнения и логические операторы

1. Операторы сравнения

sql
= -- равно
!= -- не равно
<> -- не равно (альтернатива)

>       -- больше
>
> < -- меньше
> = -- больше или равно
> <= -- меньше или равно
> Примеры:

```sql
SELECT * FROM products WHERE price = 100;
SELECT * FROM products WHERE price != 50;
SELECT * FROM products WHERE price > 100;
SELECT * FROM products WHERE price <= 75;
SELECT * FROM categories WHERE store_id <> 2;
```

### 2. AND (И) - все условия должны быть истинны

```sql
SELECT * FROM products
WHERE price > 50 AND store_id = 3;

SELECT * FROM products
WHERE price >= 100 AND category_id = 5 AND color_id = 13;

SELECT * FROM categories
WHERE store_id = 3 AND title = 'Sport';
```

### 3. OR (ИЛИ) - хотя бы одно условие истинно

```sql
SELECT * FROM products
WHERE price < 30 OR price > 150;

SELECT * FROM colors
WHERE name = 'Red' OR name = 'Blue';

SELECT * FROM categories
WHERE store_id = 2 OR store_id = 3;
```

### 4. NOT (НЕ) - инверсия условия

```sql
SELECT * FROM products
WHERE NOT price > 100;  -- цена НЕ больше 100 (т.е. <= 100)

SELECT * FROM categories
WHERE NOT store_id = 2;  -- не из магазина 2

SELECT * FROM products
WHERE NOT (price >= 50 AND price <= 100);  -- вне диапазона 50-100
```

### 5. LIKE - поиск по шаблону

Символы:

- % - любое количество любых символов
- \_ - один любой символ

-- Начинается с "Pro"

```sql
SELECT * FROM categories WHERE title LIKE 'Pro%';
```

-- Содержит "course"

```sql
SELECT * FROM categories WHERE title LIKE '%course%';
```

-- Заканчивается на "s"

```sql
SELECT * FROM categories WHERE title LIKE '%s';
```

-- Второй символ "e"

```sql
SELECT * FROM colors WHERE name LIKE '_e%';
```

-- Ровно 4 символа

```sql
SELECT * FROM colors WHERE name LIKE '____';
```

-- Не содержит "Tea"

```sql
SELECT * FROM categories WHERE title NOT LIKE '%Tea%';
```

### 6. IN - проверка на вхождение в список

-- По списку ID

```sql
SELECT * FROM products WHERE id IN (1, 5, 7, 12);
```

-- По списку категорий

```sql
SELECT * FROM products WHERE category_id IN (5, 8, 9);
```

-- По списку цветов

```sql
SELECT * FROM colors WHERE name IN ('Red', 'Blue', 'Gray');
```

-- Обратное (NOT IN)
`sql
    SELECT * FROM products WHERE store_id NOT IN (1, 2);
    `

-- С подзапросом

```sql
SELECT * FROM products
WHERE category_id IN (SELECT id FROM categories WHERE store_id = 3);
```

### 7. BETWEEN - диапазон значений (включительно)

sql
-- Цена от 50 до 100

```sql
SELECT * FROM products WHERE price BETWEEN 50 AND 100;
```

-- ID от 5 до 10

```sql
SELECT * FROM categories WHERE id BETWEEN 5 AND 10;
```

-- Дата создания

```sql
SELECT * FROM products
WHERE createdAt BETWEEN '2026-01-01' AND '2026-01-31';
```

-- Обратное (NOT BETWEEN)
`sql
    SELECT * FROM products WHERE price NOT BETWEEN 20 AND 80;
    ` 8. Комбинированные примеры

sql
`sql
-- AND + OR (скобки важны!)
    SELECT * FROM products 
    WHERE (price < 50 OR price > 150) AND store_id = 3;
    `

-- IN + AND

```sql
SELECT * FROM products
WHERE category_id IN (5, 8, 9) AND price BETWEEN 50 AND 200;
```

-- LIKE + AND + NOT

```sql
SELECT * FROM categories
WHERE title LIKE '%course%' AND store_id = 3 AND NOT id = 5;
```

-- BETWEEN + IN + OR

```sql
SELECT * FROM products
    WHERE price BETWEEN 30 AND 100
AND color_id IN (12, 13, 14)
    OR category_id = 11;
```

-- Все операторы вместе

```sql
SELECT * FROM products
    WHERE store_id = 3
AND category_id IN (5, 8, 9, 11)
    AND price BETWEEN 20 AND 150
AND (color_id = 13 OR color_id = 15)
    AND title LIKE '%Course%'
  AND NOT price = 100;
```

### 9. IS NULL / IS NOT NULL

sql
-- Товары без цены

```sql
SELECT * FROM products WHERE price IS NULL;
```

-- Товары с ценой

```sql
SELECT * FROM products WHERE price IS NOT NULL;
```

-- Категории без описания

```sql
SELECT * FROM categories WHERE description IS NULL;
```

-- С комбинацией

```sql
SELECT * FROM products
WHERE price IS NOT NULL AND store_id = 3;
```

10. Приоритет операторов (важно!)

- NOT
- AND
- OR

### Используй скобки для ясности:

sql
-- БЕЗ скобок - сначала AND, потом OR

```sql
SELECT * FROM products
WHERE price > 100 OR category_id = 5 AND store_id = 3;
```

-- Это: (price > 100) OR (category_id = 5 AND store_id = 3)

-- СО скобками - контролируем порядок

```sql
SELECT * FROM products
WHERE (price > 100 OR category_id = 5) AND store_id = 3;
```

Шпаргалка для твоих таблиц:

sql
-- Дешевые товары из магазина 3

```sql
SELECT * FROM products WHERE price < 50 AND store_id = 3;
```

-- Красные или синие товары

```sql
SELECT * FROM products WHERE color_id IN (12, 15);
```

-- Категории с "course" в названии

```sql
SELECT * FROM categories WHERE title LIKE '%course%';
```

-- Товары от 50 до 150 рублей

```sql
SELECT * FROM products WHERE price BETWEEN 50 AND 150;
```

-- Все кроме категорий 1 и 2

```sql
SELECT * FROM products WHERE category_id NOT IN (1, 2);
```
