### generate migration

```bash
npm run build
npm run migration:generate
```

### run migration

```bash
# Сначала соберите проект
npm run build

# Затем запустите миграцию
npm run migration:run
```

### revert migration

```bash
# Сначала соберите проект
npm run build
# Затем откатите миграцию
npm run migration:revert
```

### clear migration

```bash
# Сначала соберите проект
npm run build
# Затем очистите миграции
npm run migration:clear
```

### show migration

```bash
# Сначала соберите проект
npm run build
# Затем покажите миграции
npm run migration:show
```
