#concat_ws
select concat_ws(' -- ', Name, Region, Continent) from country limit 10;

#format
select Name, format(SurfaceArea, 0, 'ru_RU') as area_ru, format(SurfaceArea, 0, 'de_DE') as area_de from country order by SurfaceArea desc limit 10;

#case
select  ucase(Name) as u1, lower(Name) as l1 from country limit 10;


