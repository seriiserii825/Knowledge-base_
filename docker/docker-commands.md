#docker with bash
docker run -it ubuntu bash

#docker name
docker run -h some
docker run --name Ubuntu

#logs
docker logs Ubuntu

#list images
docker images

#list containers
docker ps

When exit container, docker is not destroyed

#remove container
docker -rm Ubuntu

#remove all containers
docker container stop $(docker container ls -aq)
docker container prune -f

#remove all images
docker rmi $(docker images -q) --force
