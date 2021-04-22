function university_custom_rest() {
	register_rest_field( 'post', 'authorName', [
		'get_callback' => function () {
			return get_the_author();
		}
	] );
}
add_action( 'rest_api_init', 'university_custom_rest' );
