# Deploy laravel

```bash
docker-compose exec php-fpm php artisan key:generate --force
docker-compose exec php-fpm php artisan optimize:clear
docker-compose exec php-fpm php artisan config:cache
docker-compose exec php-fpm php artisan route:cache
docker-compose exec php-fpm php artisan view:cache
docker-compose exec php-fpm php artisan migrate --force
docker-compose exec php-fpm sh -lc "php artisan storage:link || true"
```

.env

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=http://your-domain.com
```

## Permissions (once or after deploys)

```bash

docker compose exec php-fpm sh -lc "chown -R www-data:www-data storage bootstrap/cache public/build || true"
```
