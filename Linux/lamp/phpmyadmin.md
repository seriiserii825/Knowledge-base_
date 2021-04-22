https://losst.ru/ustanovka-lamp-ubuntu-18-04
https://losst.ru/ustanovka-phpmyadmin-ubuntu-18-04


### Phpmyadmin
sudo apt install phpmyadmin php-mbstring php-gettext

Отвечаем нет, для настройки базы данных

Для того, чтобы разблокировать вход в phpmyadmin необходимо изменить метод в хода. Для этого в терминале откроем оболочку mysql, следующей командой:

sudo mysql
Далее выведем список пользователей следующей командой:

SELECT user,authentication_string,plugin,host FROM mysql.user;

У пользователя root используется метод входа auth_socket. Нам же необходимо изменить метод входа по паролю. Чтобы изменить метод входа введем следующую команду в терминале:

ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'serii1981;';

В выражении BY 'password' вместо 'password' укажем нужный пароль.

Далее обновим привелегии пользователя следующей командой:

FLUSH PRIVILEGES;
Закрываем оболочку командой:

exit

Исправление ошибок
После входа снизу может быть ошибка "Хранилище конфигурации phpMyAdmin не полностью настроено, некоторые расширенные функции были отключены". Для ёё исправления нужно нажать на "Узнайте причину" и в открывшемся окне нужно нажать "Создать" в строке "Создать базу данных с именем phpmyadmin"

Если мы попробуем перейти в какую-то из таблиц, то увидим ошибку "Warning in ./libraries/sql.lib.php count(): Parametr must be an array or an object that implements Countable". Для её исправления необходимо отредактировать файл sql.lib.php. Для этого в терминале введём следующую команду:

sudo nano /usr/share/phpmyadmin/libraries/sql.lib.php
В открывшемся файле при помощи комбинации клавиш Ctrl+W необходимо найти строчку $analyzed_sql_results[‘select_expr’] == 1. В данную строчку нужно внести следующие изменения:

Заменить (count($analyzed_sql_results[‘select_expr’] == 1) на ((count($analyzed_sql_results[‘select_expr’]) == 1
Сохраняем при помощи комбинации Crl+O и закрываем Ctrl+X. После перезагрузки страницы данная ошибка должна пропасть.

Так же ошибка может появиться при переходе на вкладку Экспорт. "Warning in ./libraries/plugin_interface.lib.php count(): Parametr must be an array or an object that implements Countable".

Снова открываем файл на редактирование следующей командой:

sudo nano /usr/share/phpmyadmin/libraries/plugin_interface.lib.php
Находим и редактируем следующую строчку:

Заменить ($options != null && count($options) > 0) на ($options != null && count((array)$options) > 0)
Сохраним файл и перезагрузим страницу в браузере, как мы видим ошибка исчезла.



