## download

```bash

rsync -avz -e "ssh -p 22" serii@myserver.com:/var/www/html/config.php ~/Documents/
```

## upload

```bash
rsync -avz ./.config.php serii@myserver.com:/var/www/html/
```
