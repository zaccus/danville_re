<?php 
/*
Template Name: Search
*/ 
?>


<?php get_header(); ?>

   <!-- Begin Content -->
   <div id="container">
      <div id="content">
         <span id="active-heading" class="news_cycle"><h2><?php the_title(); ?></h2></span>
         <div id="page-content-inner" class="prop-box-avail">            
            <iframe src="http://www.ckar.net/" width="100%" height="600">
               <p>Your browser does not support iframes.</p>
            </iframe>
         </div>
         <?php get_sidebar(); ?><br />
     </div>     
   <!-- End Content -->
<?php get_footer(); ?>