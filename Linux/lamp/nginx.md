## change port 
sudo vim /etc/nginx/nginx.conf
change port 80 to 81
sudo systemctl restart nginx


# create project
sudo mkdir -p /var/www/oop.local/html
sudo chown -R $USER:$USER /var/www/oop.local/
sudo chmod -R 755 /var/www

sudo apt install nginx
sudo systemctl status nginx (active running)

#remove apache2
sudo apt-get purge apache2 apache2-utils apache2-bin apache2.2-common
which apache2

server {
        listen 80;
        listen [::]:80;

        root /var/www/oop.local;
        index index.html index.htm index.nginx-debian.html;
        error_log  /var/log/nginx/error.log;
        access_log  /var/log/nginx/access.log;

        server_name oop.local www.oop.local;

        location / {
                index index.php;
                try_files $uri $uri/ /index.php?$args;
        }

        location ~ [^/]\.php(/|$) {
                fastcgi_split_path_info ^(.+?\.php)(/.*)$;
                if (!-f $document_root$fastcgi_script_name) {return 404;}
                fastcgi_param HTTP_PROXY "";
                include fastcgi_params;
                fastcgi_pass unix:/var/run/php/php8.0-fpm.sock;
                fastcgi_index index.php;
                fastcgi_param SCRIPT_FILENAME $request_filename;
        }

        location ~ /\.ht {
                deny all;
        }
}
            

sudo ln -s /etc/nginx/sites-available/nuxt-bludelego.conf /etc/nginx/sites-enabled/nuxt-bludelego.conf

#nginx conf
sudo nvim /etc/nginx/nginx.conf
remove # from line server_names_hash_bucket_size
add lines
 types_hash_max_size 2048;    # Increase from 1024 to 2048
types_hash_bucket_size 64;   # You can also set this to 128 or higher if needed
sudo systemctl restart nginx
sudo systemctl status nginx
sudo systemctl enable nginx

#host
sudo vim /etc/hosts
127.0.0.1       oop.local

# inspect container
docker logs nginx_course

