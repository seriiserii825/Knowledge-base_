# quick: temp wp-cli -> change email -> remove

Когда на сервере нет wp-cli: без установки, без sudo и PATH.

Готовый скрипт (показывает текущий email, спрашивает новый с дефолтом `webmaster@altuofianco.it`,
подтверждение, потом удаляет wp-cli; запускать из любой папки сайта, например из темы):
[update-admin-email-on-vps.sh](/home/serii/Documents/bash/bash-scripts/update-admin-email-on-vps.sh)

```bash
scp ~/Documents/bash/bash-scripts/update-admin-email-on-vps.sh host@vps10:/tmp/
ssh host@vps10
cd ~/web/casagratis.it/public_html/wp-content/themes/ag-casagratis
bash /tmp/update-admin-email-on-vps.sh && rm /tmp/update-admin-email-on-vps.sh
```

Вручную:

```bash
cd ~/web/casagratis.it/public_html     # папка сайта (где wp-config.php)

curl -s https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar -o /tmp/wp-cli.phar
# нет curl: wget -O /tmp/wp-cli.phar <тот же URL>

php /tmp/wp-cli.phar option get admin_email
php /tmp/wp-cli.phar option update admin_email NEW_EMAIL
php /tmp/wp-cli.phar option delete adminhash new_admin_email   # убрать pending-запрос
php /tmp/wp-cli.phar option get admin_email                    # проверить

rm /tmp/wp-cli.phar
rm -rf ~/.wp-cli
```

# install wp-cli

```bash
curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
php wp-cli.phar --info                 # проверить, что работает
chmod +x wp-cli.phar
sudo mv wp-cli.phar /usr/local/bin/wp
wp --info
```

Без sudo (обычный юзер на VPS) — положить в `~/bin` и добавить в PATH:

```bash
mkdir -p ~/bin && mv wp-cli.phar ~/bin/wp
echo 'export PATH="$HOME/bin:$PATH"' >> ~/.bashrc && source ~/.bashrc
```

Запускать из папки сайта (где `wp-config.php`) или с `--path=/path/to/public_html`.
Под root — добавить `--allow-root`.

# uninstall wp-cli

```bash
which wp                        # где лежит
sudo rm /usr/local/bin/wp       # или: rm ~/bin/wp
rm -rf ~/.wp-cli                # кэш, конфиг, пакеты (необязательно)
```

Если добавлял `~/bin` в PATH только ради wp — убрать строку из `~/.bashrc`.

# with wp-cli

```bash
wp option get admin_email
# применяется сразу, без письма с подтверждением
wp option update admin_email webmaster@altuofianco.it
# update НЕ убирает старый pending-запрос из UI ("C'è una richiesta in attesa..."),
# плашка останется висеть — удалить его отдельно:
wp option delete adminhash new_admin_email
wp option get admin_email   # проверить
```

# cancel pending change ("C'è una richiesta in attesa per un cambio dell'email...")

Pending-запрос хранится в опциях `adminhash` и `new_admin_email`
(то же делает ссылка "Annulla" в Impostazioni → Generali):

```bash
wp option delete adminhash new_admin_email
```

# with database (mysql)

Доступы и префикс таблиц — в `wp-config.php` (ниже префикс `wp_`, подставить свой):

```bash
grep -E "DB_NAME|DB_USER|DB_PASSWORD|DB_HOST|table_prefix" wp-config.php
mysqldump -u DB_USER -p DB_NAME > backup.sql   # бэкап перед правкой
mysql -u DB_USER -p DB_NAME
```

```sql
-- посмотреть текущие значения
SELECT option_name, option_value FROM wp_options
WHERE option_name IN ('admin_email', 'new_admin_email', 'adminhash');

-- email сайта (Impostazioni → Generali)
UPDATE wp_options SET option_value = 'webmaster@altuofianco.it' WHERE option_name = 'admin_email';

-- убрать pending-запрос на смену
DELETE FROM wp_options WHERE option_name IN ('adminhash', 'new_admin_email');

-- email пользователя-админа (Utenti → Profilo) — это отдельное поле
SELECT ID, user_login, user_email FROM wp_users;
UPDATE wp_users SET user_email = 'webmaster@altuofianco.it' WHERE user_login = 'admin';
```

Если есть объектный кэш (Redis/Memcached) — после правки `wp cache flush`.
Мультисайт: email сети в `wp_sitemeta` (`meta_key = 'admin_email'`).

# with php

```php
// in funcions.php after remove code
add_action('init', function () {
  $new_email = 'webmaster@altuofianco.it';
  if (get_option('admin_email') !== $new_email) {
    update_option('admin_email', $new_email);
  }
  // убрать pending-запрос, иначе плашка "C'è una richiesta in attesa..." останется
  delete_option('adminhash');
  delete_option('new_admin_email');
});
```
