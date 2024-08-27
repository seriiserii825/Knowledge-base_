
To translate add  custom field for title and excerpt for description
%customfield(informazioni_generali_nome_principale)%

add_filter('rank_math/opengraph/facebook/og_image', function ($fbimage) {
    global $post;
    if (is_singular('prodotti-in-evidenza')) {
        $img = get_field('info_immagine', $post->ID)['sizes']['desktop']; /* Insert specific field here */
        $fbimage = $img;
    }
    return $fbimage;
});
