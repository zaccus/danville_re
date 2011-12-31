<?php get_header(); ?>

   <!-- Begin Content -->
   <div id="container">
      <div id="content">
      <span class="hidden"><?php  $the_tag = single_tag_title(); ?></span>
              <?php $tag_query_args = array(
                  'tag' => $the_tag,
                  'showposts'=>5,
                  'caller_get_posts'=>1);
               $tag_query = new WP_Query($tag_query_args);
               if( $tag_query->have_posts() ) : ?>
            <span id="active-heading" class="news_cycle"><h2>Tag: <?php single_tag_title(); ?></h2></span>
         <div id="page-content-inner" class="prop-box">
            <?php
               single_tag_title("Pages with tag ");
               while ($tag_query->have_posts()) : $tag_query->the_post(); ?>
        <p><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></p>
       
         </div>
      <?php endwhile; //if ($my_query) ?>
      <?php else : ?>
         <p>There are no posts to display</p>
      <?php endif; ?>
      <?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>
      <?php get_sidebar(); ?><br />
     </div>     
   <!-- End Content -->
<?php get_footer(); ?>