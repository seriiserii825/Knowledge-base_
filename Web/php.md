sudo apt -y install software-properties-common
sudo add-apt-repository ppa:ondrej/php
Update
sudo apt install -y php7.4-cli php7.4-json php7.4-common php7.4-mysql php7.4-zip php7.4-gd php7.4-mbstring php7.4-curl php7.4-xml php7.4-bcmath
php7.1-cli php7.1-json php7.1-common php7.1-mysql php7.1-zip php7.1-gd php7.1-mbstring php7.1-curl php7.1-xml php7.1-bcmath

#purge apache
sudo apt-get purge apache2 apache2-utils apache2-bin apache2.2-common
sudo apt-get purge 'php*'

#upload file size
/etc/php/version apache fpm cli change php.in

set post_max_size = 100M
upload_max_filesize = 100M

## after restart apache and php-fpm
sudo service apache2 restart 
sudo serivce php8-fpm restart 
