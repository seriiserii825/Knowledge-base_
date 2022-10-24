#install
sudo apt install phpmyadmin php-mbstring php-zip php-gd php-json php-curl
Do not use nothing, because we use nginx, not apache
Add password

#Need to press abort
mysql -u root -p
mysql>UNINSTALL COMPONENT "file://component_validate_password";
mysql>exit;
sudo apt install phpmyadmin
After installed 
mysql -u root -p
mysql>INSTALL COMPONENT "file://component_validate_password";

sudo phpenmod mbstring

sudo systemctl restart apache2

#php 8
sudo apt install ca-certificates apt-transport-https lsb-release gnupg curl nano unzip -y
sudo apt install php8.0 php8.0-cli php8.0-common php8.0-curl php8.0-gd php8.0-intl php8.0-mbstring php8.0-mysql php8.0-opcache php8.0-readline php8.0-xml php8.0-xsl php8.0-zip php8.0-bz2 libapache2-mod-php8.0 -y

# Go to the directory where phpMyAdmin will be installed using the command cd /usr/share.
## To download phpMyAdmin, execute the command 
sudo wget https://www.phpmyadmin.net/downloads/phpMyAdmin-latest-all-languages.zip -O phpmyadmin.zip.
sudo unzip phpmyadmin.zip
sudo rm phpmyadmin.zip
sudo mv phpMyAdmin-*-all-languages phpmyadmin
sudo chmod -R 0755 phpmyadmin
sudo vim /etc/apache2/conf-available/phpmyadmin.conf
===============
Alias /phpmyadmin /usr/share/phpmyadmin

<Directory /usr/share/phpmyadmin>
    Options SymLinksIfOwnerMatch
    DirectoryIndex index.php
</Directory>

# Disallow web access to directories that don't need it
<Directory /usr/share/phpmyadmin/templates>
    Require all denied
</Directory>
<Directory /usr/share/phpmyadmin/libraries>
    Require all denied
</Directory>
<Directory /usr/share/phpmyadmin/setup/lib>
    Require all denied
</Directory>
====================

sudo a2enconf phpmyadmin
sudo systemctl reload apache2

sudo mkdir /usr/share/phpmyadmin/tmp/
sudo chown -R www-data:www-data /usr/share/phpmyadmin/tmp/

