# 1. Node 24 и папка
```bash
nvm install 24
nvm use 24
```

# 2. Создать проект
```bash
bun create nuxt@latest nuxt-borgoluce --template minimal --packageManager bun --gitInit
cd nuxt-borgoluce
echo 24 > .nvmrc
```

# 3. Модули Nuxt
```bash
bunx nuxi@latest module add i18n
bunx nuxi@latest module add strapi
bunx nuxi@latest module add image
```

# 4. Рендер Rich text (Strapi Blocks)
```bash
bun add vue-strapi-blocks-renderer
```

# 5. Адрес Strapi
```bash
echo 'STRAPI_URL=http://localhost:1337' > .env
grep -n '^\.env' .gitignore
```

# 6. Запуск
```bash
bun run dev
```
