#url
id-title
4892-title

#function rewrite in functions.php or include
### be carefull for page_id in url, is a static page id
<?php 
function custom_rewrite_rule() {
    add_rewrite_rule('^ads/?([^/]*)/?','index.php?page_id=244&addslug=$matches[1]','top');
}
add_action('init', 'custom_rewrite_rule', 10, 0);

add_filter( 'query_vars', function( $query_vars ) {
    $query_vars[] = 'addslug';
    return $query_vars;
} );

?>

#page code
<?php
global $wp;
$myId = explode('-', basename(home_url($wp->request)))[0];
$response = json_decode(GetSinglePageData($myId));
$data = $response->data[0];
?>
