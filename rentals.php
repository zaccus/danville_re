<?php
/*
Template Name: Listings Index
*/

# intended only for page use, displays all listings
# first for sale and for rent (larger format), followed by
# a list of pending sale and pending lease, followed by
# a list of sold and leased
#
# Before the lists, display the page's stored title and content
# and an edit link

?>
<?php get_header(); ?>

	<!-- Begin Content -- Listings Index -->
   <div id="container">
      <div id="content">
      <span id="active-heading" class="news_cycle"><h2><?php the_title(); ?></h2></span>
      <?php   
if (function_exists(get_pages_with_listings)) {
?>
<!-- list of listings -->
<?php
	$pageposts = get_pages_with_listings('', 'highprice', 'allrentals');
?>

<?php if ($pageposts): ?>
<div id="page-content-inner">
	<?php foreach ($pageposts as $post): ?>
		<?php setup_postdata($post); ?>
		<?php setup_listingdata($post); ?>
		<?php $line1 = ''; $line2 = ''; ?>

	<div class="prop-box-avail">
	  <div class="listing-address"><h2><a href="<?php the_permalink() ?>" rel="bookmark" title="More about <?php the_title(); ?>"><?php the_title(); ?></a></h2></div>
	  <div class="listing-status"><h3><?php the_listing_status(); ?>
		<?php if (get_listing_listprice()) { ?>
		- <?php the_listing_listprice(); } ?> per month 
	  </h3></div><br />
	  <div class="listing-blurb">
 	<?php the_listing_blurb(); ?>
     </div>
	  <div class="prop-thumb">
	  <a href="<?php the_permalink() ?>" rel="bookmark" title="More about <?php the_title(); ?>"><?php the_listing_thumbnail(); ?></a>
	  </div>
	<?php if ($bedrooms = get_listing_bedrooms()) 
		$line1 .= "<li class='listing-beds'>$bedrooms Bed</li>"; ?>
	<?php if ($bathrooms = get_listing_bathrooms()) {
		$line1 .= "<li class='listing-baths'>$bathrooms Full ";
		if ($halfbaths = get_listing_halfbaths()) 
			$line1 .= "&amp; $halfbaths Half ";
		$line1 .= " Bath</li>"; 
              }	?>
	<?php if (get_listing_garage()) 
		$line1 .= "<li class='listing-garage'>" . get_listing_garage() . " Car Garage</li>"; ?>
	<?php if (get_listing_acsf()) 
		$line2 .= "<li class='listing-acsf()'>" . get_listing_acsf() ." Sq/Ft Under Air</li>"; ?>
	<?php if (get_listing_totsf()) 
	   $line2 .= "<li class='totsf'>" .get_listing_totsf(). " Sq/Ft Total</li>"; ?>
	<?php if (get_listing_acres()) 
	  $line2 .= "<li class='acres'>" .get_listing_acres()." Acres</li>"; ?>
	
 	<?php if ($line1 || $line2 ) { ?>
      <div class='propdata'>
	<?php if ($line1) echo "<ul class='propdata-line line1'>$line1</ul>"; ?>
	<?php if ($line2) echo "<ul class='propdata-line line2'>$line2</ul>"; ?>
      </div>
	<?php } ?><br /><br /><br />
    	</div>
  <?php endforeach; ?>
  </div>
 <?php endif; ?>
 <?php get_sidebar(); ?>
     </div>
<?php } ?>
   <!-- End Content -->

<?php get_footer(); ?>