### Установка php7.2
sudo apt-get install software-properties-common python-software-properties
sudo add-apt-repository -y ppa:ondrej/php
sudo apt-get update

sudo apt-get install php7.2 php7.2-cli php7.2-common
sudo apt-get install php7.2-curl php7.2-gd php7.2-json php7.2-mbstring php7.2-intl php7.2-mysql php7.2-xml php7.2-zip
php -v


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
