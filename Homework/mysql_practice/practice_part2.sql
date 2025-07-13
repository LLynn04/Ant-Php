USE practice_db;
DROP TABLE IF EXISTS posts;

CREATE TABLE posts (
  id INT PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  author VARCHAR(100),
  created DATE
);

INSERT INTO posts (title, author, created)
VALUES 
  ('First Post', 'Alice', '2023-01-01'),
  ('Second Post', 'Bob', '2023-01-02');
  
UPDATE posts id
SET title = 'Updatede post', created ='2023-01-5'
WHERE id = 1;

DELETE FROM posts
WHERE author = 'Bob';


-- SELECT id, title, author FROM posts
-- WHERE id = 1;
SELECT * FROM posts;

