Strapi is an open-source, Node.js based, headless CMS to manage content and make it available through a fully customizable API. It is designed to build practical, production-ready Node.js APIs in hours instead of weeks.
Offcial Website -https://strapi.io/  || https://strapi.io/getting-started/

Apache is the most popular web server software in use today.|| Offcial website - https://httpd.apache.org/
Reverse Proxy Guide - https://httpd.apache.org/docs/2.4/howto/reverse_proxy.html
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Testing Environment:
Ubuntu 20.04 LTS     Hostname - www.yourdomain.com  - ip Address - 192.168.1.10 
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
apt update ; apt install -y build-essential net-tools curl git software-properties-common
curl -sL https://deb.nodesource.com/setup_10.x | sudo -E bash -
apt install nodejs -y ; node -v ; npm -v

npm install strapi@alpha -g --silent
strapi new myproject
cd myproject
npm install forever -g  --silent
forever start --minUptime 1000 --spinSleepTime 1000 -c "npm start" ./

apt update ; apt install apache2 -y
a2enmod proxy proxy_http
sudo gedit /etc/apache2/sites-available/yourdomain.conf &>/dev/null
<VirtualHost *:80>
    #Domain Name
    ServerName yourdomain.com
    ServerAlias www.yourdomain.com

    #HTTP proxy/gateway server
    ProxyRequests off
    ProxyPass / http://127.0.0.1:1337/
    ProxyPassReverse / http:/127.0.0.1:1337/    
</VirtualHost>

a2dissite 000-default.conf ; a2ensite yourdomain
apache2ctl configtest
systemctl daemon-reload ; systemctl reload apache2
echo "192.168.1.10 www.yourdomain.com"  >> /etc/hosts

http://www.yourdomain.com   | http://www.yourdomain.com/admin
