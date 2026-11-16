<!-- cspell:words bunx strapi borgoluce pgdata nvmrc conninfo nuxt Cloudinary -->
<!-- prettier-ignore-start -->

# Strapi + Postgres через bun

0. Проверить bun и Node

```bash
bun --version || curl -fsSL https://bun.sh/install | bash
nvm use 24
```

Если bun только что поставился, перезапусти шелл или выполни `source ~/.zshrc`.

1. Папка

```bash
mkdir -p ~/Documents/projects/shop && cd ~/Documents/projects/shop
```

2. Создать Strapi без установки пакетов

```bash
bunx create-strapi@latest strapi-borgoluce --non-interactive --skip-cloud --no-run --ts \
  --no-install --no-example --no-git-init --dbclient=postgres \
  --dbhost=localhost --dbport=5432 --dbname=borgoluce --dbusername=strapi --dbpassword=strapi
cd strapi-borgoluce
rm -f package-lock.json yarn.lock pnpm-lock.yaml
echo 24 > .nvmrc
bun install
```

Если create-strapi ругается на `--no-install`, убери этот флаг и добавь `--use-npm`. Потом выполни
`rm -rf node_modules package-lock.json && bun install`.

3. docker-compose.yml

```bash
cat > docker-compose.yml <<'EOF'
services:
  postgres:
    image: postgres:17
    restart: unless-stopped
    environment:
      POSTGRES_DB: ${DATABASE_NAME}
      POSTGRES_USER: ${DATABASE_USERNAME}
      POSTGRES_PASSWORD: ${DATABASE_PASSWORD}
    ports: ["5432:5432"]
    volumes: [pgdata:/var/lib/postgresql/data]
volumes:
  pgdata:
EOF
grep DATABASE .env
```

4. Запуск

```bash
docker compose up -d
docker compose exec postgres psql -U strapi -d borgoluce -c '\conninfo'
bun run develop
```

Открой http://localhost:1337/admin и создай админа.

5. Git

```bash
grep -n '^\.env' .gitignore
git init && git add . && git commit -m "init: strapi + postgres (bun)"
```

6. Мультиязычность

В админке открой Settings → Internationalization и добавь ro (по умолчанию), ru и en.

Проверка: останови `bun run develop` и запусти снова. Если логин админа сохранился, данные лежат в Postgres.

Если `bun install` или `develop` упадёт (у Strapi бывают проблемы с нативными модулями под bun), присылай вывод, разберёмся.

7. Где хранятся медиа (картинки, видео, PDF)

Файлы лежат на диске в `public/uploads/` проекта Strapi, а не в git. Стандартный `.gitignore` Strapi:

```
public/uploads/*
!public/uploads/.gitkeep
```

- В Postgres хранятся только записи о файлах (`files`: имя, размеры, форматы, путь `/uploads/name_hash.jpg`).
- Сами файлы лежат в папке, Strapi отдаёт их по `http://localhost:1337/uploads/...`.
- Для каждой картинки рядом создаются копии `thumbnail_…`, `small_…`, `medium_…`, `large_…`.
- Перенос на другую машину или сервер: нужны **и база, и `public/uploads`**. Без папки картинки битые, без базы Strapi о файлах не знает.

```bash
docker compose exec -T postgres pg_dump -U strapi -Fc borgoluce > borgoluce.dump
tar czf uploads.tgz public/uploads
# на новой машине:
docker compose exec -T postgres pg_restore -U strapi -d borgoluce --clean --if-exists < borgoluce.dump
tar xzf uploads.tgz
```

Позже можно хранить файлы в S3 или Cloudinary через upload-провайдер Strapi, тогда папка не нужна.

8. Локальный production build (Strapi + Nuxt)

Сначала останови dev-серверы: порты те же (1337 и 3000).

```bash
# Strapi
cd ~/Documents/strapi/strapi-borgoluce && nvm use
bun run build          # собирает админку в dist/
bun run start          # http://localhost:1337/admin

# Nuxt (Strapi уже должен быть запущен)
cd ~/Documents/nuxt/nuxt-borgoluce && nvm use
bun run build          # .output/
bun run preview        # http://localhost:3000  (= node .output/server/index.mjs)
```

- Значения из `.env` Nuxt (`STRAPI_URL`, SMTP) попадают в сборку в момент `build`. Поменял `.env` — пересобери. Без пересборки можно переопределить через `NUXT_PUBLIC_STRAPI_URL`, `NUXT_SMTP_HOST` и т.п.
- Изменения кода подхватываются только после нового `build` + перезапуска. Контент в админке Strapi меняется сразу.
- В `strapi start` Content-Type Builder недоступен, схемы меняются только в `develop`.
- С `NODE_ENV=production` вход в админку по `http://localhost` может не работать: cookie сессии становится secure-only. Запускай `bun run start` без этой переменной. API работает в любом случае.
- Вернуться к разработке: останови оба процесса, затем `bun run develop` / `bun run dev`.

<!-- prettier-ignore-end -->
