### download
```
zip -r folder.zip folder

download file
scp -r  webmaster@37.187.90.56:/home/webmaster/web/silcompaback.altuofianco.com/public_html.zip .

download folder
scp -r  webmaster@37.187.90.56:/home/webmaster/web/silcompaback.altuofianco.com/public_html .
```

# User
sudo useradd -m -d /home/serii -s /bin/bash serii
passwd username

## Теперь для того, чтобы предоставить пользователю sudo-привилегии, его нужно добавить в группу sudo. Это делается командой: 
usermod -aG sudo username

## Копировать содержимое публичного ключа в .ssh/authorized_keys
 
# Установим username владельцем этого каталога (также будет создана группа с тем же именем):
sudo chown -R serii:serii /home/serii/.ssh
sudo chmod 700 /home/serii/.ssh
sudo chmod 600 /home/serii/.ssh/authorized_keys

# Теперь можно залогиниться на сервер под новым пользователем без использования пароля:

ssh serii@your_server_ip

#Если нужно запустить команду с правами администратора, введите sudo перед ней, например:

sudo команда

#Этот шаг не является обязательным, но для повышения безопасности можно отключить дистанционный доступ для суперпользователя root.
## В этом случае пользователям всегда будет необходимо подключаться под собственными учетными записями, что позволит отслеживать действия на сервере, видеть, кем были внесены те или иные изменения и т.д.
## Для отключения доступа root откройте файл /etc/ssh/sshd_config:

sudo vim /etc/ssh/sshd_config

## Найдите строку PermitRootLogin и замените ее текущее значение на:

PermitRootLogin no

# После выполненных действий перезапустите службу SSH:
 
sudo service ssh restart

# Add user to sudo
- /etc/sudoers - add line boss ALL=(ALL) NOPASSWD: ALL - user can work without print a password

# change port
sudo vim /etc/ssh/sshd_config
Port to 5050
ssh -p 5050 root@IP_ADDRESS check if we cant enter with root
ssh -p 5050 boss@IP_ADDRESS

#Nginx
Install nginx
- vim /etc/nginx/sites-avaible/mysite.com (create config)
  https://i.imgur.com/z3Zk00t.png
server {
        listen 80;
        listen [::]:80;


        root /var/www/html;

        index index.html index.htm index.nginx-debian.html;

        server_name доменное_имя;

        location / {
                proxy_pass http://localhost:ваш_порт;
                proxy_http_version 1.1;
                proxy_set_header Upgrade $http_upgrade;
                proxy_set_header Connection 'upgrade';
                proxy_set_header Host $host;
                proxy_cache_bypass $http_upgrade;
        }

}
- sudo ln -s /etc/nginx/sites-avaible/mysite.com /etc/nginx/sites-enabled/mysite.com
- remove default_server from nginx config(not for default config)
- sudo nginx -t (check file for errors)
- sudo systemctl restart nginx
- sudo systemctl status nginx (check)
- to view our site, need to start nodejs

#Faerwall

- sudo apt install ufw -y
- sudo ufw default deny incoming (deny access to server)
- sudo ufw default allow outgoing (allow all outgoing connections from our vps)
- sudo ufw allow ssh
- sudo ufw allow 'Nginx Full'
- sudo ufw allow http
- sudo ufw allow https
- sudo ufw allow 5050
- sudo ufw status verbose
- sudo ufw enable
- sudo ufw status
- sudo ufw status numbered
- sudo ufw delete 4 (item in numbered list)

#Node js
sudo apt install curl
curl https://raw.githubusercontent.com/creationix/nvm/master/install.sh | bash
source ~/.profile

# Установить последную версию

nvm install node

# Установить конкретную версию

nvm install 14.17.3
nvm use 14.17.3

# Проверить активную версию

node -v

#Pm2

- npm install pm2@latest -g
- pm2 start server.js
- pm2 start
# start pm2 when server restart
- pm2 startup ubuntu

pm2 start "yarn preview" --name "medik"

## cloudflare
Cloudflare Nameservers
Copy to namecheap in to section 
NAMESERVERS
Custom dns

In cloudlare add A read for new sites.


