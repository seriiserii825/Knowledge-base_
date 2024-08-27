## The problem

Let’s say we want to have a monthly archive page for a term. WordPress has a term archive page, which is `/{taxonomy}/{term}/` , but does not have a monthly archive page for that term. This means `/{taxonomy}/{term}/{year}/{month}/` does exist by default.

## The solution

1. **Add a rewrite rule**:  
    We can add a rewrite rule for the required URL structure.  
    So when the user hits our required URL  
    e.g. `/movies/harry-potter/2021/11/` ,  
    it will be interpreted as :  
    `index.php?archive_taxonomy=movies&archive_term=harry-potter&archive_year=2021&archive_month=11`
2. **Load our custom page template  
    **This custom template will have access to query params containing `archive_taxonomy`, `archive_term`, `archive_year`, `archive_month`

We add the rewrite rule so that we have a pretty URL, we don’t end up creating the ugly URL structure with query params.

# How do we achieve this?

So let’s get started folks!

## Step 1. Add rewrite rule

The `[add_rewrite_rule](https://codex.wordpress.org/Rewrite_API/add_rewrite_rule)()` function adds additional rules to the rewrite array. There are three arguments:

- **rule** — a regular expression with which to compare the request URL against
- **rewrite** — the query string used to interpret the rule. The `$matches` array contains the captured matches and starts from index '1'.
- **position** — ‘`top`' or '`bottom`'. Where to place the rule: at the top of the rewrite array or the bottom. WordPress scans from the top of the array to the bottom and stops as soon as it finds a match. In order for your rules to take precedence over existing rules, you'll want to set this to '`top`'. Default is '`bottom`'.

add\_action( 'init',  function() {  
   _/\*\*  
    \* (\[^/\]\*) - taxonomy  
    \* (\[^/\]\*) - term  
    \* (\[0-9\]{4}) - year 2021  
    \* (\[0-9\]{2}) - month 11  
    \*  
    \*/_   add\_rewrite\_rule(  
      '(\[^/\]\*)/(\[^/\]\*)/(\[0-9\]{4})/(\[0-9\]{2})/?$',  
        'index.php?archive\_taxonomy=$matches\[1\]&archive\_term=$matches\[2\]&archive\_year=$matches\[3\]&archive\_month=$matches\[4\]',  
        'top'  
    );  
} );

So here,  
There are four parts to this structure `’([^/]*)/([^/]*)/([0–9]{4})/([0–9]{2})/?$'`

1. `([^/]*)` will look for the regex match and replace the $matches\[1\] with the URL value and set that equal to `archive_taxonomy` query param. e.g. `archive_taxonomy=movies`
2. The next `([^/]*)`will look for the regex match and replace the $matches\[2\] with the URL value and set that equal to `archive_taxonomy` query param. e.g. `archive_term=harry-potter`
3. `([0–9]{4})`will look for the regex match and replace the $matches\[3\] with the URL value and set that equal to `archive_year` query param. e.g. `archive_year=2021` . Notice {4} in the regex is because there are four numbers in the year pattern e.g.`2021`
4. The next `([0–9]{2})`will look for the regex match and replace the $matches\[2\] with the URL value and set that equal to `archive_month` query param. e.g. `archive_month=11` . Notice {2} in the regex is because there are four numbers in the month pattern e.g. `11`

## Step 2. Whitelist the query param

WordPress does not automatically recognize these query params, ( `archive_taxonomy` , `archive_term` ,`archive_year` and `archive_month` ) even though it's interpreted as a GET variable.

So we need to whitelist these like so :

add\_filter( 'query\_vars', function( $query\_vars ) {  
   $query\_vars\[\] = 'archive\_taxonomy';  
   $query\_vars\[\] = 'archive\_term';  
   $query\_vars\[\] = 'archive\_year';  
   $query\_vars\[\] = 'archive\_month';  
   return $query\_vars;  
} );

## Step 3. Flush the previous rewrite rules.

Flush permalinks. Go to WP Admin > Settings > Permalinks > Save. This doesn’t happen automatically after you add the above code.

## Step 4. Create Page Template.

Create a page template called `taxonomy-date-archive.php` . Here should to access the query param values, after step 5 is added.

<?php  
_/\*\*  
 \* Template Name: Taxonomy Date Archive.  
 \*  
 \*/  
  
_echo 'Hello World';  
  
echo '<pre/>';  
print\_r(get\_query\_var( 'archive\_taxonomy' ));  
echo '<br>';  
print\_r(get\_query\_var( 'archive\_term' ));  
echo '<br>';  
print\_r(get\_query\_var( 'archive\_year' ));  
echo '<br>';  
print\_r(get\_query\_var( 'archive\_month' ));

## Step 5. Load the custom template for that rewrite URL.

Check if those query param exist, then load your custom page template else let the default template be loaded.

add\_action( 'template\_include', function( $template ) {  
   if ( get\_query\_var( 'archive\_taxonomy' ) == false || get\_query\_var( 'archive\_taxonomy' ) == '' ) {  
      return $template;  
   }  
  
   return get\_template\_directory() . '/taxonomy-date-archive.php';  
} );

**Output/Result**

Now if we go to the URL `/movies/harry-potter/2021/11/`, our custom page template will load giving us access to all query params, using which we can run our query.

![](https://miro.medium.com/v2/resize:fit:700/1*tziMYb6-PTSOBSPqP2TixQ.png)

That’s all folks.

[

Rewrite Rule

](https://medium.com/tag/rewrite-rule?source=post_page-----b8603a37dcab---------------rewrite_rule-----------------)

[

](https://medium.com/tag/wordpress?source=post_page-----b8603a37dcab---------------wordpress-----------------)
