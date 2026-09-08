## select placeholder
[select* Test first_as_label "Placeholder" "Option 1" "Option 2"]

you have a field named “customtext” for the destination email address:

```
[text* customtext]
```

To get the default value from shortcode attributes, add the default:shortcode_attr option to the form-tag:

```

[text* customtext readonly default:shortcode_attr]
```

Then, add an attribute with the same name as the field (“customtext” in this case) into the shortcode for the contact form:

```

[contact-form-7 id="123" title="Contact Form" customtext="xxxxxx@example.com"]
```

you need to register the attribute beforehand.

Add the following code snippet to your theme’s functions.php file:

```

add_filter( 'shortcode_atts_wpcf7', 'custom_shortcode_atts_wpcf7_filter', 10, 3 );

function custom_shortcode_atts_wpcf7_filter( $out, $pairs, $atts ) {
    $my_attr = 'customtext;

if ( isset( $atts[$my_attr] ) ) {
    $out[$my_attr] = $atts[$my_attr];
}

return $out;
}
```
