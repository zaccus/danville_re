<?php
/**
 *  CUSTOM   ----   RSS2 Feed Template for Zillow
 *
 * @package WordPress
 *
 * [2008-07-30] corrected list date format to mm/dd/yyyy
 * [2008-07-30] added PropertyType tag
 */

header('Content-Type: text/xml; charset=' . get_option('blog_charset'), true);

function zstatus($mystatus) {
	$zstat = array ( 'For Sale' => 'Active',
		   'Sale Pending' => 'Pending',
		   'Sold' => 'Sold' );
	return $zstat["$mystatus"];
}

$siteurl = get_option('siteurl');
$max_pics = 20; /* Zillow max is 50 */

if (!function_exists(get_listing_listprice)) {
	return;
}
?>
<?php   

 // omit rentals; sort by title
 $pageposts = get_pages_with_listings('','title','allsales');

 $email = get_option('admin_email');

?>
<Listings>
<?php if ($pageposts): ?>
<?php foreach ($pageposts as $post): ?>
    <?php setup_postdata($post); ?>
    <?php setup_listingdata($post); ?>
	<?php $propstatus = get_listing_status(); ?>
	<?php $propblurb = get_listing_blurb(); ?>
	<?php $listprice = get_listing_listprice(); ?>
	<?php $saleprice = get_listing_saleprice(); ?>
	<?php $saledate = get_listing_saledate(); ?>
	<?php $galleryid = get_listing_galleryid(); ?>
	<?php $numbr = get_listing_bedrooms(); ?>
	<?php $numfba = get_listing_bathrooms(); ?>
	<?php $numhba = get_listing_halfbaths(); ?>
	<?php $numgar = get_listing_garage(); ?>
	<?php $numacsf = get_listing_acsf_noformat(); ?>
	<?php $numacres = get_listing_acres_noformat(); ?>
	<?php $has_pool = get_listing_haspool(); ?>
	<?php $has_condo = get_listing_hascondo(); ?>
	<?php $has_townhome = get_listing_hastownhome(); ?>
	<?php $has_water = get_listing_haswater(); ?>
	<?php $has_golf = get_listing_hasgolf(); ?>
<?php $address = get_listing_address();
	$city = get_listing_city();
 	$state = get_listing_state();
	$zip = get_listing_postcode();
	$MLSID = get_listing_mlsid();  ?>
<?php 	$propertytype = "Single-Family Home";
	if ($has_townhome) { $propertytype = "Townhouse"; }
	if ($has_condo) { $propertytype = "Condo"; }
?>
<?php if ($address && $city && $state && $zip && $propstatus) { ?>
  <Listing>
    <Location>
      <StreetAddress><?php echo $address; ?></StreetAddress>
      <City><?php echo $city; ?></City>
			<State><?php echo $state; ?></State>
			<Zip><?php echo $zip; ?></Zip>
<?php if (($longitude = get_listing_longitude()) && 
          ($latitude = get_listing_latitude())) {	?>
			<Lat><?php echo $latitude; ?></Lat>
			<Long><?php echo $longitude; ?></Long>
<?php } ?>
			<DisplayAddress>Yes</DisplayAddress>
		</Location>
		<ListingDetails>
			<Status><?php echo zstatus($propstatus); ?></Status>
<?php if ($propstatus == 'Sold') { ?>
			<Price><?php echo $saleprice; ?></Price>
<?php } else { ?>
			<Price><?php echo $listprice; ?></Price>
<?php } ?>
			<ListingUrl><?php the_permalink(); ?></ListingUrl>
			<MlsId><?php echo $MLSID; ?></MlsId>
			<MlsName><?php echo get_option('greatrealestate_mls'); ?></MlsName>
			<DateListed><?php echo get_listing_listdate(); ?></DateListed>
<?php if (($propstatus == 'Sold') && $saledate) { ?>
			<DateSold><?php echo $saledate; ?></DateSold>
<?php } ?>
			<VirtualTourUrl><?php the_permalink(); ?></VirtualTourUrl>
		</ListingDetails>
		<BasicDetails>
			<PropertyType><?php echo $propertytype; ?></PropertyType>
			<Title><![CDATA[<?php echo $propblurb . " :: "; the_title(); ?>]]></Title>
			<Description><![CDATA[<?php the_excerpt_rss(); ?>]]></Description>
			<Bedrooms><?php echo $numbr; ?></Bedrooms>
			<FullBathrooms><?php echo $numfba; ?></FullBathrooms>
			<HalfBathrooms><?php echo $numhba; ?></HalfBathrooms>
			<LivingArea><?php echo $numacsf; ?></LivingArea>
			<LotSize><?php echo $numacres; ?></LotSize>
		</BasicDetails>
<?php if (function_exists(nextgengallery_picturelist)) { ?>
	<?php $piclist = nextgengallery_picturelist(get_listing_galleryid()); ?>

	<?php if (!empty($piclist)) { ?>
		<Pictures>
		<?php $picnum = 1; foreach ($piclist as $picture) { ?>
			<?php if ($picnum <= $max_pics) { ?>
			<Picture>
			<PictureUrl><?php echo $siteurl.'/'.$picture->path.'/'.$picture->filename; ?></PictureUrl>
<?php if (!empty($picture->description)) { ?>
			<Caption><?php echo strip_tags(stripslashes($picture->description)); ?></Caption>
<?php } ?>
			</Picture>
			<?php } ?>
		<?php $picnum+= 1;} ?>
		</Pictures>
	<?php } ?>
<?php } ?>
		<Agent>
<?php $agent = split(' ',get_option('greatrealestate_agent')); ?>
			<FirstName><?php echo $agent[0]; ?></FirstName>
			<LastName><?php echo $agent[1]; ?></LastName>
			<EmailAddress><?php echo $email; ?></EmailAddress>
			<PictureUrl><?php 
		$out = 'http://www.gravatar.com/avatar/';
		$out .= md5( strtolower( $email ) );
 		$out .= '?s=96';
 		echo $out; ?></PictureUrl>
			<MobilePhoneLineNumber><?php echo get_option('greatrealestate_agentphone'); ?></MobilePhoneLineNumber>
		</Agent>
		<Office>
			<BrokerageName><?php echo get_option('greatrealestate_broker'); ?></BrokerageName>
<?php /*
			<StreetAddress></StreetAddress>
			<UnitNumber></UnitNumber>
			<City></City>
			<State></State>
			<Zip></Zip>
 */ ?>
		</Office>
	</Listing>
	<?php } ?>
	<?php endforeach; ?>
<?php endif; ?>
</Listings>
