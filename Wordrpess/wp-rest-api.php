!!!! Warning !!!!
After create new url, need to save permalinks
//rest-api.php
<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
function blog_register_search()
{
    register_rest_route('blog/v1', 'search', [
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'blogSearchResults',
    ]);
}

add_action('rest_api_init', 'blog_register_search');
function blogSearchResults($data)
{
    $tipo = $data['tipo'];
    $per_page = $data['per_page'];

    $blog_result = [];

    function getTax($value, $slug, $value_type = 'id')
    {
        return [
            'taxonomy' => $slug,
            'field' => $value_type,
            'terms' => $value,
        ];
    }

    $tax_query = ['relation' => 'AND'];

    if (!empty($tipo)) {
        $tax_query[] = getTax($tipo, 'type', 'id');
    }

    $blog = new WP_Query([
        'post_type' => 'blog',
        'posts_per_page' => $per_page,
        'tax_query' => [
            $tax_query
        ],
    ]);

    while ($blog->have_posts()) {
        $blog->the_post();
        $slug = basename(get_permalink(get_the_ID()));

        $blog_result[] = [
            'id' => get_the_ID(),
            'title' => html_entity_decode(get_the_title()),
            'url' => get_the_permalink(),
            'img' => get_the_post_thumbnail_url(get_the_ID(), 'full'),
            'type' => get_the_terms(get_the_ID(), 'type')[0]->name,
            'text' => get_the_content(),
            'slug' => $slug
        ];
    }

    return [
        "blogs" => $blog_result,
        "tipo" => $tipo,
        "total" => $blog->found_posts
    ];
}

// v-search.php ==================================
<?php $search = get_field( 'search' ); ?>
<div class="search" id="search">
	<img src="<?php echo $search['image']; ?>" class="search__bg" alt="">
	<div class="search__content">
		<input type="text" v-model="input" @input="searchProducts" placeholder="<?php echo $search['placeholder']; ?>">
		<button>
			<svg width="43"
			     height="43"
			     viewBox="0 0 43 43"
			     fill="none"
			     xmlns="http://www.w3.org/2000/svg">
				<path d="M42.2245 38.4771L32.3364 28.5878C37.5 21.5858 36.8938 11.5381 30.6063 5.25108C27.2189 1.86503 22.7164 0 17.9278 0C13.1388 0 8.6367 1.86503 5.25153 5.25108C1.86503 8.63803 0 13.1396 0 17.9278C0 22.7164 1.86503 27.2184 5.25153 30.6058C8.63714 33.9923 13.1392 35.8574 17.9287 35.8574C21.8046 35.8574 25.5192 34.6206 28.5914 32.3395L38.4771 42.2236C38.9777 42.7245 39.6431 43 40.3506 43C41.0602 43 41.727 42.7228 42.2218 42.2258C42.7232 41.7257 42.9996 41.0602 43 40.3519C43.0004 39.6436 42.725 38.9777 42.2245 38.4771ZM17.9278 5.29928C21.3006 5.29928 24.4718 6.61294 26.8576 8.99883C29.2387 11.3794 30.5501 14.5506 30.5501 17.9278C30.5501 21.305 29.2387 24.4766 26.8572 26.8576C24.4722 29.2431 21.301 30.5568 17.9278 30.5568C14.555 30.5568 11.3838 29.2431 8.99794 26.8576C6.61249 24.4731 5.29884 21.3019 5.29884 17.9278C5.29884 14.555 6.61249 11.3838 8.99794 8.99883C11.3843 6.61338 14.5554 5.29928 17.9278 5.29928Z"
				      fill="#1D1D1B"/>
			</svg>
		</button>
        <transition-group tag="ul" class="search__list" name="item">
            <li v-for="({url, title, img}) in filtered" :key="url">
                <a :href="url">
                    <img :src="img" alt="">
                    <h3>{{ title }}</h3>
                </a>
            </li>
        </transition-group>
	</div>
</div>

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

//search.css ==============
<style>
.item-enter-active,
.item-leave-active {
  transition: opacity .4s;
}

.item-enter,
.item-leave-to {
  opacity: 0;
}
</style>
