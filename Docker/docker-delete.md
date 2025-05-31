# See all the existing images

```bash
docker images -a
```

## See all the existing containers

```bash
docker ps -a
```

## Delete single image

```bash
docker images -a
docker rmi <IMAGE_ID>
```

## Delete single container

```bash
docker ps -a
docker rm <CONTAINER_ID>
```

## Delete multiple images

```bash
docker images -a
docker rmi <IMAGE_ID1> <IMAGE_ID2>
```

## Delete multiple containers

```bash
docker ps -a
docker rm <CONTAINER_ID1> <CONTAINER_ID2>
```

## Stop all containers and remove them

```bash

docker rm $(docker kill $(docker ps -aq))
```

## Delete all images

```bash
docker rmi -f $(docker images -a -q)
```

## stop all running containers

````bash
docker stop $(docker ps -aq)
    ```

## Delete both all stopped containers and images in a single command

```bash
docker rm $(docker ps -a -q) && docker rmi -f $(docker images -a -q)
````

## To prune all containers

```bash
    docker container prune
```

## Delete all unused data

(i.e., in order containers stopped
volumes without containers and images with no containers)

```bash
docker system prune
```
