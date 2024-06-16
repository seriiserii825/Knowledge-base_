sudo apt update  
sudo apt install -y build-essential net-tools curl git software-properties-common
sudo apt install apache2 -y
sudo a2enmod proxy proxy_http
sudo vim /etc/apache2/sites-available/yourdomain.conf

<VirtualHost *:80>
    #Domain Name
    ServerName yourdomain.com
    ServerAlias www.yourdomain.com

    #HTTP proxy/gateway server
    ProxyRequests off
    ProxyPass / http://127.0.0.1:1337/
    ProxyPassReverse / http:/127.0.0.1:1337/    
</VirtualHost>

sudo a2dissite 000-default.conf
sudo a2ensite yourdomain
systemctl reload apache2
