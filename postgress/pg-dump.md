### dump

### install tool

```bash
sudo pacman -S postgresql-libs
```

#### Local machine

```bash
pg_dump -U myuser -d mydb -F c -f mydb.backup
```

from docker

```bash
docker exec -it postgres_container_name bash
pg_dump -U ${DB_USERNAME} -d ${DB_NAME} -F c -f /tmp/dump.backup
exit

docker cp postgres_container_name:/tmp/dump.backup ./mydb.backup
```

#### Transfer

```bash
scp mydb.backup user@192.168.1.100:/tmp/
```

#### On server (SSH into it first)

```bash
ssh user@192.168.1.100
```

#### Create database if needed

```bash
createdb -U myuser mydb
```

#### Restore

```bash
pg_restore -U myuser -d mydb /tmp/mydb.backup
```
