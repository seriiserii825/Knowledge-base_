#Включение репозитория PHP
Ондржей Сури, разработчик Debian, поддерживает репозиторий, включающий несколько версий PHP. Чтобы включить репозиторий , запустите:

sudo apt install software-properties-common
sudo add-apt-repository ppa:ondrej/php


#Установка PHP 8.0 с Apache
## Если вы используете Apache в качестве веб-сервера, вы можете запускать PHP как модуль Apache или PHP-FPM.

sudo apt update
sudo apt install php8.0 libapache2-mod-php8.0 php-zip php8.0-curl php8.0-mysql

#После установки пакетов перезапустите Apache, чтобы модуль PHP загрузился:

sudo systemctl restart apache2

# Настройте Apache с помощью PHP-FPM
# Php-FPM — это менеджер процессов FastCGI для PHP. Выполните следующую команду, чтобы установить необходимые пакеты:

sudo apt update
sudo apt install php8.0-fpm libapache2-mod-fcgid php8.0-mysql

#По умолчанию PHP-FPM не включен в Apache. Чтобы включить его, запустите:

sudo a2enmod proxy_fcgi setenvif
sudo a2enconf php8.0-fpm

#Чтобы активировать изменения, перезапустите Apache:

systemctl restart apache2

# Php without server
sudo apt install php8.0-common
sudo apt install php8.0-{curl,intl,mysql,readline,xml,mbstring}
sudo apt install php8.0-cli
