<div class="search_form">
	<form action="<?php esc_url( home_url( '/' ) ); ?>" method="POST">
		<input type="text" name="s" value="<?php get_search_query(); ?>" placeholder="Search...">
		<input type="submit" value="Send">
	</form>
	<div class="search-result"></div>
</div>

<?php
add_action( 'wp_ajax_myaction', 'esp_search_ajax_action_callback' );
add_action( 'wp_ajax_nopriv_myaction', 'esp_search_ajax_action_callback' );
function esp_search_ajax_action_callback() {
	/**
	 * Проверяем нонсе из массива пости и из wp_localize script
	 */
	if(!wp_verify_nonce($_POST['nonce'], 'search-nonce')){
		wp_die('Данные пришли с левого адреса');
	}
	$_POST = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING );
	$args = [
		'post_type' => ['post', 'product'],
		'post_status' => 'public',
		's' => $_POST['s'],
	];

	$query_ajax = new WP_Query($args);
	?>
	<?php if($query_ajax->have_posts()): ?>
		<?php while($query_ajax->have_posts()): ?>
			<?php $query_ajax->the_post(); ?>
			<h3 class="title-search"><?php the_title(); ?></h3>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	<?php endif; ?>

<?php
    wp_die();
}
?>
<script>
	$('.search_form input[name="s"]').on('keyup', function () {
		let value = $(this).val();
		if (value.length < 2) {
			return false;
		}
		let data = {
			s: value,
			action: 'myaction',
			nonce: search_form.nonce

		};
		jQuery.ajax({
			type: 'POST',
			url: search_form.url,
			data: data,
			dataType: 'html',
			success: function (data) {
				$('.search_form .search-result').html(data);
			}
		});

	});
</script>
