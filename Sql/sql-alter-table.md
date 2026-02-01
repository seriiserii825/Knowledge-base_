# SQL ALTER TABLE Reference Guide

## Common ALTER TABLE Operations

### Add a Column

```sql
ALTER TABLE employees
ADD email VARCHAR(100);

-- Add multiple columns
ALTER TABLE employees
ADD COLUMN phone VARCHAR(20),
ADD COLUMN address TEXT;
```

### Drop a Column

```sql
ALTER TABLE employees
DROP COLUMN email;
```

### Modify a Column

```sql
-- MySQL/MariaDB
ALTER TABLE employees
MODIFY COLUMN salary DECIMAL(10,2);

-- PostgreSQL
ALTER TABLE employees
ALTER COLUMN salary TYPE DECIMAL(10,2);

-- SQL Server
ALTER TABLE employees
ALTER COLUMN salary DECIMAL(10,2);
```

### Rename a Column

```sql
-- MySQL 8.0+, PostgreSQL
ALTER TABLE employees
RENAME COLUMN old_name TO new_name;

-- SQL Server
EXEC sp_rename 'employees.old_name', 'new_name', 'COLUMN';
```

### Add Constraints

```sql
-- Primary key
ALTER TABLE employees
ADD PRIMARY KEY (employee_id);

-- Foreign key
ALTER TABLE orders
ADD CONSTRAINT fk_customer
FOREIGN KEY (customer_id) REFERENCES customers(customer_id);

-- Unique constraint
ALTER TABLE employees
ADD CONSTRAINT unique_email UNIQUE (email);

-- Check constraint
ALTER TABLE employees
ADD CONSTRAINT check_salary CHECK (salary > 0);
```

### Drop Constraints

```sql
ALTER TABLE employees
DROP CONSTRAINT constraint_name;
```

### Rename Table

```sql
ALTER TABLE old_table_name
RENAME TO new_table_name;
```

## Set NULL by Default

### Set Column to NULL with Default NULL

**MySQL/MariaDB:**

```sql
ALTER TABLE table_name
MODIFY COLUMN column_name datatype NULL DEFAULT NULL;

-- Example
ALTER TABLE employees
MODIFY COLUMN phone VARCHAR(20) NULL DEFAULT NULL;
```

**PostgreSQL:**

```sql
-- Drop NOT NULL constraint
ALTER TABLE table_name
ALTER COLUMN column_name DROP NOT NULL;

-- Set default to NULL
ALTER TABLE table_name
ALTER COLUMN column_name SET DEFAULT NULL;

-- Example (both in one statement)
ALTER TABLE employees
ALTER COLUMN phone DROP NOT NULL,
ALTER COLUMN phone SET DEFAULT NULL;
```

**SQL Server:**

```sql
ALTER TABLE table_name
ALTER COLUMN column_name datatype NULL;

-- Then set default
ALTER TABLE table_name
ADD DEFAULT NULL FOR column_name;

-- Example
ALTER TABLE employees
ALTER COLUMN phone VARCHAR(20) NULL;
```

### Just Allow NULL (without changing default)

```sql
-- MySQL
ALTER TABLE employees
MODIFY COLUMN phone VARCHAR(20) NULL;

-- PostgreSQL
ALTER TABLE employees
ALTER COLUMN phone DROP NOT NULL;

-- SQL Server
ALTER TABLE employees
ALTER COLUMN phone VARCHAR(20) NULL;
```

---

**Note:** In most databases, if you don't specify a default value, NULL is already the implicit default for nullable columns, so you may only need to remove the NOT NULL constraint.
