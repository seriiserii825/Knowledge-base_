serii1981;
### Установка mysql
sudo apt install mysql-server

### Настройка mysql
sudo mysql_secure_installation

Set password

Add password for the root to work with workbench
sudo mysql -u root
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'Serii1981;';


#reset password
Locate the MySQL configuration file using: $ mysql --help | grep -A 1 "Default options"

Edit the configuration file using: $ sudo nano /etc/mysql/mysql.conf.d/mysqld.cnf

Add skip-grant-tables under [mysqld] block and save the changes.

Restart MySQL service using: sudo service mysql restart

Check MySQL service status: sudo service mysql status

Login to mysql with: $ mysql -u root

And change the root password:
mysql> FLUSH PRIVILEGES;
mysql> ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'MyNewPass';

Revert back the MySQL configuration file changes by removing skip-grant-tables line or commenting it with a # (hash).
Finally restart the MySQL service and you are good to go.
