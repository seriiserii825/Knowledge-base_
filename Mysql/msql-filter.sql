#operators
>
<
=
>
>=
<=
<>
!=
BETWEEN
IS NULL

#where
select Name, Population from country where Population > 1000000000;
select Name, Population from country where Population > 100000000 order by Population desc limit 10;
select Name, Population from country where Name <> 'Auba' limit 10;
select Name, Region, HeadOfState, Population from country where HeadOfState = '';

#between
select Name, Population from country where Population between 100000000 and 200000000;

#null
select Name, IndepYear, HeadOfState, Population from country where IndepYear IS NULL;

#not
select Name, Region, Population from country where not Population > 10000000;
select Name, Region, Population from country where Region NOT IN ('Antarctica', 'Caribbean') order by Region, Population desc;

#not null
select Name, IndepYear, HeadOfState, Population from country where IndepYear IS NOT NULL;

#and
select Name, Population, IndepYear from country where IndepYear is null and Population > 500000;

#and or
select Name, Region, Population, IndepYear from country where Region = 'North America' and (IndepYear is null or Population > 50000);

#in
select Name, Region, Population from country where Region IN ('Antarctica', 'Caribbean') order by Region, Population desc;

