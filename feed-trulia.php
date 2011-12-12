<?php
/**
 *  CUSTOM   ----   RSS2 Feed Template for Trulia
 *
 * @package WordPress
 */

header('Content-Type: text/xml; charset=' . get_option('blog_charset'), true);


$siteurl = get_option('siteurl');
$max_pics = 2; /* Trulia only uses first */

if (!function_exists(get_listing_listprice)) {
	return;
}
?>
<?php   

// include sold and rented 
//
 $pageposts = get_pages_with_listings('','title','');

 $email = get_option('admin_email');

?>
<properties>
<?php if ($pageposts): ?>
<?php foreach ($pageposts as $post): ?>
    <?php setup_postdata($post); ?>
    <?php setup_listingdata($post); ?>
	<?php $propstatus = get_listing_status(); ?>
	<?php $galleryid = get_listing_galleryid(); ?>
<?php $address = get_listing_address();
	$city = get_listing_city();
 	$state = get_listing_state();
	$zip = get_listing_postcode();
	$MLSID = get_listing_mlsid();  ?>

<?php if ($address && $city && $state && $zip && $propstatus) { ?>
  <property>
    <location>
      <street-address><?php echo $address; ?></street-address>
      <city-name><?php echo $city; ?></city-name>
			<state-code><?php echo $state; ?></state-code>
			<zipcode><?php echo $zip; ?></zipcode>
<?php if (($longitude = get_listing_longitude()) && 
          ($latitude = get_listing_latitude())) {	?>
			<latitude><?php echo $latitude; ?></latitude>
			<longitude><?php echo $longitude; ?></longitude>
<?php } ?>
			<display-address>yes</display-address>
		</location>
		<status><?php echo $propstatus; ?></status>
		<listing-type>resale</listing-type>
		<landing-page>
			<lp-url><?php the_permalink(); ?></lp-url>
			<virtual-tour-url><?php the_permalink(); ?></virtual-tour-url>
		</landing-page>
		<details>
<?php if (($propstatus == 'Sold') || ($propstatus == 'Rented')) { ?>
			<price><?php the_listing_saleprice(); ?></price>
<?php } else { ?>
			<price><?php the_listing_listprice(); ?></price>
<?php } ?>
			<mlsid><?php $mlsid; ?></mlsid>
			<provider-listingid><?php $mlsid; ?></provider-listingid>
<?php if (($propstatus == 'Sold') && get_listing_saledate()) { ?>
			<date-sold><?php the_listing_saledate(); ?></date-sold>
<?php } ?>
			<description><![CDATA[<?php echo get_listing_blurb(); ?>]]></description>
			<num-bedrooms><?php the_listing_bedrooms(); ?></num-bedrooms>
			<num-full-bathrooms><?php the_listing_bathrooms(); ?></num-full-bathrooms>
			<num-half-bathrooms><?php the_listing_halfbaths(); ?></num-half-bathrooms>
			<square-feet><?php the_listing_acsf(); ?></square-feet>
			<lot-size><?php the_listing_acres(); ?></lot-size>
			<property-type><?php if (get_listing_hascondo()) {echo "Condo";} 
				elseif (get_listing_hastownhome()) { echo "Townhouse";}
				else { echo "Single-Family Home"; } ?></property-type>
		</details>
<?php if (function_exists('nextgengallery_picturelist')) { ?>
	<?php $piclist = nextgengallery_picturelist($galleryid); ?>

	<?php if (!empty($piclist)) { ?>
		<pictures>
		<?php $picnum = 1; foreach ($piclist as $picture) { ?>
			<?php if ($picnum <= $max_pics) { ?>
			<picture>
			<picture-url><?php echo $siteurl.'/'.$picture->path.'/'.$picture->filename; ?></picture-url>
			</picture>
			<?php } ?>
		<?php $picnum+= 1;} ?>
		</pictures>
	<?php } ?>
<?php } ?>
		<agent>
		<agent-name><?php echo get_option('greatrealestate_agent'); ?></agent-name>
			<agent-email><?php echo $email; ?></agent-email>
			<agent-picture-url><?php 
		$out = 'http://www.gravatar.com/avatar/';
		$out .= md5( strtolower( $email ) );
 		$out .= '?s=96';
 		echo $out; ?></agent-picture-url>
			<agent-phone></agent-phone>
		</agent>
		<broker>
		<broker-name><?php echo get_option('greatrealestate_broker'); ?></broker-name>
		</broker>
		<site>
			<site-url><?php echo get_option('siteurl'); ?></site-url>
			<site-name><?php echo get_option('greatrealestate_listfeedtitle'); ?></site-name>
		</site>
	</property>
	<?php } ?>
	<?php endforeach; ?>
<?php endif; ?>
</properties>
