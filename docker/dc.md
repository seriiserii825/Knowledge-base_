https://www.8host.com/blog/ustanovka-i-ispolzovanie-docker-v-ubuntu-18-04/
serii366
serii1981

1) Run sudo add-apt-repository --remove "deb [arch=amd64] https://download.docker.com/linux/ubuntu sylvia stable"
2) Run apt update
3) Run sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu xenial stable"
4) Run apt update
5) Run apt install docker-ce

Use run to instal for the first time the container
after use docker containerName

ctop - utitlity for show containers

#add docker group
sudo usermod -aG docker serii
after logout and try 
docker run hello-world

#restart docker
sudo service docker restart

#install ubuntu
docker run -it ubuntu bash

#view containers
docker ps
docker ps -a (view all containers)

#start container by id
docker start id

#stop container by id
docker stop id

#create container with hostname
docker run -h ubuntu -it ubuntu bash

#view info about container
docker inspect id 

#create container with name
docker run --name containerName -it 

#view actions in container
docker diff containerName
docker logs containerName

#remove container
docker rm containerName

#remove all containers
docker stop $(docker ps -aq)
docker rm $(docker ps -aq)

#run docker in background
docker run -d

#run docker with ports
docker run -d -p pcport:hostport

#view images
docker images

#remove local images
before delete image, must to stop container and delete it
docker rmi imageName
docker rmi $(docker images -q)

#exec
docker exec -it pg bash

#attach
docker attach processname

#exit without destroy
ctrl+p, ctrl+q
