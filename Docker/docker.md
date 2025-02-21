## Important commands
run docker-compose up --build if was changed Dockerfile or docker-compose.yml file

## Добавить пользователя в группу docker

```javascript
sudo usermod -aG docker ${USER}
su - ${USER}
id -nG
sudo usermod -aG docker serii
```

## На случай ошибки выполнить следующие команды

```javascript
sudo chmod 666 /var/run/docker.sock
sudo usermod -aG docker serii
sudo chmod 666 /var/run/docker.sock
newgrp docker
```

### dockerignore
```
touch .dockerignore
echo "node_modules" >> .dockerignore
```

### Создание образа

```
docker build -t server-app:v1 .
```

### Создание контейнера

```
docker run -d --name test2 -p 3002:3000 server-app:v1
```

## Подключиться к контейнеру
```
docker exec -it test2 /bin/bash
```

## Добавить переменные окружения

```
docker run -d -e MY_ENV_VARIABLE=test nginx
docker exec -it focused_wiles /bin/bash
printenv
NGINX_VERSION=1.27.3
MY_ENV_VARIABLE=test

```

## Очистка

```javascript
docker stop $(docker ps -q) - остановить все контейнеры
docker container prune - удалить все остановленные контейнеры
docker system prune - удалить все неиспользуемые контейнеры(остановленные), сети, образы и тома
docker system prune -a - hard reset, останавливает все контейнеры и удаляет все образы
```

## Удалить образ

```
docker rmi name or id
```

Если образ используется, то сначала нужно удалить контейнер

```
docker ps - только запущенные контейнеры
docker ps -a - все контейнеры
```

Если контейнер используется, то сначала нужно остановить его

```
docker stop container
docker rm container_name
docker images
docker rmi image_name
```

## remove unused images

```javascript
docker image prune -a
```

## Переустановка контейнеров

```javascript
docker-compose up --build
```

## exec script in container

$ docker exec -it container /bin/bash
cd /home/client
npm install

# inspect container for errors

```
docker logs nginx_course
docker volume ls
docker inspect nginx_course
```

#### 2\. **Verify MySQL Root User Authentication Plugin**

If the `mysql_native_password` command doesn’t work (e.g., for existing databases), you’ll need to manually change the root user's authentication plugin.

1. Enter the MySQL container:
   `docker exec -it mysql_example_app mysql -uroot -proot`
2. Switch the root user's plugin to `mysql_native_password`:
   `ALTER USER 'root'@'%' IDENTIFIED WITH mysql_native_password BY 'root'; FLUSH PRIVILEGES;`

## change root password

```
ALTER USER 'root'@'%' IDENTIFIED WITH mysql_native_password BY 'root';
FLUSH PRIVILEGES;
exit;
```
