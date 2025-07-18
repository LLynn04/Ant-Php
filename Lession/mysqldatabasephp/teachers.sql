USE teachers;

CREATE TABLE students(
student_id int primary key auto_increment,
first_name varchar(100),
last_name varchar(100)
);

CREATE TABLE classes (
class_id int primary key auto_increment,
class_name varchar(100),
class_dept varchar(100)
);

show tables;
show columns from classes;