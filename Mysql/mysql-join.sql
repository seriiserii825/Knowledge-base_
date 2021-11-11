#contry and cities by code
SELECT city.Name, country.Name from city, country where country.Code = city.CountryCode;
SELECT city.Name, country.Name FROM city JOIN country ON country.Code = city.CountryCode;

SELECT Customers.FirstName, Products.ProductName, Orders.CreatedAt
  FROM Customers, Products, Orders
    WHERE Customers.Id = Orders.CustomerId AND Products.id = Orders.ProductId;


