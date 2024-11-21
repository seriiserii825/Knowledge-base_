sudo pacman -Syu
sudo pacman -S mysql
mysqld --version

## Initialize the MySQL data directory before starting the server:  

sudo mysql_install_db --user=mysql --basedir=/usr --datadir=/var/lib/mysql
sudo mysqld --initialize --user=mysql --basedir=/usr --datadir=/var/lib/mysql
sudo systemctl start mysqld
sudo systemctl status mysqld

## Enable MySQL to start on system boot:  

```
sudo systemctl enable mysqld
and change root password to 'root'
```

## Run the MySQL security installation script to configure security settings:  

```
sudo systemctl start mysqld
sudo mysql_secure_installation
```

### enter current password for root (press enter)

```
sudo mysql -u root -p
```

```
CREATE USER 'serii'@'localhost' IDENTIFIED BY 'serii1981';
GRANT ALL PRIVILEGES ON *.* TO 'serii'@'localhost' WITH GRANT OPTION;
FLUSH PRIVILEGES;
exit;

Log in to MySQL with the newly created user:  

```
mysql -u serii -p
```

Create a new database for your application:  

```
CREATE DATABASE laravel;
```
List all available databases to verify the successful creation:  

```
SHOW DATABASES;
```

Congratulations! You have now successfully installed and configured MySQL on your Arch Linux system. You're ready to leverage the power of MySQL for your applications and projects.
