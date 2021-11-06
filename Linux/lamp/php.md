error_reporting(E_ALL);
ini_set('display_errors', '1');

### 
switch from php version
sudo update-alternatives --config php

### Установка php7.2
sudo apt-get install software-properties-common python-software-properties
sudo add-apt-repository -y ppa:ondrej/php
sudo apt-get update

sudo apt -y install php7.2 php7.2-fpm php7.2-mysql php7.2-mbstring php7.2-xml php7.2-gd php7.2-curl php-common php7.2-cli php7.2-common php7.2-json php7.2-opcache php7.2-readline
php -v


sudo systemctl enable php7.2-fpm (after restart system)
sudo service php7.2-fpm start


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
