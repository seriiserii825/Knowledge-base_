-- Вариант 1: С использованием EXTRACT
SELECT p.title as product_title, p."createdAt", s.title as store_title
FROM products p
JOIN stores s ON p.store_id = s.id
WHERE EXTRACT(YEAR FROM p."createdAt") = 2024;

-- Вариант 2: С использованием DATE_TRUNC
SELECT p.title as product_title, p."createdAt", s.title as store_title
FROM products p
JOIN stores s ON p.store_id = s.id
WHERE DATE_TRUNC('year', p."createdAt") = '2024-01-01'::timestamp;

-- Вариант 3: С использованием диапазона дат (самый эффективный)
SELECT p.title as product_title, p."createdAt", s.title as store_title
FROM products p
JOIN stores s ON p.store_id = s.id
WHERE p."createdAt" >= '2024-01-01' AND p."createdAt" < '2025-01-01';

-- Вариант 4: С использованием BETWEEN
SELECT p.title as product_title, p."createdAt", s.title as store_title
FROM products p
JOIN stores s ON p.store_id = s.id
WHERE p."createdAt" BETWEEN '2024-01-01' AND '2024-12-31 23:59:59.999999';

-- Вариант 5: С сортировкой по дате
SELECT p.title as product_title, p."createdAt", s.title as store_title
FROM products p
JOIN stores s ON p.store_id = s.id
WHERE EXTRACT(YEAR FROM p."createdAt") = 2024
ORDER BY p."createdAt" DESC;
