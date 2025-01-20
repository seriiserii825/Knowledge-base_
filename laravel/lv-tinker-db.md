## view db schema
```
docker-compose exec php-fpm php artisan tinker
DB::select('SELECT version()')
```
