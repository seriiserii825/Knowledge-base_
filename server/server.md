# User
sudo useradd -m -d /home/username -s /bin/bash username
passwd username

## Теперь для того, чтобы предоставить пользователю sudo-привилегии, его нужно добавить в группу sudo. Это делается командой: 
usermod -aG sudo username

## Копировать содержимое публичного ключа в .ssh/authorized_keys
 
# Установим username владельцем этого каталога (также будет создана группа с тем же именем):
chown -R username:username /home/username/.ssh
chmod 700 /home/username/.ssh
chmod 600 /home/username/.ssh/authorized_keys

# Теперь можно залогиниться на сервер под новым пользователем без использования пароля:

ssh username@your_server_ip

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
- pm2 startup ubuntu - start pm2 when server restart


#Commands

- df -h --total - view empty space

Lets encrypt
sudo apt install certbot python3-certbot-nginx # Отвечаем 'y'
sudo certbot --nginx -d your-domain.com -d www.your-domain.com
certbot renew --dry-run(certificat will be to 90 days)

When certificat will finish need to tipy in terminal
certbot renew

All you need to add to your universal Nuxt app for serving it though PM2 is a file called ecosystem.config.js.
Create a new file with that name in your root project directory and add the following content:

module.exports = {
apps: [
{
name: 'NuxtAppName',
exec_mode: 'cluster',
instances: 'max', // Or a number of instances
script: './node_modules/nuxt/bin/nuxt.js',
args: 'start'
}
]
}

Build and serve the app
Now build your app with npm run build.

And serve it with pm2 start.

Check the status pm2 ls.

Your Nuxt application is now serving!
