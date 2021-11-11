# select without doubles
SELECT DISTINCT Continent FROM country;

# limit
SELECT Country FROM country LIMIT 10;

# offset
SELECT Country FROM country LIMIT 10 OFFSET 4;

# order
select Name, Population from country order by Population;
select Name, Region, Population, Name from country order by Region, Population;
select Name, Region, Population, Name from country order by 1, 2; (1 -> Region)
select Region, Population, Name from country order by Region DESC, Population DESC;

