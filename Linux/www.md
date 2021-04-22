Для начала создай группу:
sudo groupadd groupname
Затем добавь себя в эту группу:
sudo gpasswd -a username groupname
После чего дай созданной группе права на запись в каталог:
sudo chown -R root:groupname /var/www
sudo chmod 775 /var/www
