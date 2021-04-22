check your **.env

MYSQL_VERSION=latest
then type this command

$ docker-compose exec mysql bash
$ mysql -u root -p 
(login as root)

ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'root';
ALTER USER 'root'@'%' IDENTIFIED WITH mysql_native_password BY 'root';
ALTER USER 'default'@'%' IDENTIFIED WITH mysql_native_password BY 'secret';
then go to phpmyadmin and login as :

host -> mysql
user -> root
password -> root
hope it help
