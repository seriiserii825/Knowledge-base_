serii1981;
### Установка mysql
sudo apt install mysql-server

### Настройка mysql
sudo mysql_secure_installation


### Удаление
Для этого нужно остановить сервис MySQL:

$ sudo service mysql stop

sudo apt-get purge mysql-server && sudo apt-get purge mysql-client && sudo apt-get purge mysql-common && sudo apt-get autoremove && sudo apt-get autoclean 

Удаление настроек (следующая команда удалит все): 
rm -rf /etc/mysql 


Находим все файлы “mysql” и удаляем их: 
find / -iname ‘mysql*’ -exec rm -rf {} \;

Stop MySQL Server (on Linux):

sudo systemctl stop mysql
Start the database without loading the grant tables or enabling networking:

sudo mysqld_safe --skip-grant-tables --skip-networking &
The ampersand at the end of this command will make this process run in the
background so you can continue to use your terminal and run #mysql -u root, it will not ask for password.

If you get error like as below:

2018-02-12T08:57:39.826071Z mysqld_safe Directory '/var/run/mysqld' for UNIX
socket file don't exists. mysql -u root ERROR 2002 (HY000): Can't connect to local MySQL server through socket
'/var/run/mysqld/mysqld.sock' (2) [1]+ Exit 1

Make MySQL service directory.

sudo mkdir /var/run/mysqld
Give MySQL user permission to write to the service directory.

sudo chown mysql: /var/run/mysqld
Run the same command in step 2 to run mysql in background.

Run mysql -u root you will get mysql console without entering password.

Run these commands

FLUSH PRIVILEGES;
For MySQL 5.7.6 and newer

ALTER USER 'root'@'localhost' IDENTIFIED BY 'new_password';
For MySQL 5.7.5 and older

SET PASSWORD FOR 'root'@'localhost' = PASSWORD('new_password');
If the ALTER USER command doesn't work use:

UPDATE mysql.user SET authentication_string = PASSWORD('new_password')     WHERE User = 'root' AND Host = 'localhost';
Now exit

To stop instance started manually

sudo kill `cat /var/run/mysqld/mysqld.pid`
Restart mysql

sudo systemctl start mysql

### password
Because of your password. You can see password validate configuration metrics using the following query in MySQL client:

SHOW VARIABLES LIKE 'validate_password%';
or you can set the password policy level lower, for example:

SET GLOBAL validate_password_length = 6;
SET GLOBAL validate_password_number_count = 0;

Репозиторий Ubuntu 18.04 по умолчанию содержит только последнюю версию MySQL. На момент написания статьи это 5.7.

Для того, чтобы установить эту версию, сначала обновите индекс пакетов:

$ sudo apt update
А затем выполните установку:

$ sudo apt install mysql-server
Выполнив эту команду, вы установите MySQL, однако запросов на установку пароля или других настроек не будет. Поэтому следующий шаг после установки - это настройка MySQL.

Шаг 2: настройка MySQL
Если вы установили одну из свежих версий MySQL, то вы можете просто запустить включенный в нее скрипт безопасности. Он позволит изменить некоторые базовые настройки (например, настройки для удаленного доступа). В более старых версиях вносить эти изменения приходилось вручную (в то время как сейчас они будут выполнены автоматически).

Запустите скрипт безопасности:

$ sudo mysql_secure_installation
После этого вы сможете внести некоторые изменения в настройки безопасности MySQL.

Первый запрос - хотите ли вы использовать Validate Password Plugin, который используется для тестирования вашего пароля (плагин проверяет надежность пароля с точки зрения взлома).

Следующий запрос - установка пароля для суперпользователя. Введите и подтвердите выбор пароля.

Далее можно просто нажимать Y и затем Enter для того, чтобы внести необходимые изменения. В результате будут удалены некоторые анонимные пользователи и тестовая база данных, будет отключена удаленная авторизация для суперпользователя и будут внесены некоторые другие изменения.

Для того, чтобы создать каталог данных MySQL, вам нужно использовать:

mysql_install_db  - для версий до 5.7.6;
mysqld --initialize - для версий 5.7.6 и более поздних.
Если вы следовали этой инструкции, то каталог данных был создан автоматически, и вам ничего делать не надо. И если вы введете команду, то увидите следующую ошибку:

mysqld: Can't create directory '/var/lib/mysql/' (Errcode: 17 - File exists)

. . .

2018-06-20T13:48:00.572066Z 0 [ERROR] Aborting
Обратите внимание, что несмотря на то, что вы установите пароль для суперпользователя MySQL, для этого пользователя не включена авторизация с паролем при подключении к MySQL. Это можно изменить, выполнив следующие действия.

Шаг 3: настройка аутентификации и привилегий
В ОС Ubuntu c MySQL 5.7 (и более поздними версиями) аутентификация суперпользователя MySQL по умолчанию настроена на использование плагина auth_socket, а не пароля. С точки зрения безопасности это хороший вариант, однако могут быть некоторые проблемы, особенно в тех случаях, когда вам нужно дать другой программе (например, phpMyAdmin) доступ к пользователю.

Если вы хотите использовать пароль для подключения к MySQL в качестве суперпользователя, вам нужно изменить метод аутентификации с auth_socket на mysql_native_password. Для этого откройте консоль MySQL:

$ sudo mysql
Далее проверьте, какой метод аутентификации используется для каждого из ваших пользовательских аккаунтов MySQL:

mysql> SELECT user,authentication_string,plugin,host FROM mysql.user;

Например, вывод может быть вот таким:

+------------------+-------------------------------------------+-----------------------+-----------+

| user          | authentication_string                  | plugin             | host   |

+------------------+-------------------------------------------+-----------------------+-----------+

| root          |                                        | auth_socket        | localhost |

| mysql.session | *THISISNOTAVALIDPASSWORDTHATCANBEUSEDHERE | mysql_native_password | localhost |

| mysql.sys     | *THISISNOTAVALIDPASSWORDTHATCANBEUSEDHERE | mysql_native_password | localhost |

| debian-sys-maint | *CC744277A401A7D25BE1CA89AFF17BF607F876FF | mysql_native_password | localhost |

+------------------+-------------------------------------------+-----------------------+-----------+

4 rows in set (0.00 sec)
В этом примере вы видите, что аутентификация суперпользователя происходит с использованием плагина auth_socket. Чтобы поменять настройку на использование пароля, выполните команду ниже. Обязательно выберите хороший и сложный пароль.

mysql> ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'password';
Теперь нужно, чтобы изменения вступили в силу. Введите команду:

mysql> FLUSH PRIVILEGES;
Еще раз запросите, какие аутентификационные методы используются:

mysql> SELECT user,authentication_string,plugin,host FROM mysql.user;
Вывод должен выглядеть теперь вот так:

+------------------+-------------------------------------------+-----------------------+-----------+

| user          | authentication_string                  | plugin             | host   |

+------------------+-------------------------------------------+-----------------------+-----------+

| root          | *3636DACC8616D997782ADD0839F92C1571D6D78F | mysql_native_password | localhost |

| mysql.session | *THISISNOTAVALIDPASSWORDTHATCANBEUSEDHERE | mysql_native_password | localhost |

| mysql.sys     | *THISISNOTAVALIDPASSWORDTHATCANBEUSEDHERE | mysql_native_password | localhost |

| debian-sys-maint | *CC744277A401A7D25BE1CA89AFF17BF607F876FF | mysql_native_password | localhost |

+------------------+-------------------------------------------+-----------------------+-----------+

4 rows in set (0.00 sec)
Теперь аутентификация суперпользователя будет происходит с использованием пароля. После этого можно выйти из консоли MySQL:

mysql> exit
Если вам нужен отдельный пользователь для работы с MySQL, то создать его можно следующим способом. Снова откройте консоль MySQL:

$ sudo mysql
Примечание: если вы выполнили действия выше, и теперь для аутентификации суперпользователя используется пароль, вам нужно использовать другую команду для доступа в консоль MySQL. Для того, чтобы авторизоваться с административными правами, введите:

$ mysql -u root -p
Теперь создайте нового пользователя и задайте надежный пароль:

mysql> CREATE USER 'sammy'@'localhost' IDENTIFIED BY 'password';
Теперь новому пользователю можно задать нужные вам права. Например, доступ ко всем таблицам в базе данных, а также возможность менять, добавлять и удалять права пользователей. Для этого введите следующую команду:

mysql> GRANT ALL PRIVILEGES ON *.* TO 'sammy'@'localhost' WITH GRANT OPTION;
В данном случае использовать команду FLUSH PRIVILEGES не нужно - она используется только в тех случаях, когда вы изменяете таблицы представлений с использованием INSERT, UPDATE или DELETE.

Поэтому просто выйдите из консоли MySQL:

mysql> exit
Теперь перейдем к тестированию MySQL.

Шаг 4: тестирование MySQL
Вне зависимости от того, как вы установили MySQL, СУБД должна запуститься автоматически.

Проверить статус можно следующей командой:

$ systemctl status mysql.service
Вывод должен быть примерно вот таким:

mysql.service - MySQL Community Server

   Loaded: loaded (/lib/systemd/system/mysql.service; enabled; vendor preset: en

   Active: active (running) since Wed 2018-06-20 21:21:25 UTC; 30min ago

Main PID: 3754 (mysqld)

Tasks: 28

   Memory: 142.3M

   CPU: 1.994s

   CGroup: /system.slice/mysql.service

           └─3754 /usr/sbin/mysqld
Если же MySQL по какой-то причине не работает, ее можно запустить командой:

$ sudo systemctl start mysql
Дополнительно можно выполнить проверку, используя mysqladmin, который позволяет использовать административные команды. Например, при помощи команды ниже можно подключиться к MySQL в качестве суперпользователя (-u root), запросить пароль (-p) и показать версию:

$ sudo mysqladmin -p -u root version
Вывод будет примерно вот таким:

mysqladmin  Ver 8.42 Distrib 5.7.21, for Linux on x86_64

Copyright (c) 2000, 2018, Oracle and/or its affiliates. All rights reserved.

Oracle is a registered trademark of Oracle Corporation and/or its

affiliates. Other names may be trademarks of their respective

owners.

Server version   5.7.21-1ubuntu1

Protocol version 10

Connection   Localhost via UNIX socket

UNIX socket  /var/run/mysqld/mysqld.sock

Uptime:      30 min 54 sec

Threads: 1  Questions: 12  Slow queries: 0  Opens: 115 Flush tables: 1  Open tables: 34 Queries per second avg: 0.006
