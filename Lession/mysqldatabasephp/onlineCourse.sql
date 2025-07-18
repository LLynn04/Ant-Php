use Course;

DROP TABLE IF EXISTS Enrollments;
DROP TABLE IF EXISTS Students;
DROP TABLE IF EXISTS Courses;

CREATE TABLE Students (
    StudentID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(255) NOT NULL,
    Email VARCHAR(255) UNIQUE NOT NULL
);

INSERT INTO Students (StudentID, Name, Email) VALUES
(1, 'Alice Smith', 'alice@example.com'),
(2, 'Bob Johnson', 'bob@example.com'),
(3, 'Clara Zhang', 'clara@example.com');

CREATE TABLE Courses (
    CourseID INT PRIMARY KEY AUTO_INCREMENT,
    Title VARCHAR(255) NOT NULL,
    Category VARCHAR(255)
);

INSERT INTO Courses (CourseID, Title, Category) VALUES
(101, 'Introduction to SQL', 'Programming'),
(102, 'Web Development', 'Web Design'),
(103, 'Data Science Basics', 'Data Science');

CREATE TABLE Enrollments (
    EnrollmentID INT PRIMARY KEY AUTO_INCREMENT,
    StudentID INT NOT NULL,
    CourseID INT NOT NULL,
    FOREIGN KEY (StudentID) REFERENCES Students(StudentID),
    FOREIGN KEY (CourseID) REFERENCES Courses(CourseID)
);

INSERT INTO Enrollments (EnrollmentID, StudentID, CourseID) VALUES
(1, 1, 101),
(2, 1, 103),
(3, 2, 101),
(4, 3, 102);

SELECT
    Student.Name AS Student_Name,
    Student.Email AS Student_Email,
    Course.Title AS Course_Title,
    Course.Category AS Course_Category
FROM
    Students AS Student
JOIN
    Enrollments AS Enroll ON Student.StudentID = Enroll.StudentID
JOIN
    Courses AS Course ON Enroll.CourseID = Course.CourseID;
