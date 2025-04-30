## See all the existing images:

```
docker images -a
```

## See all the existing containers:

```
docker ps -a
```

## Delete single image:

```
docker images -a
docker rmi <IMAGE_ID>
```

## Delete single container:

```
docker ps -a
docker rm <CONTAINER_ID>
```

## Delete multiple images:

```
docker images -a
docker rmi <IMAGE_ID1> <IMAGE_ID2>
```

## Delete multiple containers:

```
docker ps -a
docker rm <CONTAINER_ID1> <CONTAINER_ID2>
```

## Stop all containers and remove them:

```
docker rm $(docker kill $(docker ps -aq))
```

## Delete all images:

```
docker rmi -f $(docker images -a -q)
```

## stop all running containers:

```
docker stop $(docker ps -aq)
```

## Delete both all stopped containers and images in a single command:

```
docker rm $(docker ps -a -q) && docker rmi -f $(docker images -a -q)
```

## To prune all containers:

```
docker container prune
```

## Delete all unused data (i.e., in order: containers stopped, volumes without containers and images with no containers):

```
docker system prune
```
