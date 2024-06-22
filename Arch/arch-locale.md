в файле locale.gen
/etc/locale.gen
ru_RU.UTF-8 UTF-8 для рашн
сохраняешь и запускаешь команду 
sudo locale-gen
проверяешь 
localectl list-locales
в /etc/locale.conf прописываешь такую строку
LANG=en_US.UTF-8
localectl status
или 
locale 
чтобы посмотреть
