<?php
// http://youdomain.com/wp-json/wp/v2/all-terms?term=you_taxonomy
class all_terms
{
    public function __construct()
    {
        $version = '2';
        $namespace = 'wp/v' . $version;
        $base = 'all-terms';
        register_rest_route($namespace, '/' . $base, array(
            'methods' => 'GET',
            'callback' => array($this, 'get_all_terms'),
        ));
    }

    public function get_all_terms($object)
    {
// $return['categories'] = get_terms('category');
//        $return['tags'] = get_terms('post_tag');
        $return = get_terms( [
            'taxonomy' => $_GET['term'],
            'hide_empty' => false,
        ] );
//        $taxonomies = get_taxonomies($args, $output, $operator);
//        foreach ($taxonomies as $key => $taxonomy_name) {
//            if ($taxonomy_name = $_GET['term']) {
//                $return[] = get_terms($taxonomy_name);
//            }
//        }
        return new WP_REST_Response($return, 200);
    }
}

add_action('rest_api_init', function () {
    $all_terms = new all_terms;
});
