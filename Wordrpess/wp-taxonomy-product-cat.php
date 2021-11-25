<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
get_header();
?>
<div class="taxonomy-page">
    <div class="taxonomy-page__intro">
        <img src="<?php echo site_url('/') . '/wp-content/uploads/2021/10/produsebg.jpg' ?>" alt="Bg">
    </div>
    <div class="taxonomy-page__wrap">
        <div class="taxonomy-page__filters">

            <button class="btn taxonomy-page__menu-toggle">Filtre</button>
            <?php echo do_shortcode( '[woocommerce_product_search]' ) ?>
        </div>
        <div class="taxonomy-page__sidebar">
            <div class="categories-list">
                <div class="categories-list__right">

                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000"
                        xml:space="preserve">
                        <g>
                            <path
                                d="M630.8,497.3l317.1-330.7c35.4-36.9,34.1-95.5-2.8-130.8c-36.8-35.4-95.4-34.1-130.8,2.8L497.2,369.2L189.3,73.9c-36.8-35.4-95.4-34.1-130.8,2.7l-0.1,0.1c-35.3,36.9-34,95.4,2.8,130.7l308,295.3L52.1,833.4c-35.4,36.9-34.1,95.5,2.8,130.8c36.9,35.4,95.5,34.1,130.8-2.7l317.1-330.7l308,295.2c36.8,35.4,95.3,34.1,130.6-2.6l0.3-0.3c35.2-36.9,33.9-95.3-2.9-130.6L630.8,497.3z" />
                        </g>
                    </svg>
                </div>
                <?php
				$terms = get_terms( 'product_cat', [ 'order' => 'ASC', 'hide_empty' => true ] ); ?>
                <ul class="taxonomy-page__list categories-list__list">
                    <?php foreach ( $terms as $term ): ?>
                    <?php if ( $term->parent === 0 ): ?>
                    <li class="categories-list__list-item">

                        <?php
                              $term_id   = $term->term_id;
                              $term_name = $term->name;
                              ?>
                        <a class="<?php echo $term->slug; ?>"
                            href="<?php echo get_term_link( $term_id, 'product_cat' ); ?>">
                            <h2><?php echo $term_name; ?></h2>


                            <svg width="16" height="9" viewBox="0 0 16 9" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M13.7603 0L7.66116 5.83884L1.52479 0.0371901L0 1.56198L7.62397 9L15.3595 1.59917L13.7603 0Z"
                                    fill="white" />
                            </svg>

                        </a>

                        <?php 
                              $catChildren = get_terms(array(
                                    'taxonomy' => 'product_cat',
                                    'parent'    =>$term_id,
                                    'hide_empty'    =>false
                              ));
                              
                              if ( count( $catChildren ) > 0 ) {?>
                        <ul class="categories-list__chld">
                            <?php foreach($catChildren as $child): ?>
                            <li>

                                <a class="<?php echo $child->slug; ?>"
                                    href="<?php echo get_term_link( $child->term_id, 'product_cat' ); ?>">
                                    <h2><?php echo $child->name; ?></h2>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php }?>
                    </li>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="taxonomy-page__content">
            <?php $term = get_queried_object(); ?>

            <ul class="breadcrumb">
                <li class="breadcrumb__item">
                    <a class="breadcrumb__link" href="<?php echo get_page_link( 77 ); ?>">
                        <h2 class="breadcrumb__title">Produsele noastre</h2>
                    </a>
                </li>
                <li class="breadcrumb__item">
                    <h2 class="breadcrumb__title"><?php echo $term->name; ?></h2>
                </li>
            </ul>



            <div class="taxonomy__loop">
                <?php
                  if(!function_exists('wc_get_products')) {
                  return;
                  }
                  
                  $paged                   = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1; // if your custom loop is on a static front page then check for the query var 'page' instead of 'paged', see https://developer.wordpress.org/reference/classes/wp_query/#pagination-parameters
                  $ordering                = WC()->query->get_catalog_ordering_args();
                  $ordering['orderby']     = array_shift(explode(' ', $ordering['orderby']));
                  $ordering['orderby']     = stristr($ordering['orderby'], 'price') ? 'meta_value_num' : $ordering['orderby'];
                  $products_per_page       = apply_filters('loop_shop_per_page', wc_get_default_products_per_row() * wc_get_default_product_rows_per_page());
                  
                  $term_id = $term->term_id;

                  $products_ids            = wc_get_products(array(
                  'status'               => 'publish',
                  'limit'                => $products_per_page,
                  'page'                 => $paged,
                  'paginate'             => true,
                  'return'               => 'ids',
                  'orderby'              => $ordering['orderby'],
                  'order'                => $ordering['order'],
                  'posts_per_page'       => 21,
                  'tax_query'      => array(
                        array(
                              'taxonomy' => 'product_cat',
                              'field'    => 'term_id', //This is optional, as it defaults to 'term_id'
                              'terms'    => $term_id,
                        ),
                  )
                  ));
                  
                  wc_set_loop_prop('current_page', $paged);
                  wc_set_loop_prop('is_paginated', wc_string_to_bool(true));
                  wc_set_loop_prop('page_template', get_page_template_slug());
                  wc_set_loop_prop('per_page', $products_per_page);
                  wc_set_loop_prop('total', $products_ids->total);
                  wc_set_loop_prop('total_pages', $products_ids->max_num_pages);
                  
                  if($products_ids) {
                  do_action('woocommerce_before_shop_loop');
                  woocommerce_product_loop_start();
                        foreach($products_ids->products as $featured_product) {
                        $post_object = get_post($featured_product);
                        setup_postdata($GLOBALS['post'] =& $post_object);
                        wc_get_template_part('content', 'product');
                        }
                        wp_reset_postdata();
                  woocommerce_product_loop_end();
                  do_action('woocommerce_after_shop_loop');
                  } else {
                  do_action('woocommerce_no_products_found');
                  } ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer('simple'); ?>