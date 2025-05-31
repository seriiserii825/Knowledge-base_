# images

```bash
docker images - List all images
docker image rm image_name - Remove an image
```

## containers

```bash
docker run - creat new container
docker start container_id - start a container
```

## remove containers(can use a few symbols)

```bash
docker ps - List all running containers
docker rm container_id conainer_id - remove one or more containers
```

## environment variables

```bash
docker run -name DB mysql -e MYSQL_ROOT_PASSWORD=123456 -d mysql:latest
```

inside container view env

```bash
env - List all environment variables
```

## connect to container

```bash
docker exec -it container_id /bin/bash - Connect to a running container
docker attach container_id - Attach to a running container
docker exec -it DB_mysql /bin/bash - Connect to a running container named DB_mysql
docker exec -it DB_mysql /bin/bash mysql -uroot -p - Connect to a MySQL 
                            database inside container view environment variables
```
