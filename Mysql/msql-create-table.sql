##create
create table teacher(
id INT AUTO_INCREMENT PRIMARY KEY,
surname VARCHAR(255) NOT NULL
);

##lessons
create table lesson(
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        teacher_id INT NOT NULL,
        foreign key (teacher_id) references teacher(id)
);
