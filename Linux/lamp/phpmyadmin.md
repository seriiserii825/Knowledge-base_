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

cd /usr/share/phpmyadmin/libraries/
 sudo vim sql.lib.php 
613 line
|| (count($analyzed_sql_results['select_expr']) == 1
https://www.digitalocean.com/community/tutorials/how-to-install-and-secure-phpmyadmin-on-ubuntu-20-04
