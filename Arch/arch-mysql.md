**Step 1: Update System**  
Before proceeding with the installation, ensure your system is up-to-date. Open a terminal and execute the following command:  

```
sudo pacman -Syu
```

Enter fullscreen mode Exit fullscreen mode

**Step 2: Install MySQL**  
Install MySQL from the official repository using the pacman package manager:  

```
sudo pacman -S mysql
```

Enter fullscreen mode Exit fullscreen mode

**Step 3: Verify Installation**  
Confirm the installation by checking the MySQL version:  

```
mysqld --version
```

Enter fullscreen mode Exit fullscreen mode

**Step 4: Initialize MySQL**  
Initialize the MySQL data directory before starting the server:  

```
sudo mysql_install_db --user=mysql --basedir=/usr --datadir=/var/lib/mysql
```

Enter fullscreen mode Exit fullscreen mode

**Step 5: Start MySQL**  
Initiate the MySQL server using systemctl:  

```
sudo systemctl start mysqld
sudo systemctl status mysqld
```

Enter fullscreen mode Exit fullscreen mode

**Step 6: Enable MySQL**  
Enable MySQL to start on system boot:  

```
sudo systemctl enable mysqld
```

Enter fullscreen mode Exit fullscreen mode

**Configuring MySQL**

**Step 1: Secure Installation**  
Run the MySQL security installation script to configure security settings:  

```
sudo mysql_secure_installation
```

Enter fullscreen mode Exit fullscreen mode

**Step 2: Log into MySQL**  
Access the MySQL command-line interface as the root user:  

```
sudo mysql
```

Enter fullscreen mode Exit fullscreen mode

**Step 3: Create User**  
Create a new MySQL user with the desired username and password:  

```
CREATE USER 'serii'@'localhost' IDENTIFIED BY 'serii1981';
```

Enter fullscreen mode Exit fullscreen mode

**Step 4: Grant Privileges**  
Grant all privileges to the newly created user:  

```
GRANT ALL PRIVILEGES ON *.* TO '<username>'@'localhost' WITH GRANT OPTION;
```

Enter fullscreen mode Exit fullscreen mode

**Step 5: Flush Privileges**  
Flush privileges to apply the changes and exit MySQL:  

```
FLUSH PRIVILEGES;
exit
```

Enter fullscreen mode Exit fullscreen mode

**Step 6: Log in with New User**  
Log in to MySQL with the newly created user:  

```
mysql -u <username> -p
```

Enter fullscreen mode Exit fullscreen mode

**Step 7: Create Database**  
Create a new database for your application:  

```
CREATE DATABASE <dbname>;
```

Enter fullscreen mode Exit fullscreen mode

**Step 8: Verify Databases**  
List all available databases to verify the successful creation:  

```
SHOW DATABASES;
```

Enter fullscreen mode Exit fullscreen mode

Congratulations! You have now successfully installed and configured MySQL on your Arch Linux system. You're ready to leverage the power of MySQL for your applications and projects.
