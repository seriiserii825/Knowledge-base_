#subquery
#method 1
select CountryCode from countrylanguage where language = 'Dutch';
select Name from country where Code in ('ABW', 'ANT','BEL','CAN','NLD');

#method 2
select Name from country where Code in (
        select CountryCode from countrylanguage where language = 'Dutch'
);

#method 3
use `world`;
select city.Name, (
	select country.Name from country where country.Code = city.countryCode
) as country from city;
