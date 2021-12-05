#enter
mysql -u root -p

#databases---------------------------

##create
create database sql_course;

##drop
drop database sql_course;

##view databases
show databases;

##use database
use sql_course;

#tables---------------------------

##show
show tables;

##create
create table teacher(
id INT AUTO_INCREMENT PRIMARY KEY,
surname VARCHAR(255) NOT NULL
);

##show columns
show columns from teacher;

##lessons
create table lesson(
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255) NOT NULL,
teacher_id INT NOT NULL,
foreign_key (teacher_id) references teacher(id)
);

#teacher insert
insert into teacher (surname) values ("Ivanov");


