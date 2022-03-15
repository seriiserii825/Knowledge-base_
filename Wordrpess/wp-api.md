## vue-filter
<?php $filter = get_field('home')['filter']; ?>
    <div class="vue-filter disable-select" id="app">
        <?php require_once __DIR__ . '/vue-fitler-top.php'; ?>
        <?php require_once __DIR__ . '/vue-filter-order.php'; ?>
        <?php require_once __DIR__ . '/vue-filter-bottom.php'; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <!-- import CSS -->
    <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
    <!-- import JavaScript -->
    <script src="https://unpkg.com/element-ui/lib/index.js"></script>
<?php require_once __DIR__ . '/../vue/vue-counter.php'; ?>
<?php require_once __DIR__ . '/../vue/v-app.php'; ?>

## filter wrap
<div class="vue-filter__item">
    <div class="vue-filter__flex">
        <el-radio @change="getTipo" v-model="tipo" label="3">Vendita</el-radio>
        <el-radio @change="getTipo" v-model="tipo" label="4">Affitto</el-radio>
    </div>
</div>
<div class="vue-filter__item">
    <counter-component label="Locali" @handle_func="getLocali" :value="locali"></counter-component>
</div>
<div class="vue-filter__item">
    <counter-component label="Bagni" @handle_func="getBagni" :value="bagni"></counter-component>
</div>
<div class="vue-filter__item">
    <div class="vue-filter__flex vue-filter__select">
        <div class="vue-filter__label">Città</div>
        <el-select @change="getCities" v-model="citta" placeholder="Select">
            <el-option v-for="item in cities" :key="item.term_id" :label="item.name" :value="item.term_id"></el-option>
        </el-select>
    </div>
</div>
<div class="vue-filter__item">
    <div class="vue-filter__flex vue-filter__select">
        <div class="vue-filter__label">Zona</div>
        <el-select @change="getZones" v-model="zona" placeholder="Select">
            <el-option v-for="item in zones" :key="item.term_id" :label="item.name" :value="item.term_id"></el-option>
        </el-select>
    </div>
</div>

## counter-component
<script>
	// ================== Select component
	Vue.component('counter-component', {
		props: ['label', 'value'],
		data: function () {
			return {
				initial_value: 0,
			}
		},
		template: `
        <div class="vue-filter__flex">
            <div class="vue-filter__label">{{ label }}</div>
            <div class="vue-filter__counter">
                <span @click="down" class="vue-filter__counter-btn">-</span>
                <input @change="handleOptionClick" type="text" v-model="initial_value">
                <span @click="up" class="vue-filter__counter-btn">+</span>
            </div>
        </div>
        `,
		methods: {
			up() {
				this.initial_value++;
				this.handleOptionClick();
			},
			down() {
				if (this.initial_value > 0) {
					this.initial_value--;
					this.handleOptionClick();
				}
			},
			handleOptionClick() {
				this.$emit('handle_func', this.initial_value);
			}
		},
        mounted(){
			this.initial_value = this.value;
        }
	})
</script>

### v-app
<script>
	//====================== Vue
	const app = new Vue({
		el: '#app',
		data: {
			home_url: "",
			loading: false,
			tipo: "",
			tipos: [],
			locali: "0",
			bagni: "0",
			citta: "",
			cities: [],
			zona: "",
			zones: [],
			typology: "",
			typologies: [],
			immobili: [],
			price_min: "",
			price_max: "",
			prices: [],
			mq_min: "",
			mq_max: "",
			areas_min: [],
			areas_max: [],
			immobiles: [],
			orderBy: "date_desc",
			orderOptions: [
				{
					id: "date_desc",
					name: "Più recenti",
				},
				{
					id: "date_asc",
					name: "Meno recenti",
				},
				{
					id: "prezzo_desc",
					name: "Più costosi",
				},
				{
					id: "prezzo_asc",
					name: "Meno costosi",
				},
				{
					id: "mq_desc",
					name: "Più grandi",
				},
				{
					id: "mq_asc",
					name: "Meno grandi"
				},
			]
		},
		methods: {
			getLocali(value) {
				this.locali = value;
				this.get_api_products();
			},
			getBagni(value) {
				this.bagni = value;
				this.get_api_products();
			},
			getCities() {
				if (!this.citta) {
					this.zones = [{
						term_id: "",
						name: "Tutte"
					}];
					this.get_api_products();
				} else {
					this.get_api_term('zones', this.citta);
					this.get_api_products();
				}
			},
			getZones() {
				this.get_api_products();
			},
			getTipo() {
				this.get_api_products();
			},
			getTipology() {
				this.get_api_products();
			},
			getPrice() {
				this.get_api_products();
			},
			getMq() {
				this.get_api_products();
			},
			getOrder() {
				this.get_api_products();
			},
			get_api_term(term, city_id = "") {
				this.loading = true;
				const home_url = window.location.origin;
				let url = "/wp-json/terms/v1/term?term=" + term.toLowerCase() + "&city_id=" + city_id;
				fetch(home_url + url)
					.then(response => response.json())
					.then(res => {
						switch (term) {
							case "tipologia":
								this.typologies = res;
								this.typologies = [{
									term_id: "",
									name: "Tutte"
								}, ...this.typologies];
								this.loading = false;
								break;
							case "citta":
								this.cities = res;
								this.cities = [{
									term_id: "",
									name: "Tutte"
								}, ...this.cities];
								this.loading = false;
								break;
							case "zones":
								this.zones = res;
								this.zones = [{
									term_id: "",
									name: "Tutte"
								}, ...this.zones];
								this.loading = false;
								// this.zones.forEach(item => console.log(JSON.stringify(item, null, 4)))
								break;
							default:
								break;
						}
					})
					.catch(error => console.log(error, 'error'))
			},
			get_api_products() {
				this.loading = true;
				const home_url = window.location.origin;
				const tipo = 'tipo=' + this.tipo;
				const locali = 'locali=' + this.locali;
				const bagni = 'bagni=' + this.bagni;
				const citta = 'citta=' + this.citta;
				const zona = 'zona=' + this.zona;
				const tipologia = 'tipologia=' + this.typology;
				const price_min = 'price_min=' + this.price_min;
				const price_max = 'price_max=' + this.price_max;
				const mq_min = 'mq_min=' + this.mq_min;
				const mq_max = 'mq_max=' + this.mq_max;
				const order_by = 'order_by=' + this.orderBy;
				const parameters_url = tipo + '&' + locali + '&' + bagni + '&' + citta + '&' + zona + '&' + tipologia + '&' + price_min + '&' + price_max + '&' + mq_min + '&' + mq_max + '&' + order_by;
				let url = home_url + '/wp-json/products/v1/search?' + parameters_url;
				console.log(url, 'url')
				fetch(url)
					.then(response => response.json())
					.then(res => {
						this.immobiles = res.immobiles;
						this.loading = false;
					})
					.catch(error => console.log(error, 'error'))
			},
			scrollToImmobiles() {
				this.$refs.immobiles.scrollIntoView({
					behavior: "smooth"
				});
			},
			generatePrices(length, step, slice) {
				let to_100 = Array.from({length: length}, (v, i) => {
					return i * step;
				});
				to_100 = to_100.slice(slice);
				return to_100.map(item => {
					const name = item >= 1000 ? String(item).slice(0, -3) + "." + String(item).slice(-3) : item;
					return {id: item * 1000, name: name + ".000 €"};
				});
			},
			generateArea(length, step, slice) {
				let to_100 = Array.from({length: length}, (v, i) => {
					return i * step;
				});
				to_100 = to_100.slice(slice);
				return to_100.map(item => {
					return {id: item, name: item};
				});
			}
		},
		mounted() {
			this.home_url = window.location.origin;
			this.zones = [{
				term_id: "",
				name: "Tutte"
			}];
			setTimeout(() => {
				this.get_api_term('tipologia');
				this.get_api_term('citta');
			}, 1000);
			this.price_min = this.prices[0].id;
			this.price_max = this.prices[this.prices.length - 1].id;
			this.mq_min = this.areas_min[0].id;
			this.mq_max = this.areas_max[0].id;
			this.get_api_products();
		},
		created() {
			const from_0_to_100_000 = this.generatePrices(11, 10, 2);
			const from_100_000_to_500_000 = this.generatePrices(26, 20, 6);
			const from_500_000_to_1000_000 = this.generatePrices(21, 50, 11);
			const from_1000_000_to_5000_000 = this.generatePrices(11, 500, 3);
			this.prices = [...from_0_to_100_000, ...from_100_000_to_500_000, ...from_500_000_to_1000_000, ...from_1000_000_to_5000_000];
			// this.prices.forEach(item => console.log(item, 'item'));
			const generated_areas = this.generateArea(20, 50, 1);
			this.areas_min = [{id: generated_areas[0].id, name: "MIN"}, ...this.generateArea(20, 50, 2)];
			this.areas_max = [{id: generated_areas[generated_areas.length - 1].id, name: "MAX"}, ...this.generateArea(19, 50, 1)];
		}
	})
</script>

## api php

<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
function register_term()
{
    register_rest_route('terms/v1', 'term', [
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'termsResults',
    ]);
}

add_action('rest_api_init', 'register_term');

function termsResults($data)
{
    $terms = [];

    switch ($data['term']) {
        case 'citta':
            $terms = get_terms([
                'taxonomy' => $data['term'],
                'hide_empty' => true,
                'parent' => 0,
            ]);
            break;
        case 'zones':
            $terms = get_terms([
                'taxonomy' => 'citta',
                'hide_empty' => true,
                'parent' => $data['city_id'],
            ]);
            break;
        case 'tipologia':
            $terms = get_terms([
                'taxonomy' => $data['term'],
                'hide_empty' => true,
            ]);
            break;

        default:
            # code...
            break;
    }

    return $terms;
}

function products_register_search()
{
    register_rest_route('products/v1', 'search', [
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'productsSearchResults',
    ]);
}

add_action('rest_api_init', 'products_register_search');
function productsSearchResults($data)
{
    $tipo = $data['tipo'];
    $locali = $data['locali'];
    $bagni = $data['bagni'];
    $citta = $data['citta'];
    $zona = $data['zona'];
    $tipologia = $data['tipologia'];
    $price_min = $data['price_min'];
    $price_max = $data['price_max'];
    $mq_min = $data['mq_min'];
    $mq_max = $data['mq_max'];
    $order_by = explode("_", $data['order_by']);
    $orderby = $order_by[0];
    $order = $order_by[1];
    $meta_key = null;

    $immobiles_result = [];

    $meta_query = array(
        array(
            'key' => 'prezzo',
            'value' => array((int)$price_min, (int)$price_max),
            'compare' => 'BETWEEN',
            'type' => 'numeric',
        ),
        array(
            'key' => 'mq',
            'value' => array((int)$mq_min, (int)$mq_max),
            'compare' => 'BETWEEN',
            'type' => 'numeric',
        )
    );

    function getTax($value, $slug, $value_type = 'slug')
    {
        return [
            'taxonomy' => $slug,
            'field' => $value_type,
            'terms' => $value,
        ];
    }

    $tax_query = ['relation' => 'AND'];

    if (!empty($tipo)) {
        $tax_query[] = getTax($tipo, 'tipo', 'id');
    }
    if (!empty($locali) && $locali !== '0') {
        $tax_query[] = getTax($locali, 'locali');
    }
    if (!empty($bagni) && $bagni !== '0') {
        $tax_query[] = getTax($bagni, 'bagni');
    }
    if (!empty($citta) && empty($zona)) {
        $tax_query[] = getTax($citta, 'citta', 'id');
    } else if (!empty($citta) && !empty($zona)) {
        $tax_query[] = getTax($zona, 'citta', 'id');
    }
    if (!empty($tipologia)) {
        $tax_query[] = getTax($tipologia, 'tipologia', 'id');
    }

    switch ($orderby) {
        case "mq":
            $orderby = 'meta_value';
            $meta_key = 'mq';
            break;
        default:
            break;
    }

    $immobiles = new WP_Query([
        'post_type' => 'immobile',
        'posts_per_page' => -1,
        'tax_query' => [
            $tax_query
        ],
        'meta_query' => $meta_query,
        'orderby' => $orderby,
        'meta_key' => $meta_key,
        'order' => $order
    ]);

    while ($immobiles->have_posts()) {
        $immobiles->the_post();

        $citta = get_the_terms(get_the_ID(), 'citta')[0];

        $immobiles_result[] = [
            'id' => get_the_ID(),
            'title' => html_entity_decode(get_the_title()),
            'url' => get_the_permalink(),
            'img' => get_the_post_thumbnail_url(get_the_ID(), 'full'),
            'citta' => $citta->parent === 0 ? $citta->name : get_term($citta->parent, 'citta')->name,
            'locali' => get_the_terms(get_the_ID(), 'locali')[0]->name,
            'mq' => get_field('mq'),
            'bagni' => get_the_terms(get_the_ID(), 'bagni')[0]->name,
            'loop_text' => get_field('loop_text'),
            'prezzo' => number_format(get_field('prezzo'), 0, ',', ' '),
        ];
    }

    return [
        "immobiles" => $immobiles_result,
        "tax_query" => $tax_query,
        "meta_query" => $meta_query,
        "orderby" => $orderby,
        "meta_key" => $meta_key,
        "order" => $order,
    ];
}

## api terms

<?php

class all_terms
{
    public function __construct()
    {
        $version = '2';
        $namespace = 'wp/v' . $version;
        $base = 'all-terms';
        register_rest_route($namespace, '/' . $base, array(
            'methods' => 'GET',
            'callback' => array($this, 'get_all_terms'),
        ));
    }

    public function get_all_terms($object)
    {
        $return = array();
// $return['categories'] = get_terms('category');
//        $return['tags'] = get_terms('post_tag');
// Get taxonomies
        $args = array(
            'public' => true,
            '_builtin' => false
        );
        $output = 'names'; // or objects
        $operator = 'and'; // 'and' or 'or'
        $taxonomies = get_taxonomies($args, $output, $operator);
        foreach ($taxonomies as $key => $taxonomy_name) {
            if ($taxonomy_name = $_GET['term']) {
                $return = get_terms($taxonomy_name);
            }
        }
        return new WP_REST_Response($return, 200);
    }
}

add_action('rest_api_init', function () {
    $all_terms = new all_terms;
});
