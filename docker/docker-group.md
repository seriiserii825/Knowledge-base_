#If you want to run docker as non-root user then you need to add it to the docker group.

#Create the docker group if it does not exist
sudo groupadd docker

#Add your user to the docker group.
sudo usermod -aG docker $USER

#Run the following command or Logout and login again and run (that doesn't work you may need to reboot your machine first)
newgrp docker

#Check if docker can be run without root
docker run hello-world

#Reboot if still got error
reboot

#denied errors
sudo chgrp docker /lib/systemd/system/docker.socket
sudo chmod g+w /lib/systemd/system/docker.socket
