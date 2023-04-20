Here are a few examples:

// Get downloadable products created in the year 2016.
$products = wc_get_products( array(
'downloadable' => true,
'date_created' => '2016-01-01...2016-12-31`,
) );
// Get 10 most recent product IDs in date descending order.
$query = new WC_Product_Query( array(
'limit' => 10,
'orderby' => 'date',
'order' => 'DESC',
'return' => 'ids',
) );
$products = $query->get_products();
// Get products containing a specific SKU.
// Does partial matching, so this will get products with SKUs "PRDCT-1", "PRDCT-2", etc.
$query = new WC_Product_Query();
$query->set( 'sku', 'PRDCT' );
$products = $query->get_products();
WC_Product_Query Methods
get_query_vars() - Get an array of all of the current query variables set on the query object.

get( string $query_var, mixed $default = '' ) - Get the value of a query variable or the default if the query variable is not set.

set( string $query_var, mixed $value ) - Set a query variable to a value.

get_products() - Get all products matching the current query variables.

Parameters
General
status

Accepts a string or array of strings: one or more of 'draft', 'pending', 'private', 'publish', or a custom status. By default include all WP default post statuses: array( 'draft', 'pending', 'private', 'publish' ).

// Get draft products.
$args = array(
'status' => 'draft',
);
$products = wc_get_products( $args );
type

Accepts a string or array of strings: one or more of 'external', 'grouped', 'simple', 'variable', or a custom type.

// Get external products.
$args = array(
'type' => 'external',
);
$products = wc_get_products( $args );
include

Accepts an array of integers: Only includes products with IDs in the array.

// Get external products limited to ones with specific IDs.
$args = array(
'type' => 'external',
'include' => array( 134, 200, 210, 340 ),
);
$products = wc_get_products( $args );
exclude

Accepts an array of integers: Excludes products with IDs in the array.

// Get products that aren't the current product.
$args = array(
'exclude' => array( $product->get_id() ),
);
$products = wc_get_products( $args );
parent

Accepts an integer: post ID of the product parent.

// Get products with a specific parent.
$args = array(
'parent' => 20,
);
$products = wc_get_products( $args );
parent_exclude

Accepts an array of integers: Excludes products with parent ids in the array.

// Get products that don't have parent IDs of 20 or 21.
$args = array(
'parent_exclude' => array( 20, 21 ),
);
$products = wc_get_products( $args );
limit

Accepts an integer: Maximum number of results to retrieve or -1 for unlimited. If not specified, this will default to the value of the global posts_per_page option.

// Get latest 3 products.
$args = array(
'limit' => 3,
);
$products = wc_get_products( $args );
page

Accepts an integer: Page of results to retrieve. Does nothing if 'offset' is used.

// First 3 products.
$args = array(
'limit' => 3,
'page' => 1,
);
$page_1_products = wc_get_products( $args );

// Second 3 products.
$args = array(
'limit' => 3,
'page' => 2,
);
$page_2_products = wc_get_products( $args );
paginate

Accepts a boolean: True for pagination, or false for not.

Default: false.

Modifies the return results to give an object with fields:

products: Array of found products.

total: Number of found products.

max_num_pages: The total number of pages.

// Get products with extra info about the results.
$args = array(
'paginate' => true,
);
$results = wc_get_products( $args );
echo $results->total . ' products found\n';
echo 'Page 1 of ' . $results->max_num_pages . '\n';
echo 'First product id is: ' . $results->products[0]->get_id() . '\n';
offset

Accepts an integer: Amount to offset product results.

// Get second to fifth most-recent products.
$args = array(
'limit' => 4,
'offset' => 1
);
$products = wc_get_products( $args );

order

Accepts a string: 'DESC' or 'ASC'. Use with 'orderby'.

Default: 'DESC'.

// Get most recently modified products.
$args = array(
'orderby' => 'modified',
'order' => 'DESC',
);
$products = wc_get_products( $args );
orderby

Accepts a string: 'none', 'ID', 'name', 'type', 'rand', 'date', 'modified'.

Default: 'date'.

// Get some random products.
$args = array(
'orderby' => 'rand',
);
$products = wc_get_products( $args );
return

Accepts a string: 'ids' or 'objects'.

Default: 'objects'.

// Get product ids.
$args = array(
'return' => 'ids',
);
$products = wc_get_products( $args );
Product
sku

Accepts a string: Product SKU to match on. Does partial matching on the SKU.

// Get products with "PRDCT" in their SKU (e.g. PRDCT-1 and PRDCT-2).
$args = array(
'sku' => 'PRDCT',
);
$products = wc_get_products( $args );
tag

Accepts an array: Limit results to products assigned to specific tags by slug.

// Get products with the "Excellent" or "Modern" tags.
$args = array(
'tag' => array( 'excellent', 'modern' ),
);
$products = wc_get_products( $args );
category

Accepts an array: Limit result to products assigned to specific categories by slug.

// Get shirts.
$args = array(
'category' => array( 'shirts' ),
);
$products = wc_get_products( $args );
weight, length, width, height

Accepts a float: The dimension measurement to match on.

// Get products 5.5 units wide and 10 units long.
$args = array(
'width' => 5.5,
'length' => 10,
);
$products = wc_get_products( $args );
price, regular_price, sale_price

Accepts a float: The price to match on.

// Get products that currently cost 9.99.
$args = array(
'price' => 9.99,
);
$products = wc_get_products( $args );
total_sales

Accepts an int: Gets products with that many sales.

// Get products that have never been purchased.
$args = array(
'total_sales' => 0,
);
$products = wc_get_products( $args );
virtual, downloadable, featured, sold_individually, manage_stock, reviews_allowed

Accepts a boolean: Limit results to products with the specific settings or features.

// Get downloadable products that don't allow reviews.
$args = array(
'downloadable' => true,
'reviews_allowed' => false,
);
$products = wc_get_products( $args );
backorders

Accepts a string: 'yes', 'no', or 'notify'.

// Get products that allow backorders.
$args = array(
'backorders' => 'yes',
);
$products = wc_get_products( $args );
visibility

Accepts a string: One of 'visible', 'catalog', 'search', or 'hidden'.

// Get products that show in the catalog.
$args = array(
'visibility' => 'catalog',
);
$products = wc_get_products( $args );
stock_quantity

Accepts an int: The quantity of a product in stock.

// Get products that only have one left in stock.
$args = array(
'stock_quantity' => 1,
);
$products = wc_get_products( $args );
stock_status

Accepts a string: 'outofstock' or 'instock'.

// Get out of stock products.
$args = array(
'stock_status' => 'outofstock',
);
$products = wc_get_products( $args );
tax_status

Accepts a string: 'taxable', 'shipping', or 'none'.

// Get taxable products.
$args = array(
'stock_status' => 'taxable',
);
$products = wc_get_products( $args );
tax_class

Accepts a string: A tax class slug.

// Get products in the "Reduced Rate" tax class.
$args = array(
'tax_class' => 'reduced-rate',
);
$products = wc_get_products( $args );
shipping_class

Accepts a string or array of strings: One or more shipping class slugs.

// Get products in the "Bulky" shipping class.
$args = array(
'shipping_class' => 'bulky',
);
$products = wc_get_products( $args );

download_limit, download_expiry

Accepts an integer: The download limit/expiry or -1 for unlimited.

// Get products with unlimited downloads.
$args = array(
'download_limit' => -1,
);
$products = wc_get_products( $args );
average_rating

Accepts a float: The average rating.

// Get products with all 5-star ratings.
$args = array(
'average_rating' => 5.0,
);
$products = wc_get_products( $args );
review_count

Accepts an int: The number of reviews.

// Get products with 1 review.
$args = array(
'review_count' => 1,
);
$products = wc_get_products( $args );
Date
date_created, date_modified, date_on_sale_from, date_on_sale_to

Accepts a string. Date queries use a standard format:

YYYY-MM-DD - Matches on products during that one day in site timezone.

> YYYY-MM-DD - Matches on products after that one day in site timezone.

> =YYYY-MM-DD - Matches on products during or after that one day in site timezone.

<YYYY-MM-DD - Matches on products before that one day in site timezone. <=YYYY-MM-DD - Matches on products during or before that one day in site timezone. YYYY-MM-DD...YYYY-MM-DD - Matches on products during or in between the days in site timezone. TIMESTAMP - Matches on products during that one second in UTC timezone.>TIMESTAMP - Matches on products after that one second in UTC timezone.

> =TIMESTAMP - Matches on products during or after that one second in UTC timezone.

<TIMESTAMP - Matches on products before that one second in UTC timezone. <=TIMESTAMP - Matches on products during or before that one second in UTC timezone. TIMESTAMP...TIMESTAMP - Matches on products during or in between the seconds in UTC timezone. // Get downloadable products created in the year 2016. $products=wc_get_products( array( 'downloadable'=> true,
'date_created' => '2016-01-01...2016-12-31`,
) );
Adding Custom Parameter Support
It is possible to add support for custom parameters in wc_get_products or WC_Product_Query. To do this you need to filter the generated query.

    /**
    * Handle a custom 'customvar' query var to get products with the 'customvar' meta.
    * @param array $query - Args for WP_Query.
    * @param array $query_vars - Query vars from WC_Product_Query.
    * @return array modified $query
    */
    function handle_custom_query_var( $query, $query_vars ) {
    if ( ! empty( $query_vars['customvar'] ) ) {
    $query['meta_query'][] = array(
    'key' => 'customvar',
    'value' => esc_attr( $query_vars['customvar'] ),
    );
    }

    return $query;
    }
    add_filter( 'woocommerce_product_data_store_cpt_get_products_query', 'handle_custom_query_var', 10, 2 );
    Usage:

    $products = wc_get_products( array( 'customvar' => 'somevalue' ) );
