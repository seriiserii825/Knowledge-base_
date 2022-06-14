URL: Add One Simple Product to Cart
href=”https://yourdomain.com/?add-to-cart=25&quantity=1“

Now, make sure to change the domain name in the link, and the button will work out of the box. 1 product with ID=25 will be added to cart.

URL: Add One Simple Product to Cart with Quantity = 3
href=”https://yourdomain.com/?add-to-cart=25&quantity=3″

1 product with ID=25 and quantity = 3 will be added to cart. Note: you can’t add 2 different products to cart with a URL.

URL: Add One Simple Product to Cart & Redirect to Cart Afterwards
href=”https://yourdomain.com/cart/?add-to-cart=25&quantity=1“

Remember, if you’ve changed the URL for the cart, make sure to change “/cart/” into “/basket/” for example. For this to work you must also tick the “Enable AJAX add to cart buttons on archives” option under WooCommerce –> Settings –> Products -> General.

URL: Add One Simple Product to Cart & Redirect to Checkout Afterwards
href=”https://yourdomain.com/checkout/?add-to-cart=25&quantity=1“

Remember, for this to work you must tick the “Enable AJAX add to cart buttons on archives” option under WooCommerce –> Settings –> Products -> General and also disable “Redirect to the cart page after successful addition”:

WooCommerce: Disable Redirect to Cart
WooCommerce: Disable Redirect to Cart
URL: Add One Simple Product to Cart & Redirect to Any Page Afterwards
href=”https://yourdomain.com/your_custom_page/?add-to-cart=25&quantity=1“

Remember, for this to work you must tick the “Enable AJAX add to cart buttons on archives” option under WooCommerce –> Settings –> Products -> General and also disable “Redirect to the cart page after successful addition”.

2) Variable Products: Add to Cart URL
Here things were originally complicated, but now it’s much easier! All you need is the variation ID. Here’s where you can find it:

WooCommerce: find Variation ID
WooCommerce: find Variation ID
Once you have the Variation ID, you can then use the following.

URL: Add One Variable Product to Cart
href=”https://yourdomain.com/?add-to-cart=88&quantity=1“

We’re adding here just the Variation ID (88) as per the screenshot above. Easy as pie 🙂

URL: Add One Variable Product to Cart (with Quantity = 3)
href=”https://yourdomain.com/?add-to-cart=88&quantity=3″

You can also redirect to Cart, Checkout and another page in the same way we’ve seen for the simple products:

URL: Add One Variable Product to Cart & Redirect to Cart
href=”https://yourdomain.com/cart/?add-to-cart=88&quantity=1“

URL: Add One Variable Product to Cart & Redirect to Checkout
href=”https://yourdomain.com/checkout/?add-to-cart=88&quantity=1“

URL: Add One Variable Product to Cart & Redirect to Any Page
href=”https://yourdomain.com/any-page-url/?add-to-cart=88&quantity=1“

3) Grouped Products: Add to Cart URL
I recently worked with Grouped Products and my task was to add them to cart via a custom URL. A grouped product is a combination of two or more sub-products, and each one can be added with a custom quantity to cart.

WooCommerce Grouped Products
WooCommerce Grouped Products
So, here are the custom links.

URL: Add a Grouped Product to Cart
You will need the Grouped Product ID, which can be found in the usual way, and also the sub-product IDs. Then, use something like:

href=”https://yourdomain.com/?add-to-cart=3111&quantity[1803]=5&quantity[1903]=2″

In this case, we’re adding Grouped Product ID = 3111, and specifically we’re adding 5x product ID = 1803 and 2x product ID=2.

Note: if you want to add “zero” for one of the sub-products, you still need to specify that i.e. &quantity[1903]=0.
