docker-compose down -v
sudo chown -R $USER:$USER .
docker-compose up --build


# 
sudo usermod -aG http serii

sudo chown -R 33:33 .
sudo chmod -R 775 .

docker-compose run --rm wpcli core install \
  --url="http://localhost:8888" \
  --title="My Site" \
  --admin_user=admin \
  --admin_password=admin \
  --admin_email=admin@gmail.com \
  --skip-email

## To set up a custom domain like my-site.local that points to your Docker WordPress site (localhost:8888), follow these steps:

✅ 1. Map domain in /etc/hosts
On your host machine, add a line to your hosts file:
sudo nano /etc/hosts

127.0.0.1 my-site.local

This makes my-site.local resolve to your local machine.

✅ 2. Use my-site.local in your Nginx config
Update your docker/nginx.docker or whatever Nginx config you're using.

## Example: docker/nginx.docker

server {
    listen 80;
    server_name my-site.local;

    root /var/www;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$args;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass php-fpm:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }

    location ~ /\.ht {
        deny all;
    }
}
✅ 3. Rebuild Nginx container
If your Nginx config is copied in docker/nginx.docker, rebuild:

docker compose up --build nginx

✅ 4. Set site URL (optional, for WordPress)
If WordPress was already installed before changing the domain, update the site URL via WP CLI:

docker compose exec wpcli wp option update siteurl http://my-site.local
docker compose exec wpcli wp option update home http://my-site.local

✅ 5. Access the site
Now visit:
http://my-site.local
in your browser.
