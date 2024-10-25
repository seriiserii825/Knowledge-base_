sudo pacman -S postgresql

## setup
sudo -iu postgres
sudo -u postgres initdb --locale en_US.UTF-8 -D /var/lib/postgres/data
systemctl start postgresql
systemctl enable postgresql
systemctl status postgresql

## Create user and database
sudo -iu postgres
psql

# Create user
CREATE USER serii WITH PASSWORD 'serii1981';
ALTER USER serii WITH SUPERUSER;

## pgadmin
go to project folder
source venv/bin/activate
pip install pip==24.0


sudo chown $USER /var/lib/pgadmin
sudo chown $USER /var/log/pgadmin

## start pgadmin
pgadmin4
set email and password
go to
http://127.0.0.1:5050
and login with email and password

## reset login
sudo rm /var/lib/pgadmin/pgadmin4.db
pgadmin4
