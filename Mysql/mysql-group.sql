#group
select Name, Region, Population, sum(SurfaceArea / Population) from country where Population > 500000000 group by Code;
