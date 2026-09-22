<?php
if (!defined('ABSPATH')) exit;

/**
 * WPGlobus Plus's own term_link filter (priority 5) assumes every term has
 * a translated slug configured in wp-admin → WPGlobus Plus → Taxonomies.
 * When it doesn't, it leaves $term->wpglobus unset and then reads
 * $term->wpglobus['slug'][$language] a few lines later, which throws
 * "Trying to access array offset on value of type null" and can even
 * replace the slug in the URL with an empty string.
 *
 * Run before it (priority 4) and pre-fill $term->wpglobus with the term's
 * own slug for every enabled language whenever no translation is configured
 * for it, so WPGlobus Plus's filter has something sane to read instead of
 * null. This only touches the missing fallback — it doesn't override
 * translations that are configured, and doesn't touch WPGlobus's own
 * language-prefix filter.
 */
add_filter('term_link', function ($termlink, $term, $taxonomy) {
  if (!empty($term->wpglobus['slug']) || !class_exists('WPGlobus')) {
    return $termlink;
  }

  $opts = get_option('_wpglobus_plus_taxonomies');
  $has_translation = !empty($opts['taxonomy'][$taxonomy]['term_slug']['term_id_' . $term->term_id]);
  if ($has_translation) {
    return $termlink;
  }

  $term->wpglobus = [
    'slug_source' => '',
    'slug' => [],
  ];
  foreach (WPGlobus::Config()->enabled_languages as $language) {
    $term->wpglobus['slug'][$language] = $term->slug;
  }

  return $termlink;
}, 4, 3);
