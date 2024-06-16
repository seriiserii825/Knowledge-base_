<div class="product-categories-custom">
	<?php
	$product_categories = get_terms( 'product_cat', [
		'orderby'    => 'name',
		'order'      => 'ASC',
		'hide_empty' => true
	] );
	?>
	<?php if ( ! empty( $product_categories ) ): ?>
        <div class="container">
            <ul>
				<?php foreach ( $product_categories as $key => $category ): ?>
					<?php $thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true ); ?>
                    <li>
                        <a href="<?php echo get_term_link( $category ) ?>">
                            <div class="product-categories-custom">
                                <img src="<?php echo kama_thumb_src( 'w=840 &h=400 &attach_id=' . $thumbnail_id . '' ); ?>" alt="">
                            </div>
                            <h3 class="product-categories-custom__title"><?php echo $category->name; ?></h3>
                        </a>
                    </li>
				<?php endforeach; ?>
            </ul>
        </div>
	<?php endif; ?>
</div>
