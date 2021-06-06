serii1981;
### Установка mysql
sudo apt install mysql-server

### Настройка mysql
sudo mysql_secure_installation

Set password

Add password for the root to work with workbench
sudo mysql -u root
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'Serii1981;';

### To enter in terminal, need to type
sudo mysql -u root -p

### dump
mysqldump -u root -p todos > todos.sql
