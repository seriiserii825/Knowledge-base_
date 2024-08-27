### Установка apache
sudo apt install apache2


### НАСТРОЙКА APACHE
После установки добавим программу в автозагрузку:

sudo systemctl enable apache2

#И запустим веб-сервер сейчас:

sudo systemctl start apache2

#Теперь можно проверить, что получилось, откройте браузер и наберите в адресной строке localhost:

#Как видите, установка apache ubuntu 16.04 завершена, и веб-сервер уже работает. Но это ещё не всё.
Если у вас один сайт, который нужно тестить на локальной машине, то всё отлично.
Но если их несколько, то собирать их все в подпапках веб-сервера не совсем удобно, да и не все движки нормально относятся к этому.
Потому давайте рассмотрим, как настроить виртуальные хосты.

Создайте новую папку для нашего виртуального хоста:

 sudo mkdir /var/www/test.site

Дадим права на доступ:

 sudo chmod -R 755 /var/www

Необходимо создать небольшой файл, index.html, чтобы он открылся, когда вы запустите этот сайт:

 sudo vi /var/www/test.site/public_html/index.html

<html>
<head>
<title>Welcome to Test!</title>
</head>
<body>
<h1>Success! Virtual host is working!</h1>
</body>
</html>

Теперь можно добавлять виртуальный хост, для этого создайте файл и наполните его содержимым:

 sudo vi /etc/apache2/sites-available/test.site.conf

<VirtualHost *:80>
ServerName test.site
ServerAlias www.test.site
ServerAdmin webmaster@localhost
DocumentRoot /var/www/test.site/public_html
ErrorLog ${APACHE_LOG_DIR}/error.log
CustomLog ${APACHE_LOG_DIR}/access.log combined


</VirtualHost>

Вот что значат некоторые строки:

ServerName - имя нашего сайта, виртуального хоста
ServerAlias - сайт будет доступен также по этому имени
DocumentRoot - корневой каталог с файлами сайта
Теперь сохраните файл, далее нужно активировать наш хост:

 sudo a2ensite test.site.conf

Перезапускаем веб-сервер:

 sudo systemctl restart apache2

