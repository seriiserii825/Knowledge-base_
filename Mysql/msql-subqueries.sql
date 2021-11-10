#subquery
#method 1
select CountryCode from countrylanguage where language = 'Dutch';
select Name from country where Code in ('ABW', 'ANT','BEL','CAN','NLD');

#method 2
select Name from country where Code in (
        select CountryCode from countrylanguage where language = 'Dutch'
);
