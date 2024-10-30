sudo pacman -S phpmyadmin

### Nginx

1. Create a symbolic link to the phpMyAdmin configuration file:bash

```
sudo ln -s /etc/webapps/phpmyadmin/nginx.example.conf /etc/nginx/sites-available/phpmyadmin.conf
```

Create another symbolic link to enable the phpMyAdmin site:

```
sudo ln -s /etc/nginx/sites-available/phpmyadmin.conf /etc/nginx/sites-enabled/phpmyadmin.conf
```

Edit the Nginx configuration file `/etc/nginx/nginx.conf` and include the phpMyAdmin configuration file by adding the following line inside the `http` block:

```
include sites-enabled/*;
```

Restart the Nginx web server to apply the changes:

```
sudo systemctl restart nginx
```

## Configure PHP

In order to use phpMyAdmin, you must enable the `mysqli` extension in your PHP configuration. Edit the `/etc/php/php.ini` file and uncomment the following line (remove the semicolon at the beginning of the line):

```
extension=mysqli
```

Finally, restart your web server to apply the changes:

- For Apache:bash

```
sudo systemctl restart httpd
```

For Nginx:

```
sudo systemctl restart nginx
```
