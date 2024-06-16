### httaccess

```

<IfModule mod_rewrite.c>
	Header set Access-Control-Allow-Origin "*"
	Header set Access-Control-Allow-Methods "GET, POST, PUT, DELETE, PATCH"
	Header set Access-Control-Allow-Headers "Access-Control-Allow-Headers, Origin, Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers,Authorization,authkey,appkey"
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

### enable headers

```

sudo a2enmode headers
sudo systemctl restart apache2
```
