SELECT Clients.FirstName, Clients.LastName FROM Clients
UNION 
SELECT Employees.FirstName, Employees.LastName FROM Employees;


SELECT Clients.FirstName, Clients.LastName, 'client' AS role FROM Clients
UNION 
SELECT Employees.FirstName, Employees.LastName, 'employee' AS role FROM Employees;
