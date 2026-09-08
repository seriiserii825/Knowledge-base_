## post url

```
https://salferrarello.com/wp-cli-local-by-flywheel-without-ssh/
```

### go to root where is app/ conf/ logs/

## runt this command

```
curl -O https://raw.githubusercontent.com/salcode/wpcli-localwp-setup/main/wpcli-localwp-setup  && bash wpcli-localwp-setup && rm -rf ./wpcli-localwp-setup
```

## add mysql socket from localwp tab database, full url

## menu order in db

```sql
SELECT post_title, post_name, menu_order, ID
FROM wp_posts
WHERE post_type = 'acf-field'
  AND post_parent = (
    SELECT ID FROM wp_posts
    WHERE post_type = 'acf-field-group'
      AND post_name = 'group_uv2mushvbichc'
  )
ORDER BY menu_order, ID
```
