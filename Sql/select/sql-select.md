### syntax

```sql
SELECT столбец1, столбец2 FROM название_таблицы;
SELECT * FROM название_таблицы;  -- все столбцы
```

### Пример использования SELECT

```sql
-- Выбрать все данные
SELECT * FROM users;

-- Выбрать только имена и возраст
SELECT name, age FROM users;

-- Выбрать с условием (WHERE)
SELECT * FROM users WHERE age > 25;

-- Сортировка (ORDER BY)
SELECT * FROM users ORDER BY age DESC;  -- по убыванию
SELECT * FROM users ORDER BY name ASC;   -- по возрастанию

SELECT text, rating, createdAt
FROM reviews
ORDER BY rating DESC, createdAt DESC;

SELECT id,title,price FROM products ORDER BY price DESC LIMIT 2 OFFSET 2;

-- Ограничить количество результатов
SELECT * FROM users LIMIT 5;

-- Выбрать с вычислениями
SELECT first_name, salary, salary * 12 AS annual_salary
FROM employees;
```

### Where

```sql
-- Простое условие
SELECT * FROM employees
WHERE salary > 50000;

-- Несколько условий (AND)
SELECT * FROM employees
WHERE salary > 50000 AND department = 'IT';

-- Альтернативные условия (OR)
SELECT * FROM employees
WHERE department = 'IT' OR department = 'HR';

-- Отрицание (NOT)
SELECT * FROM employees
WHERE NOT department = 'Sales';

-- Диапазон значений (BETWEEN)
SELECT * FROM employees
WHERE salary BETWEEN 40000 AND 60000;

-- Проверка на NULL
SELECT * FROM employees
WHERE bonus IS NULL;

-- Поиск по шаблону (LIKE)
SELECT * FROM employees
WHERE first_name LIKE 'A%';  -- начинается с A
WHERE email LIKE '%@gmail.com';  -- заканчивается на @gmail.com
WHERE phone LIKE '___-____';  -- точный формат (3 цифры-4 цифры)

-- Список значений (IN)
SELECT * FROM employees
WHERE department IN ('IT', 'HR', 'Finance');
```

### order by

```sql
-- Сортировка по возрастанию (по умолчанию)
SELECT * FROM employees
ORDER BY salary;

-- Сортировка по убыванию
SELECT * FROM employees
ORDER BY salary DESC;

-- Множественная сортировка
SELECT * FROM employees
ORDER BY department ASC, salary DESC;

-- Сортировка по вычисляемому полю
SELECT first_name, salary, salary * 12 AS annual_salary
FROM employees
ORDER BY annual_salary DESC;
```

### LIMIT и OFFSET - Ограничение результатов

```sql
-- Первые 10 записей
SELECT \* FROM employees
LIMIT 10;

-- Пропустить первые 20, взять следующие 10
SELECT \* FROM employees
LIMIT 10 OFFSET 20;

-- Топ-5 самых высокооплачиваемых
SELECT \* FROM employees
ORDER BY salary DESC
LIMIT 5;
```
