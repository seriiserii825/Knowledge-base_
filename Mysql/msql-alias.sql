#concat
select concat(Name, ' | ', Region) from country limit 10;

#alias
select concat(Name, ' | ', Region) as full_name from country limit 10;
select Name N, Region R from country limit 10;
select Name N, SurfaceArea S, Population P, (Population/SurfaceArea) as density from country order by P desc limit 10;
