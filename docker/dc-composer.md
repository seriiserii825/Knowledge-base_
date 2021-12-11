sudo curl -L "https://github.com/docker/compose/releases/download/1.27.4/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
docker-compose --version
#check version
docker -v 

#check ip_address
docker-machine ip default

#start compose
docker-compose up -d(d - in background)

#view tasks
docker-compose ps

#connect to mysql
docker-compose up -d

#use build when changed config
docker-compose up --build -d

#use port and host
mysql -uroot -p --port 33061 --host 127.0.0.1

#down
docker-compose down

#volumes(create dir docker in storage before)
  volumes:
    - ./storage/docker/mysql:/var/lib/mysql

