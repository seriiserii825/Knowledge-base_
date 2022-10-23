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
