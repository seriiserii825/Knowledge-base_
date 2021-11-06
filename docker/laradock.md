В директории с вашими проектами (или будущими проектами) необходимо склонировать репозиторий laradock.
#Shell
$ ~/projects
$ git clone https://github.com/laradock/laradock.git

#create project
$ cd ~/projects
$ mkdir laradock-example
$ mkdir laradock-example/public
$ touch laradock-example/public/index.php

#Затем в /etc/hosts добавим такую строку
127.0.0.1    laradock-example.local

#В файле нам надо исправить всего 2 строки
server_name laradock-example.local;
root /var/www/laradock-example/public;

#Еще в папке ~/projects/laradock нам надо скопировать файл env-example под новым именем .env.
$ cd ~/projects/laradock
$ cp env-example .env
php7.4 display_errors = On

#Теперь мы можем попробовать запустить наши контейнеры
$ cd ~/projects/laradock/  
$ sudo docker-compose up -d nginx php-fpm mysql workspace

#Вот так можно выключить mysql и apache. По этому же принципу можно выключить другие службы.
$ sudo service  mysql stop 
$ sudo service  apache2 stop

#После этого необходимо повторно запустить docker-compose. В случае успеха лог в консоли будет короткий:
$ docker-compose up -d nginx php-fpm mysql workspace
Starting laradock_applications_1 ...  
Starting laradock_applications_1 
Starting laradock_applications_1 ... done 
Recreating laradock_workspace_1 ...  
Recreating laradock_workspace_1 ... done 
Creating laradock_php-fpm_1 ...  
Creating laradock_php-fpm_1 ... done 
Creating laradock_nginx_1 ...  
Creating laradock_nginx_1 ... done

#Теперь осталось установить laravel. Для этого нам необходимо открыть терминал контейнера workspace:
$ docker-compose exec workspace bash

#И уже в нем перейдем в папку /var/www/laradock-example, удалим там все содержимое и установим laravel.
Содержимое можем удалить из под root
# cd /var/www/laradock-example
# rm -R public
# exit

#А вот устанавливать Laravel лучше под обычным пользвателем:
$ docker-compose exec --user=laradock workspace bash   
$ cd /var/www/laradock-example 
$ composer create-project --prefer-dist laravel/laravel="5.2.*" .
$ composer create-project --prefer-dist laravel/laravel .

#Полезные команды:

$ docker-compose up -d nginx php-fpm mariadb workspace # Запуск нескольких контейнеров
$ docker-compose ps # Посмотреть список контейнеров и их статус
$ docker-compose stop # Остановить все контейнеры
$ docker-compose down # Удалить все образы
$ docker-compose build php-fpm # Пересобрать контейнер php-fpm. Например, после смены версии php
$ docker logs laradock_mysql_1 # Посмотреть последние строки лога контейнера laradock_mysql_1
$ docker-compose exec --user=laradock workspace bash # Войти в контейнер workspace под обычным пользователем
