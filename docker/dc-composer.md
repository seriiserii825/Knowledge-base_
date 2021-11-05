sudo curl -L "https://github.com/docker/compose/releases/download/1.27.4/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
docker-compose --version
#check version
docker -v 

#start compose
docker-compose up -d

#view tasks
docker-compose ps


#create db dir and Dokerfile inside

