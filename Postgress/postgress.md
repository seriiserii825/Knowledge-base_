# Install
sudo -u postgres psql

#create database and user
create database mediumclone;
create user mediumclone with encrypted password '123';
grant all privileges on database mediumclone to mediumclone;

## commands
\l - list databases
\du - display users
