Устанавливаем xdebug
sudo apt-get install php-xdebug

Настройка xdebug.ini конфигурационного файла
Отредактируйте файл любым текстовым редактором (В примере используется nano)
sudo nano /etc/php/7.2/fpm/conf.d/20-xdebug.ini

И отредактируйте файл следующим образом:
[xdebug]
zend_extension=xdebug.so
xdebug.remote_autostart=1
xdebug.default_enable=1
xdebug.remote_port=9001
xdebug.remote_host=127.0.0.1
xdebug.remote_connect_back=1
xdebug.remote_enable=1
xdebug.idekey=PHPSTORM

Выполните перезагрузку php-fpm:
sudo service php7.2-fpm restart
