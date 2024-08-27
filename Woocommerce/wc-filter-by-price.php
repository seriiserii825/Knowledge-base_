
<?php switch ($_POST['categoryText']){
case 'price':
  $args = array(
    'post_type'      => 'product',
    'orderby'        => 'meta_value_num',
    'order'          => 'asc',
    'meta_key'       => '_price'
  );
  break;
case 'price-desc':
  $args = array(
    'post_type'      => 'product',
    'orderby'        => 'meta_value_num',
    'order'          => 'desc',
    'meta_key'       => '_price'
  );
  break;
case 'rating':
  $args = array(
    'post_type'      => 'product',
    'orderby'        => 'meta_value_num',
    'order'          => 'desc',
    'meta_key'       => '_wc_average_rating'
  );
  break;
case 'popularity':
  $args = array(
    'post_type'      => 'product',
    'orderby'        => 'meta_value_num',
    'order'          => 'desc',
    'meta_key'       => 'total_sales'
  );
  break;
case 'date':
  $args = array(
    'post_type'      => 'product',
    'order'          => 'desc',
  );
  break;
            }
$loop = new WP_Query( $args );
if ( $loop->have_posts() ) {
  while ( $loop->have_posts() ) : $loop->the_post();
  if(has_post_thumbnail( get_the_ID() )) { 
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ));
?>
        <img src="<?php echo $image[0]; ?>">
        <?php } else { ?>
        <img src="<?php echo plugins_url().'/woocommerce/assets/images/placeholder.png';?>">
        <?php } ?>
        <a href="<?php echo the_permalink(get_the_ID());?>" title="<?php echo get_the_title();?>"><?php echo get_the_title();?></a>
<?php endwhile;
}
wp_reset_postdata();
