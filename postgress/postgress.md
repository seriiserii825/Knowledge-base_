# Docker

docker exec -it postgres psql -U postgres
alter role postgres with password 'newpassword';
create database mydb;

# Подключение

psql -U user -d db
psql -U user
psql -h host -p port -U user db

# Выход

\q

# Помощь

\?
\h # помощь по SQL
\h SELECT # помощь по конкретной команде

# Информация

\conninfo
\encoding

# Базы данных

\l # список БД
\list
\c dbname # подключиться к БД
CREATE DATABASE name;
DROP DATABASE name;

# Таблицы / схемы

\dt # список таблиц
\dt+ # с размером
\d tablename # структура таблицы
\dn # список схем
\df # список функций
\dv # список вьюх
\di # индексы
\ds # последовательности

# Пользователи / роли

\du
CREATE USER name WITH PASSWORD 'pass';
DROP USER name;
ALTER USER name WITH SUPERUSER;

# SQL основные команды

SELECT \* FROM table;
INSERT INTO table (...) VALUES (...);
UPDATE table SET ... WHERE ...;
DELETE FROM table WHERE ...;

# Управление таблицами

CREATE TABLE name (...);
DROP TABLE name;
ALTER TABLE name ADD COLUMN col TYPE;
ALTER TABLE name DROP COLUMN col;

# Состояние подключения

\conninfo

# Поиск

\df _substring_ # поиск функции
\dt _user_ # поиск таблиц

# Настройки вывода

\x on # расширенный вывод
\x off
\timing # включить время выполнения

# Работа с файлами

\i file.sql # выполнить SQL-файл
\o out.txt # вывод в файл
\o # отключить вывод в файл

# Экспорт / импорт

\copy table TO 'file.csv' CSV HEADER;
\copy table FROM 'file.csv' CSV HEADER;

# История

\s # показать историю команд
\w file.txt # сохранить историю в файл

# Транзакции

BEGIN;
COMMIT;
ROLLBACK;

# Подсчёт размера

\l+ # размеры БД
\d+ tablename # размер таблицы
