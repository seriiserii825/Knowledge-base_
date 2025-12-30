When you do register new custom post you're using [`register post type`](http://codex.wordpress.org/Function_Reference/register_post_type), right? There are options

```php
'rewrite'            => false,
'query_var'          => false,
'publicly_queryable' => false,
'public'             => false
```

After WordPress documentation:

> **`rewrite`** Triggers the handling of rewrites for this post type. To prevent rewrites, set to false.
>
> **`query_var`** 'false' - Disables query_var key use. A post type cannot be loaded at /?{query_var}={single_post_slug}
>
> **`publicly_queryable`** Whether queries can be performed on the front end as part of parse_request().
>
> **`public`** 'false' - Post type is not intended to be used publicly and should generally be unavailable in wp-admin and on the front end unless explicitly planned for elsewhere.

Now go to **Permalinks Settings** and without changing anything - save change. It will rebuild your "routing".

Such setup will disable your custom post from frontend.
