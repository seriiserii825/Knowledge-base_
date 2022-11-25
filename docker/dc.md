#install
sudo apt install apt-transport-https ca-certificates curl software-properties-common
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu focal stable"
sudo apt update
sudo apt-cache policy docker-ce
sudo apt install docker-ce
sudo systemctl status docker

#docker without sudo
sudo usermod -aG docker ${USER}
su - ${USER}
id -nG
sudo usermod -aG docker username

#error
sudo chmod 666 /var/run/docker.sock
sudo usermod -aG docker serii
sudo chmod 666 /var/run/docker.sock
newgrp docker

#prune system
docker system prune

#remove containers
docker rm -vf $(docker ps -a -q)

#remove images
docker rmi -f $(docker images -a -q)

## There are two possible docker packages to install: docker.io from Debian/Ubuntu and docker-ce from docker.com. This post discusses the differences. I had both installed

dpkg -l | grep -i docker
Looks for me it was choking on containerd which would not start. You can check messages in /var/log/syslog

Tried many things which did not work

$ sudo dpkg --configure -a
$ sudo systemctl list-jobs
$ sudo systemctl disable docker.service
$ sudo systemctl disable containerd.service
$ sudo systemctl stop containerd.service
...
Removing folders, uninstalling all docker packages and reinstalling docker.io worked

$ sudo rm -rf /var/lib/containerd/
$ sudo rm -rf /var/lib/docker/
$ sudo apt-get purge -y docker-ce docker-ce-cli docker.io containerd.io
$ sudo apt-get install docker.io

# rebuild container
docker-compose stop nginx # stop if running
docker-compose rm -f nginx # remove without confirmation
docker-compose build nginx # build
docker-compose up -d nginx # create and start in background
