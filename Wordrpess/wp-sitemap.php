<?php
/* function to create sitemap.xml file in root directory of site  */
// add_action("publish_post", "eg_create_sitemap");
// add_action("publish_page", "eg_create_sitemap");
// add_action("save_post", "eg_create_sitemap");
add_action("init", "eg_create_sitemap");
function eg_create_sitemap()
{
    $postsForSitemap = get_posts(array(
        'numberposts' => -1,
        'orderby'     => 'modified',
        'post_type'   => array('post', 'page'),
        'order'       => 'DESC'
    ));

    $adsForSitemap = getPropertiesId();
    $date = new DateTime();

    $sitemap = '<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/css" href="' . get_template_directory_uri() . '/helpers/sitemap.css"?>';
    $sitemap .= "\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    foreach ($postsForSitemap as $post) {
        setup_postdata($post);
        $postdate = explode(" ", $post->post_modified);
        $sitemap .= "\t" . '<url>' . "\n" .
            "\t\t" . '<loc>' . get_permalink($post->ID) . '</loc>' .
            "\n\t\t" . '<lastmod>' . $postdate[0] . '</lastmod>' .
            "\n\t\t" . '<changefreq>monthly</changefreq>' .
            "\n\t" . '</url>' . "\n";
    }
    foreach ($adsForSitemap as $item) {
        setup_postdata($post);
        $sitemap .= "\t" . '<url>' . "\n" .
            "\t\t" . '<loc>' . get_home_url() . '/ads?id=' . $item->id . '</loc>' .
            "\n\t\t" . '<lastmod>' . $item->updated_at . '</lastmod>' .
            "\n\t\t" . '<changefreq>monthly</changefreq>' .
            "\n\t" . '</url>' . "\n";
    }
    $sitemap .= '</urlset>';
    $fp = fopen(ABSPATH . "sitemap.xml", 'w');
    fwrite($fp, $sitemap);
    fclose($fp);
}


function getPropertiesId()
{

	$result = [];
	$api_result = callAPI('https://api.bludelego.it/api/realestate/v1/immobili/all', 'get');
	// $api_result_all = callAPI('https://api.bludelego.it/api/realestate/v1/all');
	$list_json = json_decode($api_result);
	$result = $list_json->data;
	// foreach ($list as $item) {
	// 	$result[] = $item->id;
	// }

	return $result;
}?>

//sitemap.css
<style>
title {
  display: block;
  margin-top: 2rem;
  margin-bottom: 1rem;
  margin-left: 3rem;
  font-size: 1.5rem;
  font-weight: bold;
  border-bottom: 1px solid #000;
}
url {
  display: block;
  padding: 0.2rem 3rem;
}
loc {
  /* display: block; */
  color: black;
}
lastmod {
  /* display: block; */
  color: green;
}
changefreq {
  /* display: block; */
  color: blue;
}
</style>

robots.txt

User-agent: *
Disallow: /wp-admin/
Allow: /wp-admin/admin-ajax.php

Sitemap: https://www.imprendocasa.it/sitemap.xml
