Strapi is an open-source, Node.js based, headless CMS to manage content and make it available through a fully customizable API. It is designed to build practical, production-ready Node.js APIs in hours instead of weeks.
Offcial Website -https://strapi.io/  || https://strapi.io/getting-started/

Nginx (pronounced engine x) is open source Web server software that also performs reverse proxy, load balancing, email proxy and HTTP cache services.
Offcial Website - https://www.nginx.com/
NGINX Reverse Proxy - https://docs.nginx.com/nginx/admin-guide/web-server/reverse-proxy/
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Ubuntu 20.04 LTS                     Hostname - www.yourdomain.com  - ip Address - 192.168.1.10 
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
apt update ; apt install -y build-essential net-tools curl git software-properties-common nginx
curl -sL https://deb.nodesource.com/setup_10.x | sudo -E bash -
apt install nodejs -y
node -v ; npm -v

npm install strapi@alpha -g  --silent
strapi version
strapi new myproject
cd myproject

npm install forever -g  --silent
forever start --minUptime 1000 --spinSleepTime 1000 -c "npm start" ./

nano /etc/nginx/conf.d/yourdomain.com.conf
server {
        listen 80;
        server_name www.yourdomain.com;

        location / {
                proxy_pass http://127.0.0.1:1337;
                proxy_set_header Host $http_host;
                proxy_set_header X-Real-IP $remote_addr;
                proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
                proxy_set_header X-Forwarded-Proto $scheme;
        }
}
nginx -t
netstat -tlpn | grep 1337 
systemctl daemon-reload ; systemctl restart nginx
echo "192.168.1.10 www.yourdomain.com"  >> /etc/hosts

http://www.yourdomain.com
http://www.yourdomain.com/admin
