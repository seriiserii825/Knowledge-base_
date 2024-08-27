<?php
        $eventDate = new DateTime( get_field( 'event_date' ) );
        echo $eventDate->format( 'M' );
?>

<?php
        $today  = date( 'Ymd' );
        $events = new WP_Query( [
        'posts_per_page' => - 1,
        'post_type'      => 'events',
        'meta_key'       => 'event_date',
        'orderby'        => 'meta_value_num',
        'order'          => 'ASC',
        'meta_query'     => [
          [
            'key' => 'event_date',
                        'compare' => '>=',
                        'value' => $today,
                        'type' => 'numeric'
          ]
        ]
] ); ?>
