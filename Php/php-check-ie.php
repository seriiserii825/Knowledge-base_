	if ( strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE' ) !== false || strpos( $_SERVER['HTTP_USER_AGENT'], 'rv:11.0' ) !== false ) {
		$some = '';
	} else {
		wp_enqueue_script( 'bs-zuccato-gsap', get_template_directory_uri() . '/assets/libs/gsap/gsap.min.js', [ 'jquery' ], null, true );
		wp_enqueue_script( 'bs-zuccato-gsap-scroll', get_template_directory_uri() . '/assets/libs/gsap/ScrollTrigger.min.js', [ 'jquery' ], null, true );
		wp_enqueue_script( 'bs-zuccato-gsap-lazy', get_template_directory_uri() . '/assets/libs/jquery.lazy.min.js', [ 'jquery' ], null, true );
	}
