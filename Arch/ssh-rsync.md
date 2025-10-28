## download

```bash

rsync -avz -e "ssh -p 1979" serii@myserver.com:/var/www/html/config.php ~/Documents/
```

## upload

```bash
rsync -avz -e "ssh -p 1979" ./.config.php serii@myserver.com:/var/www/html/
```
