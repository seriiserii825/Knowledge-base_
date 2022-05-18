#install
sudo apt install apt-transport-https ca-certificates curl software-properties-common
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu focal stable"
sudo apt update
apt-cache policy docker-ce
sudo apt install docker-ce
sudo systemctl status docker

#docker without sudo
sudo usermod -aG docker ${USER}
su - ${USER}
id -nG
sudo usermod -aG docker serii

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
