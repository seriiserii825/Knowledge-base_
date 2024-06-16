serii1981;
### Установка mysql
sudo apt install mysql-server

### Зададим пароль
sudo mysql
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'Serii1981;';

### Настройка mysql
sudo mysql_secure_installation

### To enter in terminal, need to type
sudo mysql -u root -p

###The correct way is to login to my-sql with sudo privilege.

sudo mysql -u root -p
And then updating the password using:

ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'new-password';
Once this is done stop and start the MySQL server.

sudo service mysql stop
sudo service mysql start
