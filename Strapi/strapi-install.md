<!-- cspell:words bunx strapi borgoluce pgdata nvmrc conninfo -->
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

<!-- prettier-ignore-end -->
