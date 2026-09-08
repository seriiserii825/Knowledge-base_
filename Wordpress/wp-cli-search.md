# Search

## find image id

```sql

wp post list --post_type=attachment --search="Borgoluce-Birra-Nostrana.jpg" --format=table | less
# with / find image name
```

## find post parent for image

```sql
wp db query "SELECT ID, post_parent, guid FROM wp_posts WHERE post_type='attachment' AND guid LIKE '%Borgoluce-Birra-Nostrana.jpg%'"
```

```bash
ID	post_parent	guid
2970	1256	http://lc-borgoluce.local/wp-content/uploads/2022/12/Borgoluce-Birra-Nostrana.jpg
```

## find post title by id

```sql
wp post get 1256 --field=post_title
Birra NOSTRANA
```

## search post by title

```sql
wp db query "
SELECT ID, post_title, post_type, post_status
FROM wp_posts
WHERE post_status NOT IN ('trash','auto-draft','inherit')
  AND post_title LIKE '%Birra NOSTRANA%';
"
```

