### Updated `docker-compose.yml` with MariaDB

```
  mysql:
    container_name: mariadb_traversy
    image: mariadb:11.0.3  # Replace with the desired MariaDB version
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD: root       # Root password
      MYSQL_DATABASE: traversy        # Database name
    volumes:
      - "./docker/mysql:/var/lib/mysql"
      - "./docker/mysql/my.cnf:/etc/mysql/conf.d/my.cnf"
    ports:
      - "33062:3306"
    command: --default-authentication-plugin=mysql_native_password
```

---

### Key Changes

1. **Image Update**: Replaced `mysql:8.3.0` with `mariadb:11.0.3` (latest stable MariaDB version as of now).
2. **Container Name**: Changed `mysql_traversy` to `mariadb_traversy` to avoid conflicts with MySQL containers.
3. **Environment Variables**: MariaDB uses the same `MYSQL_*` environment variables for initialization as MySQL.
4. **Volumes**: Ensure the data directory is compatible or remove and recreate it for MariaDB.

---

### Steps to Switch

1. **Stop and Remove the Existing MySQL Container**:
   `docker-compose down`
   (This stops and removes the existing MySQL container.)
2. **Remove MySQL Data (if incompatible)**: If the data directory was created by MySQL 8.3.0, it might not work with MariaDB. You can clear the volume:
   `rm -rf ./docker/mysql`
3. **Start the MariaDB Service**: Bring up the updated configuration:
   `docker-compose up -d`
4. **Verify MariaDB Is Running**: Check logs to confirm MariaDB is running:
   `docker logs mariadb_traversy`

---

### Testing

Connect to the MariaDB container:
`docker exec -it mariadb_traversy mariadb -u root -p`
Provide the root password (`root` in this example) to log in.
