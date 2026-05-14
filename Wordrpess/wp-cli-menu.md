● Да, WP-CLI полностью поддерживает работу с меню WordPress.

Основные команды wp menu

Создание меню
wp menu create "Главное меню"

Список меню
wp menu list
Создание меню
wp menu create "Главное меню"

wp menu create "Главное меню"

Список меню
wp menu list

Удаление меню
Список меню
wp menu list
Список меню
wp menu list

Удаление меню
wp menu delete "Главное меню"

---

Добавление элементов

# Страница

wp menu item add-post main-menu 42

# Произвольная ссылка

wp menu item add-custom main-menu "О нас" "/about"

# Термин (категория, рубрика)

wp menu item add-term main-menu category 5

Список элементов меню
wp menu item list main-menu

Обновление элемента
wp menu item update 123 --title="Новый заголовок" --url="/new-url"

Удаление элемента
wp menu item delete 123

---

Привязка меню к локации темы

# Посмотреть доступные локации

wp menu location list

# Привязать меню к локации

wp menu location assign main-menu primary

---

Привязка меню к локации темы

# Посмотреть доступные локации

wp menu location list

# Привязать меню к локации

wp menu location assign main-menu primary

# Отвязать

wp menu location remove main-menu primary
