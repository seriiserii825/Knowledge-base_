# select without doubles
SELECT DISTINCT Continent FROM country;

#select by id
SELECT Country FROM country WHERE id=1;
SELECT Country FROM country WHERE id>1;
SELECT Country FROM country WHERE Name="London";

#delete
DELETE FROM teacher WHERE id = 1;

#alias 
select id as identificator, surname as family from teacher;

#like
SELECT * FROM teacher WHERE surname LIKE "%ov";

#and
SELECT * FROM teacher WHERE surname LIKE "%ov" AND id > 3;
SELECT * FROM teacher WHERE surname LIKE "%ov" OR id > 3;

#not
SELECT * FROM teacher WHERE NOT id > 3;

#between
SELECT * FROM teacher WHERE id BETWEEN 2 AND 4;(inclusive 2 and 4)

# limit
SELECT Country FROM country LIMIT 10;

# offset
SELECT Country FROM country LIMIT 10 OFFSET 4;

# order
select Name, Population from country order by Population;
select Name, Region, Population, Name from country order by Region, Population;
select Name, Region, Population, Name from country order by 1, 2; (1 -> Region)
select Region, Population, Name from country order by Region DESC, Population DESC;

