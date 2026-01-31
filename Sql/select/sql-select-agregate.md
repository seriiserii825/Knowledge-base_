### Агрегатные функции

````sql
-- Подсчет записей
SELECT COUNT(*) FROM employees;
SELECT COUNT(DISTINCT department) FROM employees;

-- Сумма
SELECT SUM(salary) FROM employees;

-- Среднее значение
SELECT AVG(salary) FROM employees;

-- Минимум и максимум
SELECT MIN(salary), MAX(salary) FROM employees;

-- Комбинация
SELECT
COUNT(*) AS total_employees,
    AVG(salary) AS average_salary,
    MAX(salary) AS max_salary
    FROM employees
    WHERE department = 'IT';
    ```
````
