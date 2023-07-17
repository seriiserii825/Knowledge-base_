The files you're looking for are already on your system:
Copy files codes to the same files in docker, and restart system and docker

/etc/ssl/certs/ssl-cert-snakeoil.pem
/etc/ssl/private/ssl-cert-snakeoil.key

open laravel page and set checkbox

Advanced:

If for some reason you need to create a fresh certificate, you can run
sudo make-ssl-cert generate-default-snakeoil --force-overwrite 

