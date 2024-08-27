<?php

// no index
// go to page front in wp
// at top bar select rank_math -> mark this page -> no index
// check in source code name="robots" content="noindex, follow"

function SinglePageMeta($data)
{
	global $title, $image, $site_title, $description, $url;
	$title = isset($data->titolo) ? $data->titolo : '';
	$site_title = isset($data->titolo) ? get_bloginfo('name') . ' | ' . $data->titolo : get_bloginfo('name');
	$description = isset($data->disposizione_interna) ? $title . ' | ' . $data->disposizione_interna : '';
	$url = (site_url() . '/ads/?id=' . strval($data->id));
	$image = $data->foto_list[0]->nome;
	//	var_dump( $image );
	//exit();
	add_filter('rank_math/frontend/title', function () {
		global $title;
		return $title;
	});
	add_filter('rank_math/frontend/description', function () {
		global $description;
		return $description;
	});
	add_filter('rank_math/frontend/canonical', function () {
		global $url;
		return $url;
	});
	add_filter('rank_math/opengraph/url', function () {
		global $url;
		return $url;
	});
	add_filter('wpseo_canonical', function () {
		global $url;
		return $url;
	});
	add_filter("rank_math/opengraph/facebook/image", function ($image) {
		global $image;
		return $image;
	});
	add_filter("rank_math/opengraph/facebook/og_title", function () {
		global $title;
		return $title;
	});
}

