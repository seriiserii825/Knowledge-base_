#group
select Name, Region, Population, sum(SurfaceArea / Population) from country where Population > 500000000 group by Code;

выбрать возраст, солличество совпадений из таблицы по полю age.
select age, count(age) from teacher group by age;
