<?php do_action( 'woocommerce_before_main_content' ); ?>
    <?php woocommerce_product_loop_start(); ?>
            <?php wc_get_template_part( 'content', 'product' ); ?>
    <?php woocommerce_product_loop_end(); ?>
<?php do_action( 'woocommerce_after_main_content' ); ?>
