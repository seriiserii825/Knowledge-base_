- connect to server throw ssh.
- Update and Upgrade on server

# User

- adduser boss
     - deluser boss - delete user
     - rm /home/boss - delete boss home dir
- gpasswd -a boss sudo - add user to admin(to create or delete use sudo, to insert password)
- su - boss - connect boss as user

# Ssh

- password for ssh will be from the hosting email
- mkdir .ssh
- chmod 700 .ssh
- vim .ssh/authorize_keys - add here our public key.
- .ide_rsa.pug - public key
- chmod 600 .ssh/authorize_keys
- exit - go to root user
- /etc/ssh/ssh_config - change port from 22 to 5050, and PermitRouteLogin - no
- service ssh restart
- /etc/sudoers - add line boss ALL=(ALL) NOPASSWD: ALL - user can work without print a password
- ssh -p 5050 root@IP_ADDRESS check if we cant enter with root
- ssh -p 5050 boss@IP_ADDRESS

# Nginx


#Map

- grep -w 80 /etc/services - check port avaible on site
- create /home/boss/Sites
- sudo chmod -R 777 /home/boss/Sites
- vim /etc/nginx/sites-avaible/mysite.com (create config)
  https://i.imgur.com/z3Zk00t.png
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

#Git

- install git

#Mongodb

- sudo apt install -y mongodb
- sudo systemctl enable mongodb.service
- sudo systemctl status mongodb
- sudo service mongodb start( if mongod not work )
- sudo ufw allow 27017 (add mongodb port to ufw)
- sudo vim /etc/mongod.conf bind_ip = 127.0.0.1, ip_our_server
- sudo systemctl restart mongodb

#Commands

- df -h --total - view empty space

Lets encrypt
sudo apt install certbot python3-certbot-nginx # Отвечаем 'y'
sudo certbot --nginx -d your-domain.com -d www.your-domain.com
certbot renew --dry-run(certificat will be to 90 days)

When certificat will finish need to tipy in terminal
certbot renew

All you need to add to your universal Nuxt app for serving it though PM2 is a file called ecosystem.config.js. Create a new file with that name in your root project directory and add the following content:

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
