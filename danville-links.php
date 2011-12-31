<?php 
/*
Template Name: Danville Links
*/ 
?>

<?php get_header(); ?>

   <!-- Begin Content -->
   <div id="container">
     <div id="content">
            <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
            <span id="active-heading" class="news_cycle"><h2><?php the_title(); ?></h2></span>
         <div id="page-content-inner" class="prop-box">
            <?php the_content(); ?>
            <?php $bookmarks_args = array(
               'category_orderby' => 'id' ); ?>
            <?php wp_list_bookmarks($bookmarks_args); ?>
         </div>
      <?php endwhile; ?>
      <?php else : ?>
         <p>There are no posts to display</p>
      <?php endif; ?>
      <?php get_sidebar(); ?><br />
     </div>     
   <!-- End Content -->
<?php get_footer(); ?>