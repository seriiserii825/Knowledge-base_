Уровень 1: Простые запросы (1-10)

Подсказки:
LIKE '%text%' - содержит "text"
LIKE 'text%' - начинается с "text"
LIKE '%text' - заканчивается на "text"
LIKE '\_\_\_\_' - ровно 4 символа
BETWEEN x AND y - от x до y включительно
IN (1, 2, 3) - равно 1, 2 или 3
IS NULL / IS NOT NULL - проверка на NULL
Используй скобки () для группировки условий с AND/OR!

1. Выбрать все товары дороже 100

```sql
SELECT id,title,price, "createdAt" FROM products WHERE price > 100 ORDER BY price;
```

3. Выбрать все цвета, которые начинаются с буквы "R"

```sql
SELECT * FROM colors WHERE name LIKE 'R%';
```

4. Найти товары с ценой от 50 до 150

```sql
SELECT id, title, price FROM products WHERE price BETWEEN 100 AND 150;
```

5. Выбрать категории с id 5, 8 или 11

```sql
SELECT * FROM categories WHERE id = 5 OR id = 8 OR id = 11;
```

6. Найти все товары без описания (description = NULL)

```sql
SELECT * FROM products WHERE description IS NULL;
SELECT * FROM products WHERE description IS NOT NULL;
```

7. Выбрать цвета НЕ из магазина 2

```sql
SELECT * FROM colors WHERE store_id != 2;
```

8. Найти товары дешевле 30 или дороже 200

```sql
SELECT id, title, price FROM products WHERE price < 30 OR price > 200 ORDER BY price;
```

9. Выбрать категории, в названии которых есть слово "course" (в любом месте)

```sql
SELECT * FROM categories WHERE title LIKE '%course%';
```

11. Товары из магазина 3 И дешевле 100

```sql
SELECT id,title,price,store_id FROM products WHERE store_id = 3 AND price < 100;
```

12. Категории из магазина 3, название которых начинается с "C" ИЛИ с "F"

```sql
SELECT * FROM categories WHERE store_id = 3 AND title LIKE 'C%' OR title LIKE 'F%' ORDER BY title;
```

13. Цвета, в коде которых есть цифры "23" (например,
    #23BED1,
    #D123BB)

```sql
SELECT * FROM colors WHERE value LIKE '%23%';
```

14. Товары с category_id равным 5, 8 или 9 И ценой больше 50

```sql
SELECT id, title, price, category_id FROM products WHERE price > 50 AND category_id in (5,8,9);
```

15. Категории БЕЗ описания (NULL) из магазина 3

```sql
SELECT * FROM categories WHERE description LIKE '';
```

16. Товары, которые НЕ находятся в категориях 1 и 2

```sql
SELECT id, title, category_id FROM products WHERE category_id NOT IN (1,2);
```

18. Товары с ценой НЕ в диапазоне от 40 до 120

```sql
SELECT id, title, price FROM products WHERE price NOT BETWEEN 40 AND 120 ORDER BY price;
```

20. Товары с цветом 12, 13 или 14 И из магазина 3

```sql
SELECT id, title, price, color_id FROM products WHERE color_id IN (12,13,14);
```

### Уровень 3: Сложные комбинации (21-30)

21. Товары, которые (дешевле 40 ИЛИ дороже 150) И при этом из магазина 3

```sql
SELECT id, title, price, store_id FROM products WHERE store_id = 3 AND price < 40 OR price > 150 ORDER BY price;
```

22. Категории, у которых ЕСТЬ описание И название НЕ содержит слово "course"

```sql
SELECT * FROM categories
WHERE description != ''
AND title NOT LIKE '%course%'
AND title NOT LIKE '%Course%'
```

```sql
SELECT * FROM categories
WHERE description != ''
AND title NOT ILIKE '%course%';
```

23. Цвета: название начинается с "M" или "J", И они из магазина 3

```sql
SELECT * FROM colors WHERE store_id = 3 AND name LIKE 'M%' OR name LIKE 'J%';
```

24. Товары: цена от 50 до 100, категория 5 или 8, И есть описание (не NULL)

```sql
SELECT id,title,price FROM products WHERE price BETWEEN 50 AND 100 AND description IS NOT NULL;
```

25. Категории с id от 5 до 15 включительно, НЕ из магазина 2

```sql
SELECT * FROM categories WHERE store_id != 2 AND id BETWEEN 5 AND 14;
```

26. Товары: название содержит "Course" или "Tea" (в любом месте), И цена больше 20

```sql
SELECT id, title, price FROM products WHERE price > 20 AND title LIKE '%Course%' OR title LIKE '%Tea%';
```

27. Цвета: код цвета начинается с "#D" или "#2", И они НЕ из магазина 2

```sql
SELECT * FROM colors WHERE store_id != 2 AND value LIKE '#D%' OR value LIKE '#2%';
```

28. Товары: (категория 11 или 12) И (цвет 12, 15 или 16) И цена меньше 100

```sql
SELECT id,price,color_id,category_id FROM products WHERE category_id IN (11, 12) AND color_id in (12,15,16) AND price < 100;
```
