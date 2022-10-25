cd (project name)

npm install --production
#and
npm i forever -g
#or
npm i pm2 -g

cp .env.example .env
HOST=0.0.0.0
PORT=1337
APP_KEYS=2V+39791mGaxSwRHHhwfhg==,aMWCRV6iaTxRZXx5NM/2BA==,rIsvFirfdm8YNwsy0QnLug==,dWUY3urnIol5YOkpdLTkfQ==
API_TOKEN_SALT=ksJpczGexS/3UaQ4Lb2efQ==
ADMIN_JWT_SECRET=S1WqtEgbW9ZKy3eF2JUbZQ==
JWT_SECRET=S72rrbkK0kCk1eE6g5CqIA==

NODE_ENV=production npm run build

#To have your app deployed with forever or PM2, create a “server.js” file using
nvim server.js
const strapi = require('@strapi/strapi');
strapi(/* {...} */).start();

npm install

#Start Your Strapi Server:
NODE_ENV=production pm2 start server.js --name api

#To view the processes, you can use
pm2 list
pm2 monit

# Подключаем автоматический запуск приложений через pm2 после перезагрузки сервера:
pm2 startup

# и сохраняем изменения:
pm2 save

# При успешном подключении к Bucket в веб-интерфейсе pm2 появится Ваше приложение(процесс). Там вы сможете посмотреть статистику, сбросить монитор и перезагрузить приложение:

# Далее нам необходимо повторно добавить в автозагрузку pm2 и сохранить изменения:
pm2 unstartup
pm2 startup
pm2 save

#error (ER_NOT_SUPPORTED_AUTH_MODE: Client does not support authentication protocol requested by server; consider upgrading MySQL client)
sudo -u root -p
mysql> ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'ChoosePassword';

mysql> FLUSH PRIVILEGES;
