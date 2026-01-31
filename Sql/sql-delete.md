### SQL DELETE синтаксис

Базовый синтаксис:

```sql
DELETE FROM table_name WHERE condition;
```

### Полезные советы:

Перед удалением - проверь SELECT:

-- Сначала посмотри, что удалится

```sql
SELECT * FROM products WHERE price IS NULL;
```

-- Потом удаляй

```sql
DELETE FROM products WHERE price IS NULL;
```

Безопасное удаление с лимитом (MySQL):

```sql
DELETE FROM products WHERE price < 10 LIMIT 5;
```

### ⚠️ ВАЖНО: Без WHERE удалятся ВСЕ строки!

Примеры:

### 1. Удалить один товар по ID

```sql
DELETE FROM products WHERE id = 5;
```

### 2. Удалить все товары с NULL ценой

```sql
DELETE FROM products WHERE price IS NULL;
```

### 3. Удалить товары дешевле 10

```sql
DELETE FROM products WHERE price < 10;
```

### 4. Удалить по нескольким условиям (AND)

```sql
DELETE FROM products WHERE store_id = 3 AND category_id = 8;
```

### 5. Удалить по списку ID (IN)

```sql
DELETE FROM products WHERE id IN (1, 5, 7, 12); 6. Удалить товары из определенной категории
```

```sql
DELETE FROM categories WHERE title = 'Since';
```
