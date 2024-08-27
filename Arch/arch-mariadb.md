#mysql 
serii1981mysql;

# install

```
sudo pacman -S mariadb
```

Once the installation is complete, you need to initialize the MariaDB data directory. Run the following command to do so:

```
sudo mariadb-install-db --user=mysql --basedir=/usr --datadir=/var/lib/mysql
```

# start mariadb

```
sudo systemctl start mysql.service
sudo systemctl status mysql.service
```


## Secure MariaDB Installation

Securing your MariaDB installation is crucial for the overall security of your system. Use the `mysql_secure_installation` script to improve the security of your MariaDB server:

```
sudo mysql_secure_installation
set password and answer no for other questions
```

This script will guide you through a series of prompts to set a root password, remove anonymous users, disallow remote root login, and remove the test database. Follow the on-screen instructions to complete the process.

## Start and Enable MariaDB Service

Now that MariaDB is installed and secured, it’s time to start the service. Run the following command to start MariaDB:

```
sudo systemctl start mariadb
```

To make sure MariaDB starts automatically at boot, enable the service using the following command:

```
sudo systemctl enable mariadb
```

## Create a Database and User

To create a new database and user, first log in to the MariaDB shell:

```
sudo mariadb -u root -p
```

Enter the root password you set during the secure installation process. Now, create a new database and user with the following commands:

```
CREATE DATABASE my_database;
CREATE USER 'my_user'@'localhost' IDENTIFIED BY 'my_password';
GRANT ALL PRIVILEGES ON my_database.* TO 'my_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

Replace `my_database`, `my_user`, and `my_password` with your desired database name, username, and password, respectively.

## Connect to MariaDB on Arch Linux

To connect to your newly created database as the new user, run the following command:

```
mariadb -u my_user -p my_database
```

Enter the password for `my_user` when prompted. You should now be connected to your MariaDB server and ready to execute SQL commands.

## Configure MariaDB for Remote Access

By default, MariaDB only allows connections from the local host. If you need to access MariaDB remotely, you must update the configuration file to allow connections from other hosts. Open the MariaDB configuration file with a text editor like Vim or Nano:

```
sudo vi /etc/mysql/my.cnf
```

Find the `[mysqld]` section and add the following line:

```
bind-address = 0.0.0.0
```

Save the file and exit the text editor. Restart MariaDB to apply the changes:

```
sudo systemctl restart mariadb
```

Now, you need to grant remote access to the user you created earlier. Log in to the MariaDB shell:

```
sudo mariadb -u root -p
```

Enter the root password and then run the following commands:

```
GRANT ALL PRIVILEGES ON my_database.* TO 'my_user'@'%' IDENTIFIED BY 'my_password';
FLUSH PRIVILEGES;
EXIT;
```

Replace `my_database`, `my_user`, and `my_password` with your database name, username, and password, respectively. The `%` symbol in `'my_user'@'%'` allows connections from any IP address. You can replace it with a specific IP or a range of IPs if you want to restrict access further.
Finally, configure your firewall to allow incoming connections to MariaDB. If you’re using `ufw`, run the following command:

```
sudo ufw allow 3306/tcp
```

For other firewalls, refer to their respective documentation to open the required port.
