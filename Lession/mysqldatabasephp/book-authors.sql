use store;

DROP TABLE IF EXISTS Authors;

CREATE TABLE Authors (
    Author_id INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(255) NOT NULL,
    Country VARCHAR(255)
);

INSERT INTO Authors (Author_id, Name, Country) VALUES
(1, 'George Orwell', 'United Kingdom'),
(2, 'Haruki Murakami', 'Japan'),
(3, 'Chinua Achebe', 'Nigeria'),
(4, 'J.K. Rowling', 'United Kingdom');

SHOW TABLES;
SHOW COLUMNS FROM Authors;


