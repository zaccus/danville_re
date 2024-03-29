<?php
/**
 *  CUSTOM   ----   RSS2 Feed Template for Google Base
 *
 * @package WordPress
 *
 * feel free to customize, but check the Google Base feed API if
 * you intend to make any XML structure changes!
 *
 * NOTE: this feed only contains AVAILABLE properties
 */

header('Content-Type: text/xml; charset=' . get_option('blog_charset'), true);

function zstatus($mystatus) {
	$zstat = array ( 'For Sale' => 'Active',
		   'Sale Pending' => 'Pending',
		   'Sold' => 'Sold' );
	return $zstat["$mystatus"];
}

$siteurl = get_option('siteurl');
$max_pics = 10; 

if (!function_exists('get_listing_listprice')) {
	return;
}
?>
<?php   

// TODO - use new funcs to get and sort data
$querystr = "
    SELECT wposts.*
    FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
    WHERE wposts.ID = wpostmeta.post_id 
    AND wpostmeta.meta_key = 'rehomes_propstatus' 
    AND wposts.post_status = 'publish' 
    AND wpostmeta.meta_value = 'For Sale'
    AND wposts.post_type = 'page' 
    ORDER BY wposts.post_title ASC
 ";

 $pageposts = get_pages_with_listings('','title','active');


?>
<?php echo '<?xml version="1.0" encoding="UTF-8" ?>'; ?>
<rss version="2.0" 
xmlns:g="http://base.google.com/ns/1.0">
<channel>
<title><?php echo get_option('greatrealestate_listfeedtitle'); ?></title>
<description><?php echo get_option('greatrealestate_listfeeddesc'); ?></description>
	<link><?php echo get_option('home'); ?></link>
<?php if ($pageposts): ?>
<?php foreach ($pageposts as $post): ?>
    <?php setup_postdata($post); 
	setup_listingdata($post); ?>
<?php
 	$address = get_listing_address();
 	$city = get_listing_city();
	$state = get_listing_state();
	$zip = get_listing_postcode();
	$propstatus = get_listing_status();
	if ($address && $city && $state && $zip && $propstatus) { ?>
<item>
<g:location><?php echo $address . ", " . $city . ", " . $state . ", " . $zip; ?></g:location>
<g:listing_status>active</g:listing_status>
<g:listing_type>for sale</g:listing_type>
<g:price><?php the_listing_listprice(); ?></g:price>
<link><?php the_permalink(); ?></link>
<g:mls_listing_id><?php the_listing_mlsid(); ?></g:mls_listing_id>
<g:id><?php the_listing_mlsid(); ?></g:id>
<g:mls_name><?php echo get_option('greatrealestate_mls'); ?></g:mls_name>
<title><![CDATA[<?php the_listing_blurb(); ?>]]></title>
<description><![CDATA[<?php echo get_listing_description_beforemore(); ?>]]></description>
<g:bedrooms><?php echo get_listing_bedrooms(); ?></g:bedrooms>
<g:bathrooms><?php echo get_listing_bathrooms() . "." . get_listing_halfbaths(); ?></g:bathrooms>
<g:area><?php echo get_listing_acsf() . " square ft."; ?></g:area>
<g:lot_size><?php echo get_listing_acres() . " acres"; ?></g:lot_size>
<?php if (function_exists(nextgengallery_picturelist)) { 
	$piclist = nextgengallery_picturelist(get_listing_galleryid()); 
	if (!empty($piclist)) { 
		$picnum = 1; 
		foreach ($piclist as $picture) { 
			if ($picnum <= $max_pics) { 
				?><g:image_link><?php echo $siteurl.'/'.$picture->path.'/'.$picture->filename; ?></g:image_link>
<?php
			}
			$picnum+= 1;
		}
	}
} ?>
	<g:agent><?php echo get_option('greatrealestate_agent'); ?></g:agent>
	<g:broker><?php echo get_option('greatrealestate_broker'); ?></g:broker>
<g:provider_class>agent</g:provider_class>
</item>
<?php } ?>
<?php endforeach; ?>
<?php endif; ?>
</channel>
</rss>
