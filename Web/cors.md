### httaccess

```

<IfModule mod_rewrite.c>
	Header set Access-Control-Allow-Origin "*"
	Header set Access-Control-Allow-Methods "GET, POST, PUT, DELETE, PATCH"
	Header set Access-Control-Allow-Headers "Access-Control-Allow-Headers, Origin, Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers"
</IfModule>
```

### enable headers

```

sudo a2enmode headers
sudo systemctl restart apache2
```

in laravel cors.php

'allowed_origins' => ['*'],
