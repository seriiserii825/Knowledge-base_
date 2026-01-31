### insert syntax

```sql
INSERT INTO название_таблицы (столбец1, столбец2, столбец3)
VALUES (значение1, значение2, значение3);
```

### Пример использования INSERT

```sql
-- Добавить одного пользователя
INSERT INTO users (name, email, age)
VALUES ('Петр', 'petr@mail.ru', 28);

-- Добавить несколько пользователей сразу
INSERT INTO users (name, email, age)
VALUES
  ('Анна', 'anna@mail.ru', 22),
  ('Сергей', 'sergey@mail.ru', 35);
```
