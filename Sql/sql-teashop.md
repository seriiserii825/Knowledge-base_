# Database Schema - Teashop

## Tables

### users

| Column    | Type                  | Constraints                     |
| --------- | --------------------- | ------------------------------- |
| id        | SERIAL                | PRIMARY KEY                     |
| name      | VARCHAR               | DEFAULT 'No user name'          |
| email     | VARCHAR               | UNIQUE, NOT NULL                |
| password  | VARCHAR               | NULLABLE                        |
| picture   | VARCHAR               | DEFAULT '/uploads/no-user.webp' |
| role      | ENUM('user', 'admin') | DEFAULT 'user'                  |
| createdAt | TIMESTAMP             | DEFAULT now()                   |
| updatedAt | TIMESTAMP             | DEFAULT now()                   |

### stores

| Column      | Type      | Constraints                       |
| ----------- | --------- | --------------------------------- |
| id          | SERIAL    | PRIMARY KEY                       |
| title       | VARCHAR   | NOT NULL                          |
| description | VARCHAR   | NULLABLE                          |
| picture     | VARCHAR   | DEFAULT '/uploads/no-store.webp'  |
| user_id     | INTEGER   | FK -> users(id) ON DELETE CASCADE |
| createdAt   | TIMESTAMP | DEFAULT now()                     |
| updatedAt   | TIMESTAMP | DEFAULT now()                     |

### categories

| Column      | Type      | Constraints                        |
| ----------- | --------- | ---------------------------------- |
| id          | SERIAL    | PRIMARY KEY                        |
| title       | VARCHAR   | NOT NULL                           |
| description | VARCHAR   | NOT NULL                           |
| store_id    | INTEGER   | FK -> stores(id) ON DELETE CASCADE |
| createdAt   | TIMESTAMP | DEFAULT now()                      |
| updatedAt   | TIMESTAMP | DEFAULT now()                      |

### colors

| Column    | Type      | Constraints                        |
| --------- | --------- | ---------------------------------- |
| id        | SERIAL    | PRIMARY KEY                        |
| name      | VARCHAR   | NOT NULL                           |
| value     | VARCHAR   | NOT NULL                           |
| store_id  | INTEGER   | FK -> stores(id) ON DELETE CASCADE |
| createdAt | TIMESTAMP | DEFAULT now()                      |
| updatedAt | TIMESTAMP | DEFAULT now()                      |

### products

| Column      | Type          | Constraints                             |
| ----------- | ------------- | --------------------------------------- |
| id          | SERIAL        | PRIMARY KEY                             |
| title       | VARCHAR       | NOT NULL                                |
| description | VARCHAR       | NOT NULL                                |
| price       | DECIMAL(10,2) | NOT NULL                                |
| images      | TEXT[]        | NOT NULL (array)                        |
| store_id    | INTEGER       | FK -> stores(id) ON DELETE CASCADE      |
| category_id | INTEGER       | FK -> categories(id) ON DELETE SET NULL |
| color_id    | INTEGER       | FK -> colors(id) ON DELETE SET NULL     |
| user_id     | INTEGER       | FK -> users(id)                         |
| createdAt   | TIMESTAMP     | DEFAULT now()                           |
| updatedAt   | TIMESTAMP     | DEFAULT now()                           |

### orders

| Column    | Type                    | Constraints       |
| --------- | ----------------------- | ----------------- |
| id        | SERIAL                  | PRIMARY KEY       |
| status    | ENUM('PENDING', 'PAID') | DEFAULT 'PENDING' |
| total     | INTEGER                 | NOT NULL          |
| user_id   | INTEGER                 | FK -> users(id)   |
| createdAt | TIMESTAMP               | DEFAULT now()     |
| updatedAt | TIMESTAMP               | DEFAULT now()     |

### order_items

| Column     | Type      | Constraints        |
| ---------- | --------- | ------------------ |
| id         | SERIAL    | PRIMARY KEY        |
| order_id   | INTEGER   | FK -> orders(id)   |
| product_id | INTEGER   | FK -> products(id) |
| store_id   | INTEGER   | FK -> stores(id)   |
| quantity   | INTEGER   | NOT NULL           |
| price      | INTEGER   | NOT NULL           |
| createdAt  | TIMESTAMP | DEFAULT now()      |
| updatedAt  | TIMESTAMP | DEFAULT now()      |

### reviews

| Column     | Type      | Constraints                          |
| ---------- | --------- | ------------------------------------ |
| id         | SERIAL    | PRIMARY KEY                          |
| text       | VARCHAR   | NOT NULL                             |
| rating     | INTEGER   | NOT NULL                             |
| user_id    | INTEGER   | FK -> users(id)                      |
| product_id | INTEGER   | FK -> products(id) ON DELETE CASCADE |
| store_id   | INTEGER   | FK -> stores(id) ON DELETE CASCADE   |
| createdAt  | TIMESTAMP | DEFAULT now()                        |
| updatedAt  | TIMESTAMP | DEFAULT now()                        |

---

## Relationships

```
users ──┬── stores (1:N)
        ├── orders (1:N)
        ├── reviews (1:N)
        └── products/favorites (1:N)

stores ──┬── categories (1:N)
         ├── colors (1:N)
         ├── products (1:N)
         ├── reviews (1:N)
         └── order_items (1:N)

products ──┬── reviews (1:N)
           └── order_items (1:N)

orders ──── order_items (1:N)
```
