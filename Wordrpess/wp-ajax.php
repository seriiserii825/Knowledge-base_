https://wpruse.ru/finty-ushami/wordpress-contact-form-to-ajax/
<?php
function true_localize_example() {
	wp_enqueue_script( 'truescript', get_template_directory_uri() . '/js/ajax.js', [], null, false );
	wp_localize_script( 'truescript', 'true_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'true_localize_example' );
add_action( 'wp_ajax_get_immobiles', 'get_immobiles_handler' );
add_action( 'wp_ajax_nopriv_get_immobiles', 'get_immobiles_handler' );
function get_immobiles_handler() {
	$errors = [];
	if ( count( $errors ) == 0 ) {
		//        vardump($_REQUEST['pageNumber']);
		echo GetProperties( $_REQUEST['pageNumber'] );
		//        echo GetLocations();
	} else {
		wp_send_json( [
			'status' => 'error',
			'errors' => $errors
		], 200 );
	}
	die;
}
?>
<script>
  pageNext()
  {
    if (this.currentPage !== this.pages) {
      const prevPage = Number(this.currentPage) + 1;
      const url = true_object.ajax_url;

      fetch(url, {
          method: 'POST',
          credentials: 'same-origin',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: 'action=get_immobiles&pageNumber=' + prevPage
        }
      )
        .then((resp) => resp.json())
        .then((resp) => {
          this.currentPage = resp.data.current_page;
          this.filtered = resp.data.immobili_list;
        });
    } else {
      this.currentPage = this.pages;
    }
  }
  ,
</script>
