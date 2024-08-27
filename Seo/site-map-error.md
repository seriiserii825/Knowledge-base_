Here is the solution I found First you create a php file (whitespacefix.php) on the wordpress root dictory with following content.

```xml
<?php
function ___wejns_wp_whitespace_fix($input) {
    $allowed = false;
    $found = false;
    foreach (headers_list() as $header) {
        if (preg_match("/^content-type:\\s+(text\\/|application\\/((xhtml|atom|rss)\\+xml|xml))/i", $header)) {
            $allowed = true;
        }
        if (preg_match("/^content-type:\\s+/i", $header)) {
            $found = true;
        }
    }
    if ($allowed || !$found) {
        return preg_replace("/\\A\\s*/m", "", $input);
    } else {
        return $input;
    }
}
ob_start("___wejns_wp_whitespace_fix");
?>
```

Then open the index.php file and add the following line right after `<?php` tag

```xml
include('whitespacefix.php');
```
