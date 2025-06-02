# Volumes

## What are Docker Volumes?

### View Volumes

```bash
docker volume ls - List all volumes
```

### Remove Volumes

```bash
docker volume rm volume_name - Remove a specific volume
docker volume prune - Remove all unused volumes
```

### nginx

Run a new container named Web01 with nginx

```bash
docker run --name web1 -p 80:80 -d nginx
```

List all running containers

```bash
docker ps
```

### Get ip

```bash
ip a - Get the IP address of the container
insert in browser
```

output

```bash
wlp3s0: <BROADCAST,MULTICAST,UP,LOWER_UP> mtu 1500 qdisc noqueue state UP
group default qlen 1000
    link/ether 2c:9c:58:52:ad:ab brd ff:ff:ff:ff:ff:ff
    altname wlx2c9c5852adab
    inet 192.168.100.10
192.168.100.10 - IP address of the container
```

go inside container

```bash
docker exec -it web1 /bin/bash
cd /usr/share/nginx/html
```

change index.html with sed

```bash
sed -i "s/Welcome to nginx!/my web server!/" index.html
```

refresh browser, you should see "my web server!"

stop and remove, and create the same container

```bash
docker ps
docker stop web1
docker rm web1
docker run --name web1 -p 80:80 -d nginx
```

in browser will se "Welcome to nginx!" again

### Link volumes

```bash
docker run --name web1 -p 80:80 -v
/home/serii/Downloads/server:/usr/share/nginx/html -d nginx
docker ps
docker rm web1
docker run --name web1 -p 80:80 -v
/home/serii/Downloads/server:/usr/share/nginx/html -d nginx
```

content from `/home/serii/Downloads/server` will be used in container

### Host volums

```bash
docker run -v /host/path:/container/path image_name
docker run --name web01 -v /home/user/web:/var/www/html:ro -d nginx ro-readonly
```

### Anonymous volumes

```bash
docker run -v /container/path image_name
```

### Named volumes (in /var/lib/docker/volumes)

```bash
docker volume create volume_name
docker run -v volume_name:/container/path image_name
```
