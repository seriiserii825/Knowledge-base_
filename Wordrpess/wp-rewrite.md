## change post type
function custom_rewrite_rules() {
    add_rewrite_rule('^people/([^/]+)/?', 'index.php?post_type=staff&name=$matches[1]', 'top');
}
add_action('init', 'custom_rewrite_rules');
