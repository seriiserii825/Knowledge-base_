## Install Docker Runtime[​](https://mpolinowski.github.io/docs/DevOps/Linux/2021-10-24--arch-linux-install-docker/2021-10-24/#install-docker-runtime "Direct link to Install Docker Runtime")

```
sudo pacman -S docker && sudo systemctl start docker.service
systemctl status docker.service                                                                                           1 ✘ × docker.service - Docker Application Container Engine     Loaded: loaded (/usr/lib/systemd/system/docker.service; disabled; vendor preset: disabled)     Active: failed (Result: exit-code) since Wed 2021-11-24 12:14:58 HKT; 9s agoTriggeredBy: × docker.socket       Docs: https://docs.docker.com    Process: 10573 ExecStart=/usr/bin/dockerd -H fd:// (code=exited, status=1/FAILURE)   Main PID: 10573 (code=exited, status=1/FAILURE)        CPU: 259msNov 24 12:14:58 TP-Link0815b systemd[1]: docker.service: Scheduled restart job, restart counter is at 3.Nov 24 12:14:58 TP-Link0815b systemd[1]: Stopped Docker Application Container Engine.Nov 24 12:14:58 TP-Link0815b systemd[1]: docker.service: Start request repeated too quickly.Nov 24 12:14:58 TP-Link0815b systemd[1]: docker.service: Failed with result 'exit-code'.Nov 24 12:14:58 TP-Link0815b systemd[1]: Failed to start Docker Application Container Engine.
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
