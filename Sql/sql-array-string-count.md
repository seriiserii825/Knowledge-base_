# array string count

```sql
SELECT
  title,
  cardinality(string_to_array(images, ',')) AS images_count
FROM products
WHERE cardinality(string_to_array(images, ',')) > 1
```
