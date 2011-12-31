<?php
/*
Template Name: Single Listing
*/
?>

<?php get_header(); ?>

   <!-- Begin Content -- Single Listing -->
   <div id="container">
      <div id="content">
      <span id="active-heading" class="news_cycle"><h2><?php the_title(); ?></h2></span>
         <div id="page-content-inner">         
      
      <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
      
      <div class="post" id="post-<?php the_ID(); ?>">
			<div class="entry">
<?php if (function_exists('get_listing_status')) { ?>
	<?php getandsetup_listingdata(); ?>
	<ul class="tabnav">
	<?php the_listing_map_tab(); ?>
	<li><a title="Property Details" href="#details" ><span>Details</span></a></li>
	<?php the_listing_gallery_tab(); ?>		
	</ul>
	
<div class="prop-box">
   <h3><?php the_listing_status(); ?>
		<?php if (get_listing_hasclosed()) { ?>
		    <?php the_listing_saledate(); ?> for <?php the_listing_saleprice(); ?> - last offered<?php }
		     elseif(get_listing_status() == "For Rent") {?> 
		       - <?php the_listing_listprice(); ?> Per Month <?php }
		     else { ?> - Offered at <?php the_listing_listprice(); } ?></h3>
		     
 	<?php $line1 = ''; $line2 = ''; ?>

 	<div class="page-blurb"><?php the_listing_blurb(); ?></div>
	<?php if ($bedrooms = get_listing_bedrooms()) 
		$line1 .= "<li>$bedrooms Bed</li>"; ?>
	<?php if ($bathrooms = get_listing_bathrooms()) {
		$line1 .= "<li>$bathrooms Full ";
		if ($halfbaths = get_listing_halfbaths()) 
			$line1 .= "&amp; $halfbaths Half ";
		$line1 .= " Bath</li>"; 
              }	?>
	<?php if ($garage = get_listing_garage()) 
		$line1 .= "<li>$garage Car Garage</li>"; ?>
	<?php if ($acsf = get_listing_acsf()) 
		$line2 .= "<li>$acsf Sq/Ft Under Air</li>"; ?>
	<?php if ($totsf = get_listing_totsf()) 
		$line2 .= "<li>$totsf Sq/Ft Total</li>"; ?>
	<?php $acres = get_listing_acres(); ?>
	<?php if ($acres > 0) $line2 .= "<li>$acres Acres</li>"; ?>
	
 	<?php if ($line1 || $line2 || $propstatus) { ?>
      <div class='tab-container'>
         <?php the_listing_map_content(); // recommend this be first ?>
         <div id="details" class="tab-content">
           <?php the_listing_description_content(); ?>
           <div id="propdata">
	           <?php if ($line1) echo "<ul id='propdata-line-1' class='single-propdata-line'>$line1</ul>"; ?>
	           <?php if ($line2) echo "<ul id='propdata-line-2' class='single-propdata-line'>$line2</ul>"; ?><br />
	        </div>
	        <?php if($listing_tags = get_the_tags()) { ?>
	        <h3>Additional Features:</h3>
	        <?php the_tags('<ul><li>','</li><li>','</li></ul>'); }?>
	     </div>
	     <?php the_listing_gallery_content(); ?>
      </div>
</div>
	<?php } ?>
<?php } else { ?>
<?php the_content(); // plugin disabled, just spit out the normal content ?>
<?php } ?>

</div>

<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
      <?php endwhile; ?>
      <?php else : ?>
         <p>Sorry, there is nothing to display</p>
      <?php endif; ?>
     </div>
     
     </div>
     <?php get_sidebar(); ?>
     </div>
     <script type="text/javascript" >
      jQuery(document).ready(function() {

	     //When page loads...
	     jQuery("div.tab-content").hide();
	     jQuery("ul.tabnav li:first").addClass("active").show(); //Activate first tab
	     jQuery("#map").show(); //Show first tab content

	     //On Click Event    
	     jQuery("ul.tabnav li").click(function() {

		    jQuery("ul.tabnav li").removeClass("active"); //Remove any "active" class
		    jQuery(this).addClass("active"); //Add "active" class to selected tab
		    jQuery("div.tab-content").hide(); //Hide all tab content

		    var activeTab = jQuery(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		    jQuery(activeTab).fadeIn(); //Fade in the active ID content
		    return false;
	       });

      });

      </script>
   <!-- End Content -->
<?php get_footer(); ?>