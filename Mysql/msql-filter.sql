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

#not null
select Name, IndepYear, HeadOfState, Population from country where IndepYear IS NOT NULL;



