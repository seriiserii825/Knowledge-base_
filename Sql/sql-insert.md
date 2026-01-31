# SQL INSERT - Документация и примеры

Руководство по добавлению данных в базу данных (таблицы Teashop).

---

## 📚 Содержание

1. [Основы INSERT](#основы-insert)
2. [Синтаксис](#синтаксис)
3. [Типы INSERT](#типы-insert)
4. [Примеры по Teashop](#примеры-по-teashop)
5. [INSERT с SELECT](#insert-с-select)
6. [Возврат данных (RETURNING)](#возврат-данных-returning)
7. [Best Practices](#best-practices)

---

## Основы INSERT

**INSERT** - SQL команда для добавления новых записей (строк) в таблицу.

### Когда использовать:

- Регистрация нового пользователя
- Создание нового продукта
- Добавление заказа
- Создание отзыва
- Любое добавление новых данных

---

## Синтаксис

### 1. Базовый INSERT (указываем все колонки)

```sql
INSERT INTO table_name (column1, column2, column3)
VALUES (value1, value2, value3);
```

### 2. INSERT без указания колонок (все по порядку)

```sql
INSERT INTO table_name
VALUES (value1, value2, value3, ...);
```

⚠️ **Не рекомендуется** - порядок колонок может измениться!

### 3. INSERT нескольких записей

```sql
INSERT INTO table_name (column1, column2)
VALUES
    (value1, value2),
    (value3, value4),
    (value5, value6);
```

### 4. INSERT с DEFAULT значениями

```sql
INSERT INTO table_name (column1, column2)
VALUES (value1, DEFAULT);
```

---

## Типы INSERT

### 1. Простой INSERT (одна запись)

```sql
INSERT INTO users (name, email, password)
VALUES ('John Doe', 'john@example.com', 'hashed_password');
```

### 2. Множественный INSERT (несколько записей)

```sql
INSERT INTO products (title, price, store_id)
VALUES
    ('Green Tea', 15.99, 1),
    ('Black Tea', 12.50, 1),
    ('Oolong Tea', 18.00, 2);
```

### 3. INSERT с подзапросом (SELECT)

```sql
INSERT INTO table_name (column1, column2)
SELECT column1, column2
FROM another_table
WHERE condition;
```

### 4. INSERT с RETURNING (PostgreSQL)

```sql
INSERT INTO users (name, email)
VALUES ('Alice', 'alice@example.com')
RETURNING id, name, createdAt;
```

---

## Примеры по Teashop

### 1. Таблица `users`

```sql
-- Простая регистрация пользователя
INSERT INTO users (name, email, password)
VALUES ('Иван Петров', 'ivan@mail.ru', 'hashed_pass_123');

-- С ролью admin
INSERT INTO users (name, email, password, role)
VALUES ('Admin User', 'admin@teashop.com', 'secure_hash', 'admin');

-- Без пароля (OAuth регистрация)
INSERT INTO users (name, email, picture)
VALUES ('Google User', 'user@gmail.com', 'https://avatar.url/photo.jpg');

-- Несколько пользователей сразу
INSERT INTO users (name, email, password)
VALUES
    ('Мария', 'maria@mail.ru', 'hash1'),
    ('Петр', 'petr@mail.ru', 'hash2'),
    ('Ольга', 'olga@mail.ru', 'hash3');

-- С возвратом ID (RETURNING)
INSERT INTO users (name, email, password)
VALUES ('Новый Юзер', 'new@mail.ru', 'hash')
RETURNING id, name, email, createdAt;
```

### 2. Таблица `stores`

```sql
-- Создание магазина
INSERT INTO stores (title, description, user_id)
VALUES ('Tea Paradise', 'Лучшие сорта чая из Китая', 5);

-- С картинкой
INSERT INTO stores (title, description, picture, user_id)
VALUES (
    'Green Leaf Store',
    'Экологически чистый чай',
    '/uploads/store-logo.webp',
    10
);

-- Несколько магазинов
INSERT INTO stores (title, description, user_id)
VALUES
    ('Chai House', 'Индийский чай и специи', 3),
    ('Matcha Magic', 'Японский зеленый чай', 7),
    ('Tea Time', 'Классические английские сорта', 12);

-- С возвратом данных
INSERT INTO stores (title, user_id)
VALUES ('My Tea Shop', 15)
RETURNING id, title, createdAt;
```

### 3. Таблица `categories`

```sql
-- Создание категории
INSERT INTO categories (title, description, store_id)
VALUES ('Зеленый чай', 'Все виды зеленого чая', 1);

-- Несколько категорий для магазина
INSERT INTO categories (title, description, store_id)
VALUES
    ('Черный чай', 'Классические черные сорта', 1),
    ('Белый чай', 'Редкие белые сорта', 1),
    ('Улун', 'Полуферментированный чай', 1),
    ('Пуэр', 'Выдержанный чай', 1);
```

### 4. Таблица `colors`

```sql
-- Добавление цвета
INSERT INTO colors (name, value, store_id)
VALUES ('Красный', '#FF0000', 1);

-- Несколько цветов
INSERT INTO colors (name, value, store_id)
VALUES
    ('Зеленый', '#00FF00', 1),
    ('Синий', '#0000FF', 1),
    ('Черный', '#000000', 1),
    ('Белый', '#FFFFFF', 1);
```

### 5. Таблица `products`

```sql
-- Создание продукта
INSERT INTO products (
    title,
    description,
    price,
    images,
    store_id,
    category_id,
    color_id,
    user_id
)
VALUES (
    'Сенча Премиум',
    'Японский зеленый чай высшего качества',
    25.99,
    ARRAY['/uploads/sencha1.jpg', '/uploads/sencha2.jpg'],
    1,
    2,
    5,
    10
);

-- Продукт без категории и цвета
INSERT INTO products (title, description, price, images, store_id, user_id)
VALUES (
    'Чай Ассам',
    'Индийский черный чай',
    15.50,
    ARRAY['/uploads/assam.jpg'],
    3,
    7
);

-- Несколько продуктов
INSERT INTO products (title, description, price, images, store_id, user_id)
VALUES
    ('Матча', 'Японский порошковый чай', 35.00, ARRAY['/img1.jpg'], 2, 5),
    ('Дарджилинг', 'Индийский чай', 22.50, ARRAY['/img2.jpg'], 3, 5),
    ('Эрл Грей', 'Чай с бергамотом', 18.00, ARRAY['/img3.jpg'], 1, 5);
```

### 6. Таблица `orders`

```sql
-- Создание заказа
INSERT INTO orders (user_id, total)
VALUES (25, 0);
-- total будет обновлен после добавления товаров

-- Создание оплаченного заказа
INSERT INTO orders (user_id, total, status)
VALUES (30, 15999, 'PAID');

-- С возвратом ID заказа
INSERT INTO orders (user_id, total)
VALUES (15, 0)
RETURNING id, user_id, status, createdAt;
```

### 7. Таблица `order_items`

```sql
-- Добавление товара в заказ
INSERT INTO order_items (order_id, product_id, store_id, quantity, price)
VALUES (100, 50, 5, 2, 2599);
-- price в копейках: 25.99 = 2599

-- Несколько товаров в заказ
INSERT INTO order_items (order_id, product_id, store_id, quantity, price)
VALUES
    (101, 10, 1, 1, 1550),
    (101, 15, 1, 3, 2200),
    (101, 20, 2, 2, 3500);

-- С возвратом данных
INSERT INTO order_items (order_id, product_id, store_id, quantity, price)
VALUES (105, 25, 3, 1, 1899)
RETURNING id, order_id, product_id, quantity;
```

### 8. Таблица `reviews`

```sql
-- Создание отзыва
INSERT INTO reviews (text, rating, user_id, product_id, store_id)
VALUES (
    'Отличный чай! Очень понравился вкус и аромат.',
    5,
    12,
    50,
    5
);

-- Несколько отзывов
INSERT INTO reviews (text, rating, user_id, product_id, store_id)
VALUES
    ('Хороший чай, но дороговато', 4, 15, 50, 5),
    ('Не понравился, слишком горький', 2, 20, 50, 5),
    ('Лучший чай, что я пробовал!', 5, 8, 50, 5);

-- С возвратом
INSERT INTO reviews (text, rating, user_id, product_id, store_id)
VALUES ('Средненько', 3, 25, 60, 7)
RETURNING id, rating, createdAt;
```

---

## INSERT с SELECT

### Копирование данных из одной таблицы в другую

```sql
-- Создать архив старых заказов
INSERT INTO orders_archive (id, status, total, user_id, createdAt)
SELECT id, status, total, user_id, createdAt
FROM orders
WHERE createdAt < '2023-01-01';

-- Скопировать продукты одного магазина в другой
INSERT INTO products (title, description, price, images, store_id, user_id)
SELECT title, description, price, images, 10, user_id
FROM products
WHERE store_id = 5;
```

### Примеры с условиями

```sql
-- Добавить в таблицу premium_users всех пользователей с заказами > 10000
INSERT INTO premium_users (user_id, total_spent)
SELECT user_id, SUM(total) as total_spent
FROM orders
WHERE status = 'PAID'
GROUP BY user_id
HAVING SUM(total) > 10000;
```

---

## Возврат данных (RETURNING)

PostgreSQL позволяет вернуть данные после INSERT.

### Синтаксис

```sql
INSERT INTO table_name (column1, column2)
VALUES (value1, value2)
RETURNING column1, column2, id;
```

### Примеры

```sql
-- Вернуть ID нового пользователя
INSERT INTO users (name, email, password)
VALUES ('Test User', 'test@mail.ru', 'hash')
RETURNING id;

-- Вернуть все поля
INSERT INTO products (title, price, store_id, user_id)
VALUES ('New Tea', 19.99, 5, 10)
RETURNING *;

-- Вернуть конкретные поля
INSERT INTO orders (user_id, total)
VALUES (25, 5000)
RETURNING id, status, createdAt;

-- Вернуть вычисляемые значения
INSERT INTO products (title, price, store_id, user_id)
VALUES ('Premium Tea', 50.00, 1, 5)
RETURNING id, title, price, (price * 1.2) as price_with_tax;
```

---

## DEFAULT значения

### Использование DEFAULT

```sql
-- Использовать DEFAULT для picture
INSERT INTO users (name, email, password, picture)
VALUES ('User', 'user@mail.ru', 'hash', DEFAULT);
-- picture будет '/uploads/no-user.webp'

-- DEFAULT для role
INSERT INTO users (name, email, password, role)
VALUES ('Normal User', 'normal@mail.ru', 'hash', DEFAULT);
-- role будет 'user'

-- DEFAULT для всех автоматических полей
INSERT INTO stores (title, description, user_id)
VALUES ('Shop', 'Description', 5);
-- createdAt и updatedAt установятся автоматически
```

### Пропуск колонок (используется DEFAULT)

```sql
-- Не указываем picture - будет DEFAULT
INSERT INTO users (name, email, password)
VALUES ('Alex', 'alex@mail.ru', 'hash');

-- Не указываем role - будет 'user'
INSERT INTO users (name, email, password)
VALUES ('Bob', 'bob@mail.ru', 'hash');
```

---

## NULL значения

```sql
-- Явное указание NULL
INSERT INTO products (title, description, price, images, store_id, category_id, user_id)
VALUES ('Tea', 'Description', 20.00, ARRAY['/img.jpg'], 1, NULL, 5);
-- category_id будет NULL

-- Password может быть NULL (OAuth)
INSERT INTO users (name, email, password)
VALUES ('OAuth User', 'oauth@mail.ru', NULL);
```

---

## Best Practices

### ✅ Хорошие практики

1. **Всегда указывайте колонки явно**

```sql
-- ✅ ХОРОШО
INSERT INTO users (name, email, password)
VALUES ('User', 'user@mail.ru', 'hash');

-- ❌ ПЛОХО
INSERT INTO users
VALUES (1, 'User', 'user@mail.ru', 'hash', NULL, DEFAULT, 'user', NOW(), NOW());
```

2. **Используйте RETURNING для получения ID**

```sql
-- ✅ ХОРОШО
INSERT INTO products (title, price, store_id, user_id)
VALUES ('Tea', 20.00, 1, 5)
RETURNING id;
```

3. **Валидируйте данные перед INSERT**

```javascript
// Backend валидация
if (!email || !password) {
  throw new Error("Email and password required");
}
// Только потом INSERT
```

4. **Используйте транзакции для связанных INSERT**

```sql
BEGIN;

INSERT INTO orders (user_id, total)
VALUES (10, 5000)
RETURNING id;  -- Получим id = 100

INSERT INTO order_items (order_id, product_id, store_id, quantity, price)
VALUES (100, 50, 5, 2, 2500);

COMMIT;
```

5. **Экранируйте данные (защита от SQL injection)**

```javascript
// ✅ ХОРОШО - используйте параметризованные запросы
db.query("INSERT INTO users (name, email) VALUES ($1, $2)", [name, email]);

// ❌ ПЛОХО - SQL injection!
db.query(`INSERT INTO users (name, email) VALUES ('${name}', '${email}')`);
```

### ⚠️ Частые ошибки

1. **Забыли обязательное поле**

```sql
-- ❌ ОШИБКА - email обязательно (NOT NULL)
INSERT INTO users (name, password)
VALUES ('User', 'hash');
```

2. **Неверный тип данных**

```sql
-- ❌ ОШИБКА - price должен быть числом
INSERT INTO products (title, price, store_id, user_id)
VALUES ('Tea', 'двадцать рублей', 1, 5);
```

3. **Нарушение внешнего ключа**

```sql
-- ❌ ОШИБКА - user_id = 9999 не существует
INSERT INTO stores (title, user_id)
VALUES ('Shop', 9999);
```

4. **Дубликат уникального поля**

```sql
-- ❌ ОШИБКА - email уже существует (UNIQUE)
INSERT INTO users (name, email, password)
VALUES ('User2', 'existing@mail.ru', 'hash');
```

---

## Массовый INSERT (Bulk Insert)

### Эффективная вставка множества записей

```sql
-- Вставка 1000 продуктов за один запрос
INSERT INTO products (title, description, price, images, store_id, user_id)
VALUES
    ('Product 1', 'Desc 1', 10.00, ARRAY['/img1.jpg'], 1, 5),
    ('Product 2', 'Desc 2', 15.00, ARRAY['/img2.jpg'], 1, 5),
    ('Product 3', 'Desc 3', 20.00, ARRAY['/img3.jpg'], 1, 5),
    -- ... еще 997 записей
    ('Product 1000', 'Desc 1000', 25.00, ARRAY['/img1000.jpg'], 1, 5);
```

### В коде (JavaScript пример)

```javascript
const products = [
  { title: "Tea 1", price: 10.0, store_id: 1 },
  { title: "Tea 2", price: 15.0, store_id: 1 },
  // ... много продуктов
];

// Формируем VALUES
const values = products.map((p) => `('${p.title}', ${p.price}, ${p.store_id}, 5)`).join(",");

const query = `
  INSERT INTO products (title, price, store_id, user_id)
  VALUES ${values}
`;

await db.query(query);
```

---

## Примеры реальных сценариев

### Сценарий 1: Регистрация пользователя

```sql
INSERT INTO users (name, email, password, role)
VALUES ('Иван Иванов', 'ivan@mail.ru', '$2b$10$hashed_password', 'user')
RETURNING id, name, email, role, createdAt;
```

### Сценарий 2: Создание магазина с категориями

```sql
-- 1. Создаем магазин
INSERT INTO stores (title, description, user_id)
VALUES ('Tea World', 'Магазин чая', 10)
RETURNING id;  -- Получим id = 5

-- 2. Создаем категории для магазина
INSERT INTO categories (title, description, store_id)
VALUES
    ('Зеленый чай', 'Зеленые сорта', 5),
    ('Черный чай', 'Черные сорта', 5),
    ('Травяной чай', 'Травяные сборы', 5);
```

### Сценарий 3: Оформление заказа

```sql
BEGIN;

-- 1. Создаем заказ
INSERT INTO orders (user_id, total, status)
VALUES (25, 0, 'PENDING')
RETURNING id;  -- id = 100

-- 2. Добавляем товары
INSERT INTO order_items (order_id, product_id, store_id, quantity, price)
VALUES
    (100, 10, 1, 2, 1550),  -- 2 шт по 15.50
    (100, 15, 1, 1, 2500);  -- 1 шт за 25.00

-- 3. Обновляем total заказа
UPDATE orders
SET total = 4600  -- 15.50*2 + 25.00 = 46.00
WHERE id = 100;

COMMIT;
```

### Сценарий 4: Добавление отзыва

```sql
INSERT INTO reviews (text, rating, user_id, product_id, store_id)
VALUES (
    'Отличный чай! Рекомендую всем любителям зеленого чая.',
    5,
    12,
    50,
    5
)
RETURNING id, rating, createdAt;
```

---

## Шпаргалка

```sql
-- Базовый INSERT
INSERT INTO table (col1, col2) VALUES (val1, val2);

-- Множественный INSERT
INSERT INTO table (col1, col2)
VALUES (val1, val2), (val3, val4);

-- INSERT с RETURNING
INSERT INTO table (col1, col2)
VALUES (val1, val2)
RETURNING id, col1;

-- INSERT с SELECT
INSERT INTO table1 (col1, col2)
SELECT col1, col2 FROM table2 WHERE condition;

-- INSERT с DEFAULT
INSERT INTO table (col1, col2) VALUES (val1, DEFAULT);

-- INSERT с NULL
INSERT INTO table (col1, col2) VALUES (val1, NULL);
```
