## Install Docker Runtime[​](https://mpolinowski.github.io/docs/DevOps/Linux/2021-10-24--arch-linux-install-docker/2021-10-24/#install-docker-runtime "Direct link to Install Docker Runtime")

```
sudo pacman -S docker 
reboot
sudo systemctl start docker.service
systemctl status docker.service
sudo docker version
sudo usermod -aG docker $USER
```

## 1. Run this command to download the current stable release of Docker Compose:

```
sudo curl -L "https://github.com/docker/compose/releases/download/1.29.2/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
```

2. Apply executable permissions to the binary:

```
sudo chmod +x /usr/local/bin/docker-compose
```

3. Test the installation:

```
docker-compose --version
```
