#install mariadb
docker run --name mysqlmaria -e MYSQL_ROOT_PASSWORD=serii1981 -d mariadb

#install adminer
docker run --link mysqlmaria:db -p 8080:8080 adminer


