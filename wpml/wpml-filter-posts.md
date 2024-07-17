## in functions.php
```php
 add_action( 'pre_get_posts', 'add_my_custom_post_type' );

    function add_my_custom_post_type( $query ) {
		
        if (is_category() && $query->is_main_query() ) {
			 $query->set( 'suppress_filters', true);
			return query;
		}
    }
```
