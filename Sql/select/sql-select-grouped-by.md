### GROUP BY - Группировка данных

````sql
-- Группировка по одному полю
SELECT department, COUNT(\*) AS employee_count
FROM employees
GROUP BY department;

-- Группировка с несколькими агрегатами
SELECT
department,
    COUNT(\*) AS count,
    AVG(salary) AS avg_salary,
    SUM(salary) AS total_salary
    FROM employees
    GROUP BY department;

    -- Группировка по нескольким полям
SELECT department, job_title, COUNT(\*)
    FROM employees
    GROUP BY department, job_title;

-- HAVING - фильтрация групп (после GROUP BY)
    SELECT department, AVG(salary) AS avg_salary
    FROM employees
    GROUP BY department
    HAVING AVG(salary) > 60000;

    -- Комбинация WHERE и HAVING
    SELECT department, COUNT(_) AS emp_count
    FROM employees
    WHERE hire_date >= '2020-01-01' -- фильтр до группировки
    GROUP BY department
    HAVING COUNT(_) > 5; -- фильтр после группировки
    ```
````
