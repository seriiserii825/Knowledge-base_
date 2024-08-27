<?php
// generate sitemap just for get request

if(isset($_GET['sitemap111'])){
 $sitemap111 =  $_GET['sitemap111'];
 if($sitemap111 == 'true'){
   require __DIR__ . '/../helpers/sitemap.php';
 }	
}

/* function to create sitemap.xml file in root directory of site  */
// add_action("publish_post", "eg_create_sitemap");
// add_action("publish_page", "eg_create_sitemap");
// add_action("save_post", "eg_create_sitemap");
//
// disable sitemap in rank-math general settings
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


// bludelego
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
}

// bludelego foreach properties
function getPropertiesId()
{
    $api_result = callAPI('https://api.bludelego.it/api/realestate/v1/immobili', 'post');
    $list_json = json_decode($api_result);
    $properties = [];
    $pages = $list_json->data->pages;

    for ($i = 1; $i <= $pages; $i++) {
        $api_result = callAPI('https://api.bludelego.it/api/realestate/v1/immobili', 'post', 'page=' . $i . '&order_by=date_insert_desc&auction=0');
        $list_json = json_decode($api_result);
        $properties = array_merge($properties, $list_json->data->immobili_list);
    }

    return $properties;
}

// bludelego with foreach =========================================
function getPropertiesId()
{
    $api_result = callAPI('https://api.bludelego.it/api/realestate/v1/immobili', 'post');
    $list_json = json_decode($api_result);
    $properties = [];
    $pages = $list_json->data->pages;

    for ($i = 1; $i <= $pages; $i++) {
        $api_result = callAPI('https://api.bludelego.it/api/realestate/v1/immobili', 'post', 'page=' . $i . '&order_by=date_insert_desc&auction=0');
        $list_json = json_decode($api_result);
        $properties = array_merge($properties, $list_json->data->immobili_list);
    }

    return $properties;
}

foreach ($adsForSitemap as $item) {
        $id = $item->id;
        $url = '';
        $titolo = $item->titolo;
        $titolo = strtolower($titolo);
        $localita = $item->localita;
        $localita = strtolower($localita);
        $url = $id . '-' . $titolo . '-' . $localita;
        $url = str_replace(' ', '-', $url);
        $url = str_replace('(', '', $url);
        $url = str_replace(')', '', $url);
        $date = date("Y-m-d");
        $sitemap .= "\t" . '<url>' . "\n" .
            "\t\t" . '<loc>'.get_home_url().'/annunci-immobiliari/'.$url.'</loc>' .
            "\n\t\t" . '<lastmod>' . $date . '</lastmod>' .
            "\n\t\t" . '<changefreq>monthly</changefreq>' .
            "\n\t" . '</url>' . "\n";
}


// agim online ========================================================
function getPropertiesId()
{
  $api_result = callAPI('all_properties', 'https://api.agimonline.com/v1/properties/list/');
  $list_json = json_decode($api_result);
  $pages = $list_json->response->pages;
  $properties = [];

  for ($i = 1; $i <= $pages; $i++) {
    $api_result = callAPI('all_properties', 'https://api.agimonline.com/v1/properties/list/', 'page=' . $i . '&order_by=date_insert_desc&auction=0');
    $list_json = json_decode($api_result);
    $properties = array_merge($properties, $list_json->properties);
  }

  return $properties;
}


//agim online class
public function getPropertiesId()
{
    $api_result = $this->getPropertiesList();
    $list_json = json_decode($api_result);
    $pages = $list_json->response->pages;
    $properties = [];

    for ($i = 1; $i <= $pages; $i++) {
        $parameters = [];
        $parameters['page'] = $i;
        $api_result = $this->getPropertiesList($parameters);
        $list_json = json_decode($api_result);
        $properties = array_merge($properties, $list_json->properties);
    }

    return $properties;
}

//
$agim = new AgimAPIClient([]);
$adsForSitemap = $agim->getPropertiesId();
foreach ($adsForSitemap as $item) {
    setup_postdata($item);
    $date = date('Y-m-d');
    $local_title = $item->typology->type . " " . $item->location->city;
    $cleared_title = createUrl($local_title);
    $url = '/immobile/' . $item->id . '-abitare-' . $cleared_title;
    $sitemap .= "\t" . '<url>' . "\n" .
        "\t\t" . '<loc>https://abitareggioemilia.it' . $url . '</loc>' .
        "\n\t\t" . '<lastmod>' . $date . '</lastmod>' .
        "\n\t\t" . '<changefreq>monthly</changefreq>' .
        "\n\t" . '</url>' . "\n";
}
?>

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
