USE practice_db;

CREATE TABLE users (
id INT primary key auto_increment,
last_name VARCHAR(255) NOT NULL,
first_name VARCHAR(255),
age INT default(20)
);

-- add col
ALTER TABLE users
ADD email VARCHAR(255);

-- modify email
ALTER TABLE users
MODIFY email VARCHAR(255) NOT NULL;

-- rename email
ALTER TABLE users 
RENAME COLUMN email TO user_email;

-- delete
ALTER TABLE users
DROP COLUMN user_email;

-- drop table
DROP TABLE IF EXISTS users;

-- drop db
DROP DATABASE practice_db;

-- show tab
SHOW TABLES ;
-- describe
-- SHOW COLUMNS FROM users;
