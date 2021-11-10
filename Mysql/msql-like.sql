#like
select Name, Region from country where Region like 'Western%';

#like _ (любой символ который должен быть)
select Name, Region from country where Name like '____' order by Name;
