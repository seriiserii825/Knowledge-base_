## don't restart docker
```javascript
sudo systemctl disable docker.service
sudo systemctl disable docker.socket
systemctl list-unit-files | grep -i docker
```

## docker mysql port is in use
``` bash
docker ps
docker stop container_id
docker-compose up -d
```

## docker ssl
To use docker with ssl, just need to install localy nginx, and will be generated ssl keyes
that will update automatic ssl keys in container.

## Установка docker

```javascript
sudo apt install apt-transport-https ca-certificates curl software-properties-common
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu focal stable"
sudo apt update
sudo apt-cache policy docker-ce
sudo apt install docker-ce
sudo systemctl status docker
```

## Установка docker-compose

```javascript
sudo curl -L "https://github.com/docker/compose/releases/download/1.27.4/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
docker-compose --version

sudo apt install php-xml
sudo apt-get install php-mbstring
```

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

## change root password
mysqlworkbench disable ssl in tab

```
sudo mysql -u root 
ALTER USER 'root'@'localhost' IDENTIFIED BY 'root';
FLUSH PRIVILEGES;
exit;

sudo mysql -u root -p
pass = root
```

## connect to container
```
docker exec -it mysql_sockets mysql -u root -p 
```

## change root password
```
ALTER USER 'root'@'%' IDENTIFIED WITH mysql_native_password BY 'root';
FLUSH PRIVILEGES;
exit;
```

## connect again to mysql
```
mysql -u root -P 33062 -p --ssl=FALSE --default-auth=mysql_native_password
```
