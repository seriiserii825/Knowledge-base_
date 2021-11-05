Установить Docker CE и docker-compose на систему, если у вас MacOS или Windows 
вы можете скачать установщик с офф. сайта

https://www.docker.com/get-started

Если же у вас Linux проводим установку как указано здесь:

https://docs.docker.com/install/linux/docker-ce/ubuntu/#install-docker-ce
Далее устанавливаем docker-compose
https://www.digitalocean.com/community/tutorials/how-to-install-docker-compose-on-ubuntu-16-04

Переходим в домашнюю директорию, создаем папку для проектов и внутри копируем проект из репозитория
git clone git@bitbucket.org:cntechnology/linkmuse.git

Также клонируем LaraDock в папку проектов
git clone https://github.com/Laradock/laradock.git

Переходим в Laradock и копируем файл конфигурации
cd laradock && cp env-example .env

Далее редактируем .env
Ищем и выставляем значение в true
WORKSPACE_INSTALL_MONGO
PHP_FPM_INSTALL_MONGO
PHP_FPM_INSTALL_MEMCACHED
WORKSPACE_INSTALL_LARAVEL_INSTALLER

По умолчанию суперпользователь в MySQL имеет логин root и пароль root но вы можете изменить пароль выставив его в .env 
MYSQL_ROOT_PASSWORD

Далее сохраняем файл и переходим к настройке docker-compose.yml
Ищем в файле следующий блок и убераем в нем строку ${DATA_PATH_HOST}/mysql:/var/lib/mysql (т.к DATA_PATH_HOST не используется по умолчанию)
Должно получится примерно так, нужно это для корректной работы phpMyAdmin.

### MySQL ################################################
    mysql:
      build:
        context: ./mysql
        args:
          - MYSQL_VERSION=${MYSQL_VERSION}
      environment:
        - MYSQL_DATABASE=${MYSQL_DATABASE}
        - MYSQL_USER=${MYSQL_USER}
        - MYSQL_PASSWORD=${MYSQL_PASSWORD}
        - MYSQL_ROOT_PASSWORD=${MYSQL_ROOT_PASSWORD}
        - TZ=${WORKSPACE_TIMEZONE}
      volumes:
       # - ${DATA_PATH_HOST}/mysql:/var/lib/mysql
        - ${MYSQL_ENTRYPOINT_INITDB}:/docker-entrypoint-initdb.d
      ports:
        - "${MYSQL_PORT}:3306"
      networks:
        - backend

Также ищем блок Mongo и меняем его чтобы получилось так
Так как по умолчанию авторизация в Mongo в LaraDock отключена, мы используем другую версию

### MongoDB ##############################################
    mongo:
      build: ./mongo
      image: bitnami/mongodb:3.6
      ports:
        - "${MONGODB_PORT}:27017"
      environment:
        - MONGODB_ROOT_PASSWORD=<ROOT_PASSWORD>
      volumes:
        - ${DATA_PATH_HOST}/mongo:/data/db
      networks:
        - backend

Далее сохраняем файл и переходим к настройке Nginx, переходим в папку ./nginx/sites
Переименовываем laravel.conf.example в laravel.conf и копируем laravel.conf в linkmuse.conf
Открываем файл и меняем <server_name> на подходящий и <root> на /var/www/linkmuse/public, сохраняем и закрываем

Далее редактируем файл /etc/hosts
127.0.0.1       <server_name>

Теперь переходим в папку проекта и устанавливаем все зависимости
composer install && npm install

Далее отредактируем файл конфигурации cp .env.example .env
DB_HOST=mysql
REDIS_HOST=redis
MONGO_DB_HOST=mongo

Далее осталось только запустить LaraDock и подождать пока он всё сделает
Переходим в папку laradock и выполняем следующую команду

sudo docker-compose up -d nginx mysql phpmyadmin mongo redis workspace 

Примерный вывод в конце должен быть таким:
Starting laradock_mongo_1            ... done
Starting laradock_docker-in-docker_1 ... done
Starting laradock_mysql_1            ... done
Starting laradock_redis_1            ... done
Starting laradock_workspace_1        ... done
Starting laradock_phpmyadmin_1       ... done
Starting laradock_php-fpm_1          ... done
Starting laradock_nginx_1            ... done


Теперь чтобы перейти в phpMyAdmin мы переходим по адресу localhost:8080
Сервер: mysql
Логин: root
Пароль: root (если не указывали свой)

MongoDB будет доступна по хосту 127.0.0.1 в MongoDB Compass и.т.п

Чтобы просмотреть логи по контейнеру нужно выполнить
sudo docker-compose logs <container_name>

Чтобы войти в рабочее окружение с терминала нужно выполнить команду 
sudo docker-compose exec workspace bash

Или например если нужно войти в MySQL
sudo docker-compose exec mysql bash

ВАЖНО: команда docker-compose работает только в корне папки laradock !

Документация по LaraDock: http://laradock.io/documentation/

#А вот устанавливать Laravel лучше под обычным пользвателем:
$ docker-compose exec --user=laradock workspace bash   
$ cd /var/www/laradock-example 
$ composer create-project --prefer-dist laravel/laravel="5.2.*" .
$ composer create-project --prefer-dist laravel/laravel .


