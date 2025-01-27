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

## Запуск или установка

```javascript
docker-compose up -d(d - in background)
```

## Очистка

Ever wanted to get rid of unnecessary things with Docker? If you want to delete a Docker object, that's often the case. In that case, the command Docker prune is effective. The prune command allows you to delete unused Docker objects (containers, images, networks, volumes) all at once. The following is an example.

```javascript
docker system prune
```

## Посмотреть контейнеры

```javascript
docker ps
docker ps -a
docker-compose ps
```

## Удалить контейнеры

```javascript
docker rm -vf $(docker ps -a -q)
```

## Посмотреть образы

```javascript
docker images
```

## remove unused images

```javascript
docker image prune -a
```

## Удалить образ

```
docker rmi hash
```

## Удалить образы

```javascript
docker rmi -f $(docker images -a -q)
```

## Переустановка контейнеров

```javascript
docker-compose stop nginx # stop if running
docker-compose rm -f nginx # remove without confirmation
docker-compose build nginx # build
docker-compose up -d nginx # create and start in background
```

## exec script in container

$ docker exec -it container /bin/bash
cd /home/client
npm install

# inspect container for errors

docker logs nginx_course

## connect to container

```
docker exec -it mysql_sockets mysql -u root -p
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
