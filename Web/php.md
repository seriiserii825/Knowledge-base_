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

#php 7.4
sudo apt install php7.4 php7.4-fpm php7.4-mysql libapache2-mod-php7.4 -y
sudo systemctl start php7.4-fpm
sudo systemctl status php7.4-fpm
sudo a2enmod actions fcgid alias proxy_fcgi
sudo systemctl restart apache2

<VirtualHost *:80>
     ServerAdmin admin@site2.your_domain
     ServerName site2.your_domain
     DocumentRoot /var/www/site2.your_domain
     DirectoryIndex info.php  

     <Directory /var/www/site2.your_domain>
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Order allow,deny
        allow from all
     </Directory>

    <FilesMatch \.php$>
      # For Apache version 2.4.10 and above, use SetHandler to run PHP as a fastCGI process server
      SetHandler "proxy:unix:/run/php/php7.4-fpm.sock|fcgi://localhost"
    </FilesMatch>

     ErrorLog ${APACHE_LOG_DIR}/site2.your_domain_error.log
     CustomLog ${APACHE_LOG_DIR}/site2.your_domain_access.log combined
</VirtualHost>

#check apahce errors
sudo apachectl configtest
sudo systemctl restart apache2

#switch to another php version
sudo update-alternatives --config php

