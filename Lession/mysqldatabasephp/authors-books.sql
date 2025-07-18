use store;
DROP TABLE IF EXISTS Books;
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

CREATE TABLE Books (
    BookID INT PRIMARY KEY,
    Title VARCHAR(255) NOT NULL,
    Genre VARCHAR(255),
    Author_id INT, 
    FOREIGN KEY (Author_id) REFERENCES Authors(Author_id) 
);

INSERT INTO Books (BookID, Title, Genre, Author_id) VALUES
(101, '1984', 'Dystopian', 1),
(102, 'Norwegian Wood', 'Fiction', 2),
(103, 'Things Fall Apart', 'Historical Fiction', 3),
(104, 'Harry Potter 1', 'Fantasy', 4),
(105, 'Animal Farm', 'Satire', 1);

SELECT
    Books.Title AS Book_Title,
    Books.Genre,
    Authors.Name AS Author_Name,
    Authors.Country AS Author_Country
FROM
    Books
JOIN
    Authors ON Books.Author_id = Authors.Author_id
ORDER BY
    Book_Title DESC; 

