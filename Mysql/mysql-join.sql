#==================
#contry and cities by code
SELECT city.Name, country.Name from city, country where country.Code = city.CountryCode;

## join
SELECT city.Name, country.Name FROM city JOIN country ON country.Code = city.CountryCode;

#===============
#select
SELECT Customers.FirstName, Products.ProductName, Orders.CreatedAt
  FROM Customers, Products, Orders
    WHERE Customers.Id = Orders.CustomerId AND Products.id = Orders.ProductId;

#join
SELECT Customers.FirstName, Products.ProductName, Orders.CreatedAt
  FROM Orders(from orders, because in orders we have customerId and productId)
    JOIN Customers ON Customers.Id = Orders.CustomerId
    JOIN Products ON Products.Id = Orders.ProductId;

#===============
#join
SELECT city.Name, country.Name, countrylanguage.Language
  FROM country
    JOIN city ON city.CountryCode = country.Code
    JOIN countrylanguage ON countrylanguage.CountryCode = country.Code
      WHERE countrylanguage.IsOfficial = 'T';

# LEFT JOIN | RIGHT JOIN

SELECT Customers.FirstName, Orders.CreatedAt, Orders.ProductCount, Orders.Price, Orders.ProductId 
  FROM Orders 
    LEFT JOIN Customers 
        ON Orders.CustomerId = Customers.Id
