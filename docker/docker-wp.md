## create site
mkdir wpsite
cd wpsite

## docker-compose.yml
version: '3'

services:

  mysql:
    image: mysql:5
    container_name: mysql
    environment:
      - MYSQL_DATABASE=wpdb
      - MYSQL_USER=wpuser
      - MYSQL_PASSWORD=wpsecret
      - MYSQL_ROOT_PASSWORD=mysecret
    volumes:
      - wpdata:/var/lib/mysql
    ports:
      - "3306:3306"
    networks:
      - wpnet
    restart: on-failure

  wordpress:
    image: wordpress
    container_name: wordpress
    depends_on:
      - mysql
    environment:
      - WORDPRESS_DB_HOST=mysql
      - WORDPRESS_DB_NAME=wpdb
      - WORDPRESS_DB_USER=wpuser
      - WORDPRESS_DB_PASSWORD=wpsecret
    volumes:
      - wpfiles:/var/www/html
      - ./wp-content:/var/www/html/wp-content
    ports:
      - "8001:80"
    networks:
      - wpnet
    restart: on-failure

volumes:
  wpdata:
  wpfiles:

networks:
  wpnet:

## add rights
sudo chmod 777 -R wp-content

## backup db
docker exec <ID> /usr/bin/mysqldump -u root -pmysecret mydb > backup.sql


