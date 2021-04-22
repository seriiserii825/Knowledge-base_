#create image
docker run -it --name myapp --hostname myapp ubuntu bash

#update index in container
apt update

#install cowsay
apt install cowsay

#create a symbol link
ln -s /usr/games/cowsay /usr/bin/cowsay

#show what cow say
cowsay "Hello"

#create image
docker commit myapp serii366/cowsay

#run app
docker run serii366/cowsay cowsay "Hello world!"

#push app
docker login -u serii366
docker push serii366/cowsay


