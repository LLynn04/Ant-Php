
USE scenario;

CREATE TABLE Employees (
    EmployeeID INT PRIMARY KEY,
    Name VARCHAR(100),
    Department VARCHAR(100)
);
INSERT INTO Employees (EmployeeID, Name, Department) VALUES
(1, 'Sarah Lee', 'Engineering'),
(2, 'Mark Johnson', 'Marketing'),
(3, 'Priya Patel', 'Engineering'),
(4, 'David Kim', 'Design');

CREATE TABLE Projects (
    ProjectID INT PRIMARY KEY,
    Title VARCHAR(100),
    Client VARCHAR(100)
);
INSERT INTO Projects (ProjectID, Title, Client) VALUES
(101, 'Website Redesign', 'Acme Corp'),
(102, 'SEO Overhaul', 'Beta Co'),
(103, 'App Development', 'Gamma Ltd');

CREATE TABLE Assignments (
    AssignmentID INT PRIMARY KEY,
    EmployeeID INT,
    ProjectID INT,
    Role VARCHAR(100),
    HoursPerWeek INT,
    FOREIGN KEY (EmployeeID) REFERENCES Employees(EmployeeID),
    FOREIGN KEY (ProjectID) REFERENCES Projects(ProjectID)
);
INSERT INTO Assignments (AssignmentID, EmployeeID, ProjectID, Role, HoursPerWeek) VALUES
(1, 1, 101, 'Developer', 20),
(2, 3, 103, 'Lead Dev', 30),
(3, 4, 101, 'UX Designer', 15),
(4, 2, 102, 'Analyst', 25),
(5, 1, 103, 'Developer', 10);

SELECT
Employees.name as Employee_Name,
Employees.Department as Department,
Projects.Title as Projects_Title,
Projects.Client as Client,
Assignments.Role as Role,
Assignments.HoursPerWeek as HoursePerWeek
FROM Assignments
JOIN Employees ON Assignments.EmployeeID = Employees.EmployeeID
JOIN Projects ON Assignments.ProjectID = Projects.ProjectID;

-- task1 filter by dept
SELECT
Employees.name as Employee_Name,
Projects.Title as Projects_Title,
Assignments.Role as Role
FROM Assignments
JOIN Employees ON Assignments.EmployeeID = Employees.EmployeeID
JOIN Projects ON Assignments.ProjectID = Projects.ProjectID
WHERE Employees.Department = 'Engineering';

-- Task2 filter by client and role
SELECT
Employees.name as Employee_Name,
Employees.Department as Department,
Assignments.HoursPerWeek as HoursePerWeek
FROM Assignments
JOIN Employees ON Assignments.EmployeeID = Employees.EmployeeID
JOIN Projects ON Assignments.ProjectID = Projects.ProjectID
WHERE Projects.Client = 'Gamma Ltd' AND Assignments.Role = 'Developer';

-- use multiple condition
SELECT
Employees.name as Employee_Name,
Employees.Department as Department,
Projects.Title as Projects_Title,
Assignments.HoursPerWeek as HoursePerWeek
FROM Assignments
JOIN Employees ON Assignments.EmployeeID = Employees.EmployeeID
JOIN Projects ON Assignments.ProjectID = Projects.ProjectID
WHERE Department IN ('Design', 'Marketing') AND HoursPerWeek > 20;

--  Task 4: Use LIKE and Ranges
SELECT
Employees.name as Employee_Name,
Projects.Title as Projects_Title,
Assignments.HoursPerWeek as HoursePerWeek
FROM Assignments
JOIN Employees ON Assignments.EmployeeID = Employees.EmployeeID
JOIN Projects ON Assignments.ProjectID = Projects.ProjectID
WHERE Name LIKE 'S%' AND HoursPerWeek BETWEEN 10 AND 25;

-- Task 5: Aggregate with JOIN
SELECT
    Employees.Name AS Employee_Name,
    SUM(Assignments.HoursPerWeek) AS TotalHours
FROM Assignments
JOIN Employees ON Assignments.EmployeeID = Employees.EmployeeID
GROUP BY Employees.Name;

-- Task 6: Find Overloaded Employees
SELECT
    Employees.Name AS Employee_Name,
    Employees.Department,
    SUM(Assignments.HoursPerWeek) AS TotalHours
FROM Assignments
JOIN Employees ON Assignments.EmployeeID = Employees.EmployeeID
GROUP BY Employees.Name, Employees.Department
HAVING SUM(Assignments.HoursPerWeek) > 30;
