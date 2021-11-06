Устанавливаем xdebug
sudo apt-get install php-xdebug

Настройка xdebug.ini конфигурационного файла
Отредактируйте файл любым текстовым редактором (В примере используется nano)
sudo nano /etc/php/7.2/fpm/conf.d/20-xdebug.ini

И отредактируйте файл следующим образом:
zend_extension=/usr/lib/php/20151012/xdebug.so
xdebug.remote_autostart = 1
xdebug.remote_enable = 1
xdebug.remote_handler = dbgp
xdebug.remote_host = 127.0.0.1
xdebug.remote_log = /tmp/xdebug_remote.log
xdebug.remote_mode = req
xdebug.remote_port = 9005 #if you want to change the port you can change 

Выполните перезагрузку php-fpm:
sudo service php7.2-fpm restart
