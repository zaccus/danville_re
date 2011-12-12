<?php get_header(); ?>

   <!-- Begin Content -->
   <div id="container">
      <div id="content">
      <span id="featured-heading" class="news_cycle"><h1>Featured Homes</h1></span>
        <div id="slideshow">
         <?php
	        $pageposts = get_pages_with_featured_listings('','random');
         ?>
         <?php if ($pageposts): ?>
               <?php foreach ($pageposts as $post): ?>
		          <?php setup_postdata($post); ?>
		          <?php setup_listingdata($post); ?>
            <div class="slide">
		          <div class="slide-image">
	                 <a href="<?php the_permalink() ?>" rel="bookmark" title="More about <?php the_title(); ?>">
	                 <?php the_listing_thumbnail(); ?></a>
	             </div>
	            
	             <div class="slide-caption">
	             </div>
	              <div class="slide-text">
	                    <span class="slide-address"><?php the_listing_address(); ?></span>
	                    <span class="slide-city"><?php the_listing_city(); ?></span>
	                    <span class="slide-price"><?php the_listing_listprice(); ?></span>
	                    <span class="slide-bedbath"><?php the_listing_bedrooms(); ?> Bed <?php the_listing_bathrooms(); ?> Bath</span>
	             </div>
	         </div> 
         <?php endforeach; ?>
  
         <?php endif; ?>
          </div>  
      <ul id="slideshow_control">
      <li id="prev" class="slideshow-button">
         <img class="button-symbol" src="<?php bloginfo('template_directory'); ?>/images/left_arrow.png" alt="Previous" />
      </li>
	   <li id="pause" class="slideshow-button">
	     <img class="button-symbol" src="<?php bloginfo('template_directory'); ?>/images/pause_arrow.png" alt="Pause" />
	   </li>
	   <li id="next" class="slideshow-button">
	     <img class="button-symbol" src="<?php bloginfo('template_directory'); ?>/images/right_arrow.png" alt="Next" />
	   </li>
	   </ul>
	   <script type="text/javascript" >
      jQuery(document).ready(function() {
         
         jQuery('#slideshow').cycle( { 
            fx:     'scrollRight', 
            speed:  500, 
            timeout: 3000, 
            next:   '#next', 
            prev:   '#prev'
         });

         jQuery('#pause').toggle(function() {
            
            jQuery('#slideshow').cycle('pause');
            }, function() {
            
            jQuery('#slideshow').cycle('resume');
            });
         });
      </script>      
     <div id="index-content-right">
            <ul>
               <li class="content-right-text">
                  <p>Upside down on your home mortgage? Looking for a way to avoid foreclosure and get out of debt?</p>
               </li>
               <li class="content-right-button"><a href="<?php bloginfo('url'); ?>/short-sales/" >Click Here To Take The First Step</a></li>
               <li class="content-right-text">
                  <p>Wondering how much your home is actually worth? Trust a local Realtor who knows the market.</p>
               </li>
               <li class="content-right-button"><a href="<?php bloginfo('url'); ?>/home-value-analysis/" >Click Here For A Free Home Value Analysis</a></li>
            </ul>
     </div>
     <div class="clearboth"></div>
     
     </div>    
   </div>
   <!-- End Content -->
   <?php get_footer(); ?>