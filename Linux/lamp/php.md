#remove
sudo apt-get purge 'php*'
sudo apt-get purge php7.*
sudo apt-get autoclean
sudo apt-get autoremove

#display errors
error_reporting(E_ALL);
ini_set('display_errors', '1');

### 
switch from php version
sudo update-alternatives --config php

## php 8
sudo apt install php
sudo apt install php8.0 php8.0-{bz2,cgi,common,cli,curl,intl,dev,fpm,gd,imagick,mbstring,mysql,opcache,readline,xml,zip}    
sudo update-alternatives --set php /usr/bin/php8.0
sudo service php8.0-fpm start
sudo systemctl status php8.0-fpm

### Установка php7.2
sudo apt-get install software-properties-common python-software-properties
sudo add-apt-repository -y ppa:ondrej/php
sudo apt-get update

sudo apt -y install php7.2 php7.2-fpm php7.2-mysql php7.2-mbstring php7.2-xml php7.2-gd php7.2-curl php-common php7.2-cli php7.2-common php7.2-json php7.2-opcache php7.2-readline
php -v


sudo systemctl enable php7.2-fpm (after restart system)
sudo service php7.2-fpm start

# php 7.4
sudo apt install php7.4 -y
sudo apt install php7.4-fpm php7.4-cli php7.4-mysql php7.4-curl php7.4-json -y
sudo systemctl start php7.4-fpm
sudo systemctl enable php7.4-fpm

### php.ini
sudo vim /etc/php7/apache/php.ini

display_errors=on

error_reporting = E_ALL  & ~E_DEPRECATED

ignore_repeated_errors = On

max_execution_time = 30

max_input_time=60

max_input_vars = 1000

memory_limit = 128M

post_max_size = 8M

upload_max_filesize = 2M

max_file_uploads = 20

extension=php_mysql.so
extension=php_mbstring.so
extension=php_pgsql.so
