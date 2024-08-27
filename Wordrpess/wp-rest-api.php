<?php
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}
function filterProducts()
{
  register_rest_route('products-filter/v1', 'products', [
    'methods' => WP_REST_SERVER::READABLE,
    'callback' => 'filterProductsApi',
  ]);
}

add_action('rest_api_init', 'filterProducts');

function filterProductsApi($data)
{
  $current_page = $data['current_page'];
  $posts_per_page = 6;
  $offset = ($current_page * $posts_per_page) - $posts_per_page;
  $query_options = [
    'post_type' => 'prodotti',
    'posts_per_page' => $posts_per_page,
    'offset' => $offset,
  ];

  $term_slug = isset($data['term_slug']) && !empty($data['term_slug']) ? $data['term_slug'] : null;

  if ($term_slug) {
    $query_options['tax_query'] = [
      [
        'taxonomy' => 'categorie',
        'field'    => 'slug',
        'terms'    => $term_slug,
      ]
    ];
  }
  $height = (int)$data['height'];
  $width = (int)$data['width'];
  $depth = (int)$data['depth'];

  $query_options['meta_query'] = ['relation' => 'AND'];
  if ($height) {
    $query_options['meta_query'][] = [
      'key' => 'single_product_altezza',
      'value' => $height,
    ];
  }

  if ($width) {
    $query_options['meta_query'][] = [
      'key' => 'single_product_larghezza',
      'value' => $width,
    ];
  }
  if ($depth) {
    $query_options['meta_query'][] = [
      'key' => 'single_product_profondita',
      'value' => $depth,
    ];
  }
  $search = isset($data['search']) && !empty($data['search']) ? $data['search'] : null;
  if ($search) {
    $query_options['s'] = $search;
  }

  $products = new WP_Query($query_options);
  $products_list = $products->posts;
  $products_posts = array_map(function ($item) {
    $id = $item->ID;
    $single_product = get_field('single_product', $id);
    $gallery = isset($single_product['gallery']) ? $single_product['gallery'] : [];

    return [
      'id' => $id,
      'title' => $item->post_title,
      // 'slug' => get_post_field('post_name', $id),
      'image' => get_the_post_thumbnail_url($id),
      'gallery' => $gallery,
    ];
  }, $products_list);

  //  $products_list = $product
  $total_products = $products->found_posts;
  $total_items = count($products_posts);

  return [
    'filtered_products_count' => $total_items,
    'all_products_count' =>  $total_products,
    'query_options' => $query_options,
    'width' => $width,
    'height' => $height,
    'term_slug' => $term_slug,
    'products' => $products_posts,
    'posts_per_page' => $posts_per_page,
  ];
}
?>
// v-search.php ==================================
<script>
const appSearch = new Vue({
  el: "#search",
  data: {
    filtered: [],
    input: ''
  },
  methods: {
    searchProducts(){
      const home_url = window.location.origin;
      
      if(this.input.length > 2){
        fetch(home_url+'/wp-json/products/v1/search?term='+this.input.toLowerCase())
          .then(response => response.json())
          .then(res => {
            this.filtered = res;
          })
          .catch(error => console.log(error, 'error'))
      }else{
        this.filtered = [];
      }
    }
  }
});

</script>
