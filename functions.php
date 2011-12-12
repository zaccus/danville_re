<?php 
if (function_exists('register_sidebar')){
      register_sidebar(array('name'         => 'Sidebar',
                             'before_widget'=> '<li><div class="sidebar-widget">',
                             'after_widget' => '</div></div></li>',
                             'before_title' => '<h2 class="news_cycle">',
                             'after_title'  => '</h2><hr class="widget-title-line"><div class="widget-content">'));
                             
       register_sidebar(array('name'        => 'Footer',
                             'before_widget'=> '<li><div class="footer-widget">',
                             'after_widget' => '</div></div></li>',
                             'before_title' => '<h2>',
                             'after_title'  => '</h2><div class="widget-content">'));
   }
?>