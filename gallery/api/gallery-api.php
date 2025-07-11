<?php
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}
function page_register_gallery()
{
  register_rest_route('gallery/v1', 'all', [
    'methods' => WP_REST_SERVER::READABLE,
    'callback' => 'pageSearchResults',
  ]);
}

add_action('rest_api_init', 'page_register_gallery');
function pageSearchResults()
{
  $gallery_page_id = 434;
  $custom_gallery = get_field('custom_gallery', $gallery_page_id);
  $title = $custom_gallery['title'];
  $gallery = $custom_gallery['gallery'];
  $per_page = $custom_gallery['per_page'];
  return [
    "title" => $title,
    "gallery" => $gallery,
    "per_page" => $per_page,
  ];
}

