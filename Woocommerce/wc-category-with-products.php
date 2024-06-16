<?php
$terms = get_terms([
	'taxonomy'   => 'product_cat',
	//	'orderby' => 'meta_value_num',
	'hide_empty' => false,
]);
?>
<?php foreach ($terms as $term) : ?>
	<?php
	$bg_color                       = get_field('colore_categoria_prodotto', $term) ? get_field('colore_categoria_prodotto', $term) : '';
	$sottotitolo_categoria_prodotto = get_field('sottotitolo_categoria_prodotto' . get_lang(), $term) ? get_field('sottotitolo_categoria_prodotto' . get_lang(), $term) : '';
	$titolo_categoria_prodotto      = get_field('titolo_categoria_prodotto' . get_lang(), $term) ? get_field('titolo_categoria_prodotto' . get_lang(), $term) : '';
	?>
	<div class="products-block" style="background-color: <?php echo $bg_color; ?>">
		<?php if ($titolo_categoria_prodotto) : ?>
			<h2 class="products-block__title"><?php echo $titolo_categoria_prodotto; ?></h2>
		<?php endif; ?>

		<div class="products-block__wrap">
			<div class="products-block__content">
				<em><?php echo $sottotitolo_categoria_prodotto; ?></em>
				<h3><?php echo $term->name; ?></h3>
				<p><?php echo $term->description; ?></p>
			</div>
			<?php woocommerce_product_loop_start(); ?>
			<?php
			$term_id = $term->term_id;
			$args    = array(
				'post_type'      => 'product',
				'post_status'    => 'publish',
				//	                'ignore_sticky_posts' => 1,
				'posts_per_page' => 2,
				'tax_query'      => array(
					array(
						'taxonomy' => 'product_cat',
						'field'    => 'term_id', //This is optional, as it defaults to 'term_id'
						'terms'    => $term_id,
						'operator' => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
					),
				)
			);
			?>
			<?php $products = new WP_Query($args); ?>
			<?php if ($products->have_posts()) : ?>
				<?php while ($products->have_posts()) : ?>
					<?php $products->the_post(); ?>
					<?php
					$product = get_product($loop->post);
					echo $product->get_price_html();
					?>
					<?php wc_get_template_part('content', 'product'); ?>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>

			<?php woocommerce_product_loop_end(); ?>
		</div>
	</div>
<?php endforeach; ?>
