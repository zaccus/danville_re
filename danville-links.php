<?php 
/*
Template Name: Danville Links
*/ 
?>

<?php get_header(); ?>

   <!-- Begin Content -->
   <div id="container">
      <div id="content">
            <span id="active-heading" class="news_cycle"><h2><?php the_title(); ?></h2></span>
         <div id="page-content-inner" class="prop-box">
            <?php $bookmarks_args = array(
               'category_orderby' => 'id' ); ?>
            <?php wp_list_bookmarks($bookmarks_args); ?>
         </div>
      <?php get_sidebar(); ?><br />
     </div>     
   <!-- End Content -->
<?php get_footer(); ?>