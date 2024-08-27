## Install Docker Runtime[​](https://mpolinowski.github.io/docs/DevOps/Linux/2021-10-24--arch-linux-install-docker/2021-10-24/#install-docker-runtime "Direct link to Install Docker Runtime")

```
sudo pacman -Syusudo pacman -S dockersudo systemctl start docker.service
```

**ERROR**:

```
systemctl status docker.service                                                                                           1 ✘ × docker.service - Docker Application Container Engine     Loaded: loaded (/usr/lib/systemd/system/docker.service; disabled; vendor preset: disabled)     Active: failed (Result: exit-code) since Wed 2021-11-24 12:14:58 HKT; 9s agoTriggeredBy: × docker.socket       Docs: https://docs.docker.com    Process: 10573 ExecStart=/usr/bin/dockerd -H fd:// (code=exited, status=1/FAILURE)   Main PID: 10573 (code=exited, status=1/FAILURE)        CPU: 259msNov 24 12:14:58 TP-Link0815b systemd[1]: docker.service: Scheduled restart job, restart counter is at 3.Nov 24 12:14:58 TP-Link0815b systemd[1]: Stopped Docker Application Container Engine.Nov 24 12:14:58 TP-Link0815b systemd[1]: docker.service: Start request repeated too quickly.Nov 24 12:14:58 TP-Link0815b systemd[1]: docker.service: Failed with result 'exit-code'.Nov 24 12:14:58 TP-Link0815b systemd[1]: Failed to start Docker Application Container Engine.
```

Enable the service and reboot your system:

```
sudo systemctl enable docker.servicereboot
```

Test again - it works!

```
sudo docker versionClient: Version:           20.10.10 API version:       1.41 Go version:        go1.17.2 Git commit:        b485636f4b Built:             Tue Oct 26 03:44:01 2021 OS/Arch:           linux/amd64 Context:           default Experimental:      trueServer: Engine:  Version:          20.10.10  API version:      1.41 (minimum version 1.12)  Go version:       go1.17.2  Git commit:       e2f740de44  Built:            Tue Oct 26 03:43:48 2021  OS/Arch:          linux/amd64  Experimental:     false containerd:  Version:          v1.5.7  GitCommit:        8686ededfc90076914c5238eb96c883ea093a8ba.m runc:  Version:          1.0.2  GitCommit:        v1.0.2-0-g52b36a2d docker-init:  Version:          0.19.0  GitCommit:        de40ad0
```

## Run Docker without root[​](https://mpolinowski.github.io/docs/DevOps/Linux/2021-10-24--arch-linux-install-docker/2021-10-24/#run-docker-without-root "Direct link to Run Docker without root")

Add your account to the docker group with this command - reboot your system - or logout from your account - for those changes to take effect.:

```
sudo usermod -aG docker $USER
```

## Install Docker Compose[​](https://mpolinowski.github.io/docs/DevOps/Linux/2021-10-24--arch-linux-install-docker/2021-10-24/#install-docker-compose "Direct link to Install Docker Compose")

1. Run this command to download the current stable release of Docker Compose:

```
sudo curl -L "https://github.com/docker/compose/releases/download/1.29.2/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
```

2. Apply executable permissions to the binary:

```
sudo chmod +x /usr/local/bin/docker-compose
```

3. Test the installation:

```
docker-compose --versiondocker-compose version 1.29.2, build 5becea4c
```
