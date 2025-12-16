## in functions.php

```php
add_action('wp_head', function () {
    ?>
<link
  rel="icon"
  href="<?= esc_url(get_stylesheet_directory_uri()); ?>/assets/i/static/favicon-dark.png"
  media="(prefers-color-scheme: light)"
>

<link
  rel="icon"
  href="<?= esc_url(get_stylesheet_directory_uri()); ?>/assets/i/static/favicon-light.png"
  media="(prefers-color-scheme: dark)"
>
<?php
});
```
