В .env laradoc- заменить версию latest на 5.7

Удалить директорию ~/.laradock/data/mysql
docker-compose build mysql


docker-compose exec --user=laradock workspace bash


В файле .env проекта поменять DB_HOST=mysql
docker-compose exec mysql bash
mysql -u root -proot


