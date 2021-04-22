<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product;
?>
<div class="products-block__item">
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>

    <div class="products-block__text">
		<?php do_action( 'woocommerce_shop_loop_item_title' ); ?>
    </div>

<!--	--><?php //do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
</div>
