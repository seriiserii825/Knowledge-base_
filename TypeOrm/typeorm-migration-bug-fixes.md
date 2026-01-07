### Миграции дублируют друг друга. Удалите все миграции и создайте одну чистую:

Удалите все миграции

```bash
rm src/migrations/*.ts
```

# Полностью сбросьте базу

```bash
npm run db:drop
```

# Сгенерируйте одну новую миграцию из entities

```bash
npm run migration:generate
```

# Запустите миграцию

```bash
npm run migration:run
```

Если migration:generate выдаёт ошибку, что нет изменений, используйте synchronize:
Удалите все миграции

```bash
rm src/migrations/*.ts
```

# Сбросьте базу

```bash
npm run db:drop
```

# Создайте пустую миграцию-заглушку

```bash
npm run migration:create
```

Затем временно в data-source.ts:

```ts
typescriptexport const AppDataSource = new DataSource({
// ... остальные настройки
synchronize: true,  // Временно!
migrationsRun: false,
});
```

Запустите приложение — TypeORM создаст таблицы. Затем верните synchronize: false и сгенерируйте миграцию:

```bash
npm run migration:generate
```
