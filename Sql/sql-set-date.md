# SQL: Обновление поля createdAt

## 1. Обновить конкретную дату

```sql
-- Установить конкретную дату
UPDATE stores
SET "createdAt" = '2025-12-15 10:30:00'
WHERE id = 4;
```

## 2. Изменить только год

```sql
-- Изменить год на 2025, сохранив месяц, день и время
UPDATE stores
SET "createdAt" = "createdAt" - INTERVAL '1 year'
WHERE id IN (4, 3, 6);

-- Или установить конкретный год
UPDATE stores
SET "createdAt" = DATE_TRUNC('year', "createdAt") + INTERVAL '2025 years - 1970 years'
WHERE id = 4;
```

## 3. Изменить только месяц

```sql
-- Добавить 2 месяца
UPDATE stores
SET "createdAt" = "createdAt" + INTERVAL '2 months'
WHERE id = 4;

-- Установить конкретный месяц (например, март = месяц 3)
UPDATE stores
SET "createdAt" = DATE_TRUNC('year', "createdAt") +
                   INTERVAL '2 months' +
                   (EXTRACT(DAY FROM "createdAt") - 1) * INTERVAL '1 day' +
                   EXTRACT(HOUR FROM "createdAt") * INTERVAL '1 hour' +
                   EXTRACT(MINUTE FROM "createdAt") * INTERVAL '1 minute' +
                   EXTRACT(SECOND FROM "createdAt") * INTERVAL '1 second'
WHERE id = 4;
```

## 4. Изменить только день

```sql
-- Установить 15-е число текущего месяца
UPDATE stores
SET "createdAt" = DATE_TRUNC('month', "createdAt") + INTERVAL '14 days' +
                   EXTRACT(HOUR FROM "createdAt") * INTERVAL '1 hour' +
                   EXTRACT(MINUTE FROM "createdAt") * INTERVAL '1 minute' +
                   EXTRACT(SECOND FROM "createdAt") * INTERVAL '1 second'
WHERE id = 4;
```

## 5. Универсальный способ с make_timestamp

```sql
-- Изменить год и месяц, оставив остальное
UPDATE stores
SET "createdAt" = make_timestamp(
    2025,  -- новый год
    12,    -- новый месяц
    EXTRACT(DAY FROM "createdAt")::int,
    EXTRACT(HOUR FROM "createdAt")::int,
    EXTRACT(MINUTE FROM "createdAt")::int,
    EXTRACT(SECOND FROM "createdAt")
)
WHERE id = 4;
```

## 6. Практические примеры для ваших данных

```sql
-- Перенести все записи на год назад (в 2025)
UPDATE stores
SET "createdAt" = "createdAt" - INTERVAL '1 year';

-- Перенести только записи января на декабрь 2025
UPDATE stores
SET "createdAt" = "createdAt" - INTERVAL '1 month' - INTERVAL '1 year'
WHERE EXTRACT(MONTH FROM "createdAt") = 1;

-- Установить всем одну дату
UPDATE stores
SET "createdAt" = '2025-06-01 00:00:00';

-- Установить случайные даты в диапазоне
UPDATE stores
SET "createdAt" = '2025-01-01'::timestamp +
                   (random() * (CURRENT_TIMESTAMP - '2025-01-01'::timestamp));
```

## ⚠️ Важно

**Обычно `createdAt` не рекомендуется изменять в production**, так как это поле отражает реальное время создания записи. Изменяйте только для тестовых данных!

## Примеры результатов

### До обновления:

| id  | title                          | createdAt           |
| --- | ------------------------------ | ------------------- |
| 4   | Dragon Pearl Jasmine Green Tea | 2026-01-25 12:30:48 |
| 3   | Earl Grey Supreme              | 2026-01-25 12:22:54 |

### После обновления (год на 2025):

| id  | title                          | createdAt           |
| --- | ------------------------------ | ------------------- |
| 4   | Dragon Pearl Jasmine Green Tea | 2025-01-25 12:30:48 |
| 3   | Earl Grey Supreme              | 2025-01-25 12:22:54 |
