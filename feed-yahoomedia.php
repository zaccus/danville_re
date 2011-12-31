<?php
/**
 *  CUSTOM   ----   RSS2 Feed Template for Yahoo MEDIA RSS / Active Listings
 *
 * @package WordPress
 *
 * feel free to customize, but check the Yahoo API if
 * you intend to make any XML structure changes!
 * http://search.yahoo.com/mrss
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
$max_pics = 1; 

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

 $pageposts = get_pages_with_listings('','listdate','active');


?>
<?php echo '<?xml version="1.0" encoding="UTF-8" ?>'; ?>
<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/">
<channel>
<title><?php echo get_option('greatrealestate_listfeedtitle'); ?></title>
<description><?php echo get_option('greatrealestate_listfeeddesc'); ?></description>
<link><?php echo get_option('home'); ?></link>
<media:restriction relationship="allow" type="country">all</media:restriction>
<media:keywords>home, property,homefor sale</media:keywords>
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
<title><![CDATA[<?php echo get_listing_status() . " " . get_listing_listprice() . " - " . $address . ", " . $city . ", " . $state . ", " . $zip; ?>]]></title>
<link><?php the_permalink(); ?></link>
<description><![CDATA[<?php echo get_listing_thumbnail() . '<br />' . get_listing_description_beforemore(); ?>]]></description>
<?php if (function_exists(nextgengallery_picturelist)) { 
	$piclist = nextgengallery_picturelist(get_listing_galleryid()); 
	if (!empty($piclist)) { 
		$picnum = 1; 
		foreach ($piclist as $picture) { 
			if ($picnum <= $max_pics) { 
				?><media:content url="<?php echo $siteurl.'/'.$picture->path.'/'.$picture->filename; ?>" medium="image" />
<?php
			}
			$picnum+= 1;
		}
	}
} ?>
</item>
<?php } ?>
<?php endforeach; ?>
<?php endif; ?>
</channel>
</rss>
