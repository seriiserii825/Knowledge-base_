<?php
$labels = array( /*removed for example*/ );

$args = array(
    'labels'             => $labels,
    'description'        => __( 'Description.', 'your-plugin-textdomain' ),
    'public'             => false,
    'show_ui'            => true,
    'rewrite'            => false,
    'capability_type'    => 'post',
    'hierarchical'       => false,
    /* ... Any other arguments like menu_icon, and so on */
    'supports'           => array( /* list of supported fields */ )
);

register_post_type( 'customer', $args );
