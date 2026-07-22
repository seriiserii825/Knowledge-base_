<?php
if (!defined('ABSPATH')) exit;

function filterHeaderApi()
{
  register_rest_route('site/v1', '/filter-header', [
    'methods'             => WP_REST_SERVER::READABLE,
    'permission_callback' => '__return_true',
    'callback' => 'filterHeaderApiData',
    'args' => [
      'page_id' => [
        'required'          => true,
        'type'              => 'integer',
        'validate_callback' => function ($value) {
          return is_numeric($value);
        },
      ],
    ],
  ]);
}
add_action('rest_api_init', 'filterHeaderApi');

function filterHeaderApiData(WP_REST_Request $req): WP_REST_Response
{
  $data = [];
  $page_id = $req->get_param('page_id');
  $filter_header = get_field('filter_header', $page_id);
  $data['filter_header'] = $filter_header;

  return rest_ensure_response($data);
}
