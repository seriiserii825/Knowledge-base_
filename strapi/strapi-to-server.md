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

#Start Your Strapi Server:
NODE_ENV=production pm2 start server.js --name api

#To view the processes, you can use
pm2 list


