<!-- Begin Footer -->
  
   <div id="footer">
      <div id="footer-sidebar" class="secondary">
         <ul>
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer') ) : ?>
               <!-- Widgets go here -->
            <?php endif; ?>
         </ul>
      </div>
      <div class="clearboth"></div>
      
   </div><br />
<!-- More Plugin Meta -->
<?php wp_footer(); ?>
<!--End Plugin Meta-->
<div id="credits">
    <p>All Contents &copy Ella Mae Dexter | Theme Design by Zach Dexter | Powered by Wordpress</p>
</div>
</body>
</html>