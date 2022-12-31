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

## Добавить пользователя в группу docker

```javascript
sudo usermod -aG docker ${USER}
su - ${USER}
id -nG
sudo usermod -aG docker username
```

## На случай ошибки выполнить следующие команды

```javascript
sudo chmod 666 /var/run/docker.sock
sudo usermod -aG docker serii
sudo chmod 666 /var/run/docker.sock
newgrp docker
```

## Удалить контейнеры

```javascript
docker rm -vf $(docker ps -a -q)
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
