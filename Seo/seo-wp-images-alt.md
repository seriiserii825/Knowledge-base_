# WordPress: auto-generate image alt & title (PHP)

Hook into upload and save alt (and cleaned title) into the image meta. It's stored in the Media Library permanently, so ACF `$img['alt']`, `wp_get_attachment_image()` etc. pick it up automatically.

## Auto-generate alt + title on upload

`functions.php`:

```php
add_action('add_attachment', function ($attachment_id) {
    if (!wp_attachment_is_image($attachment_id)) return;

    $attachment = get_post($attachment_id);

    // 1. Clean title from filename: "my_red-car-2024.jpg" -> "My red car 2024"
    $name  = pathinfo(get_attached_file($attachment_id), PATHINFO_FILENAME);
    $name  = preg_replace('/-\d+x\d+$/', '', $name);     // remove "-300x200"
    $name  = preg_replace('/-scaled$/', '', $name);      // remove "-scaled"
    $name  = preg_replace('/[-_]+/', ' ', $name);        // dashes/underscores -> spaces
    $name  = preg_replace('/\s+/', ' ', trim($name));
    $title = ucfirst(mb_strtolower($name));

    // 2. If uploaded from a page/post edit screen, use that page's title
    $parent_title = $attachment->post_parent ? get_the_title($attachment->post_parent) : '';

    $alt = $title;
    if ($parent_title && stripos($title, $parent_title) === false) {
        $alt = $parent_title . ' - ' . $title;           // "About us - Team photo"
    }

    // Save title (post_title)
    wp_update_post([
        'ID'         => $attachment_id,
        'post_title' => sanitize_text_field($title),
    ]);

    // Save alt (only if empty)
    if (!get_post_meta($attachment_id, '_wp_attachment_image_alt', true)) {
        update_post_meta($attachment_id, '_wp_attachment_image_alt', sanitize_text_field($alt));
    }
});
```

- **Title**: filename, cleaned (`IMG_hero-banner.jpg` → "Img hero banner")
- **Alt**: same; if uploaded from a page's edit screen (e.g. ACF image field) — page title is prepended: "Contact - Hero banner"
- Never overwrites an alt that's already set

Optional — also fill caption/description, add to the `wp_update_post` array:

```php
'post_excerpt' => $alt,   // caption
'post_content' => $alt,   // description
```

## Bulk-fill existing images (run once)

The hook only works for new uploads. For old images — add to `functions.php`, open `yoursite.com/wp-admin/?fill_alts=1` as admin, then **remove it**:

```php
add_action('admin_init', function () {
    if (empty($_GET['fill_alts']) || !current_user_can('manage_options')) return;

    $ids = get_posts([
        'post_type'      => 'attachment',
        'post_mime_type' => 'image',
        'posts_per_page' => -1,
        'fields'         => 'ids',
    ]);

    $count = 0;
    foreach ($ids as $id) {
        if (get_post_meta($id, '_wp_attachment_image_alt', true)) continue;

        $title  = get_the_title($id);
        $parent = wp_get_post_parent_id($id);
        $alt    = $parent ? get_the_title($parent) . ' - ' . $title : $title;

        update_post_meta($id, '_wp_attachment_image_alt', sanitize_text_field($alt));
        $count++;
    }
    wp_die("Done: alt added to $count images.");
});
```

## Tip

Filenames like `IMG_4532.jpg` produce useless alts ("Img 4532"). Rename files before upload (`red-sofa-living-room.jpg`) and the generated alts will be good.
