#создать таблицу articles
php artisan make:migration create_articles_table --create=articles 

#Применятся миграции, описанные в каталоге migrations
php artisan migrate 

#Отменить миграции
php artisan migrate:rollback 

#Редактировать таблицу articles
php artisan make:migration cange_articles_table --table=articles

#Отменить действия всех миграций
php artisan migrate:reset


#Движок таблицы
$table->engine = 'InnoDB';

#file migration error
composer dump-autoload


