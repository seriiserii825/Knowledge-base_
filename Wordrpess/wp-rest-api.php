<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
function eventsApi()
{
    register_rest_route('events/v1', 'page', [
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'eventsApiFunc',
    ]);
}

add_action('rest_api_init', 'eventsApi');
function eventsApiFunc()
{
    $page_intro = get_field('page_intro', 42);
    $events_filter = get_field('events_filter', 42);
    $events_terms = get_terms([
        'taxonomy' => 'events_category',
        'hide_empty' => true,
    ]);
    $events_terms = array_map(function ($term) {
        $id = $term->term_id;
        $name = $term->name;
        $title_ro = get_field('title_ro', $term);
        $slug = $term->slug;
        return [
            'id' => $id,
            'name' => $name,
            'title_ro' => $title_ro,
            'slug' => $slug,
        ];
    }, $events_terms);
    $events = get_field('events', 2);
    $button_text = $events['button_text'];
    $featured_button_left_text = $events['featured_button_left_text'];
    $featured_button_right_text = $events['featured_button_right_text'];
    $post_events = new WP_Query(array(
        'post_type' => 'events',
        'order' => 'ASC',
        'posts_per_page' => 3,
    ));
    $events_array = $post_events->get_posts();
    $events_array = array_map(function ($event) {
        $id = $event->ID;
        $title = get_the_title($id);
        $term = get_the_terms($id, 'events_category')[0];
        $location = get_field('short_title' . get_lang(), $term) ?? $term->name;
        $loop = get_field('loop', $id);
        $event_date = $loop['event_date'];
        $short_description = $loop['short_description'];
        $image = get_the_post_thumbnail_url($id);
        return [
            'id' => $id,
            'title' => $title,
            'location' => $location,
            'event_date' => $event_date,
            'short_description' => $short_description,
            'image' => $image,
        ];
    }, $events_array);
    return [
        'page_intro' => $page_intro,
        'events_terms' => $events_terms,
        'events_props' => [
            'button_text' => $button_text,
            'featured_button_left_text' => $featured_button_left_text,
            'featured_button_right_text' => $featured_button_right_text
        ],
        'events' => $events_array,
        'events_filter' => $events_filter,
    ];
}

function eventsApiPosts()
{
    register_rest_route('events/v1', 'posts', [
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'eventsApiPostsFunc',
    ]);
}

add_action('rest_api_init', 'eventsApiPosts');
function eventsApiPostsFunc($data)
{
    $term_slug = $data['term_slug'];
    $date = $data['date'];
    $now = date('Y-m-d');
    $current_page = $data['current_page'];

    if ($date) {
        if ($date === 'coming-soon') {
            $meta_query = array(
                array(
                    'key' => 'loop_event_date',
                    'value' => $now,
                    'compare' => '>',
                    'type' => 'DATE'
                )
            );
        } else if ($date === 'past-events') {
            $meta_query = array(
                array(
                    'key' => 'loop_event_date',
                    'value' => $now,
                    'compare' => '<',
                    'type' => 'DATE'
                )
            );
        } else {
            $meta_query = array(
                array(
                    'key' => 'loop_event_date',
                    'value' => $date,
                    'compare' => 'LIKE'
                )
            );
        }
    }

    $post_type = 'events';
    $order = 'ASC';
    $posts_per_page = 3;
    $offset = ($current_page * $posts_per_page) - $posts_per_page;

    if ($term_slug && $date) {
        $post_events = new WP_Query(array(
            'post_type' => $post_type,
            'order' => $order,
            'posts_per_page' => $posts_per_page,
            'offset' => $offset,
            'tax_query' => array(
                array(
                    'taxonomy' => 'events_category',
                    'field' => 'slug',
                    'terms' => $term_slug,
                )
            ),
            'meta_query' => $meta_query
        ));
    } else if($term_slug) {
        $post_events = new WP_Query(array(
            'post_type' => $post_type,
            'order' => $order,
            'posts_per_page' => $posts_per_page,
            'offset' => $offset,
            'tax_query' => array(
                array(
                    'taxonomy' => 'events_category',
                    'field' => 'slug',
                    'terms' => $term_slug,
                )
            ),
        ));
    } else if($date) {
        $post_events = new WP_Query(array(
            'post_type' => $post_type,
            'order' => $order,
            'posts_per_page' => $posts_per_page,
            'offset' => $offset,
            'meta_query' => $meta_query
        ));
    } else {
        $post_events = new WP_Query(array(
            'post_type' => $post_type,
            'order' => $order,
            'posts_per_page' => $posts_per_page,
            'offset' => $offset,
        ));
    }
    $events_array = $post_events->get_posts();
    $events_array = array_map(function ($event) {
        $id = $event->ID;
        $title = get_the_title($id);
        $term = get_the_terms($id, 'events_category')[0];
        $location = get_field('short_title' . get_lang(), $term) ?? $term->name;
        $loop = get_field('loop', $id);
        $event_date = $loop['event_date'];
        $short_description = $loop['short_description'];
        $image = get_the_post_thumbnail_url($id);
        return [
            'id' => $id,
            'title' => $title,
            'location' => $location,
            'event_date' => $event_date,
            'short_description' => $short_description,
            'image' => $image,
        ];
    }, $events_array);
    $total_posts = $post_events->found_posts;
    $count = count($events_array);
    $pages = $post_events->max_num_pages;
    return [
        'total' => $total_posts,
        'count' => $count,
        'pages' => $pages,
        'current_page' => $current_page,
        'events' => $events_array,
    ];
}?>

// v-search.php ==================================
<script>
const appSearch = new Vue({
  el: "#search",
  data: {
    filtered: [],
    input: ''
  },
  methods: {
    searchProducts(){
      const home_url = window.location.origin;
      
      if(this.input.length > 2){
        fetch(home_url+'/wp-json/products/v1/search?term='+this.input.toLowerCase())
          .then(response => response.json())
          .then(res => {
            this.filtered = res;
          })
          .catch(error => console.log(error, 'error'))
      }else{
        this.filtered = [];
      }
    }
  }
});

</script>
