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


## access denied for user serii mysql
```
docker exec -it mysql_course mysql -u root -p
pass = root
GRANT ALL PRIVILEGES ON laravel.* TO 'serii'@'%' IDENTIFIED BY 'serii1981';
FLUSH PRIVILEGES;


DB_CONNECTION=mysql
DB_HOST=mysql_course
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=serii
DB_PASSWORD=serii1981

clear cache and migrate
```
.docker-compose.yml
```javascript

  mysql:
    container_name: mysql_course
    image: mysql:8.3.0
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD: root  # Add this line to set the root password
      MYSQL_DATABASE: laravel     # Add this to automatically create the 'laravel' database
      MYSQL_USER: serii           # Add this to create a user
      MYSQL_PASSWORD: serii1981
    volumes:
      - "./docker/mysql:/var/lib/mysql"
    ports:
      - "33062:3306"
    command: --authentication_policy=mysql_native_password

  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    container_name: phpmyadmin_course
    restart: always
    ports:
     - '8084:80'
    environment:
      MAX_EXECUTION_TIME: 600
      UPLOAD_LIMIT: 800M
      PMA_HOST: mysql
      PMA_PORT: 3306
      PMA_ARBITRARY: 1
    depends_on:
     - mysql
```

1. Create a new connection:
    - **Connection Name**: Any name (e.g., `Docker MySQL`)
    - **Hostname**: `localhost`
    - **Port**: `33062`
    - **Username**: `serii`
    - **Password**: `serii1981` (You can save this in the vault for convenience)
2. Click **Test Connection**.
3. If the connection is successful, click **OK** to save it, and then you can connect to the MySQL instance.

### 2\. **Connecting to MySQL via Port `3306` (From inside Docker network)**

Port `3306` is only accessible within the Docker network. If you want to connect to MySQL from another container or service inside Docker, you can use:

- **Hostname**: `mysql_course`
- **Port**: `3306`
- **Username**: `serii`
- **Password**: `serii1981`

This is not accessible directly from your host machine unless port `3306` is exposed, so for external tools like MySQL Workbench, use port `33062` as described in option 1.

### conenct from terminal
```javascript
mysql -u serii -P 33062 -p --skip-ssl
```
