<!DOCTYPE HTML>
<html>
<head>
<title><?php
			if(is_home()) {
				echo bloginfo('name');
		 	} else {
		 		echo wp_title('|', true, 'right'); bloginfo('name');
		 	}
		 ?></title>
<meta name="keywords" content="danville ky real estate, danville ky homes for sale, Danville  real estate, Junction City homes for sale, Junction City real estate listings, Stanford real estate agent, homes for sale in Stanford, Ella Mae Dexter" />
<meta name="descrption" content="Homes for sale in Stanford, Lancaster, Junction City, Perryville, and Harrodsburg" />
<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo(charset) ?>">

<!-- Begin Plugin Meta -->
<?php wp_head(); ?>
<!-- End Plugin Meta -->

<!--[if IE]>
<link href="<?php bloginfo('template_directory'); ?>/ie.css" rel="stylesheet" type="text/css">
<![endif]-->
<!--[if !IE]><!-->
<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css">
<!--<![endif]-->

<link href='http://fonts.googleapis.com/css?family=News+Cycle' rel='stylesheet' type='text/css'>
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<link rel="shortcut icon" href="<?php bloginfo(template_directory); ?>/images/favicon.ico">
</head>
<body>
<div id="wrapper">
   <div id="header">
      <div id="marquee_container"></div>
      <div id="header_photo"></div>
      <img id="portrait" src="<?php bloginfo('template_directory'); ?>/images/emd_portrait.jpg" alt="Ella Mae Dexter | Danville, KY Realtor" />      
      <div id="marquee">
         <a href="<?php bloginfo('url'); ?>" title="Home">
         <img id="logo" src="<?php bloginfo('template_directory'); ?>/images/emd_logo.png" alt="Home"></a>
         <span class="text-indent"><h1>Ella Mae Dexter</h1></span></a>
         <span id="tagline" class="news_cycle emboss"><h1><?php bloginfo(description); ?></h1></span>
         <span id="contact" class="news_cycle emboss"><h1>(859) 319 4608 | ellamae@dexteragency.com</h1></span>
         <div id="nav-container">
            <ul id="nav" class="news_cycle">
               <?php $list_pages_args = array("title_li" => "",
                                              "depth" => 1,
                                              "sort_column" => "menu_order",
                                              "include" => "5,51,22,26,24,64"); ?>
               <?php echo wp_list_pages($list_pages_args); ?>
            </ul>
         </div>
      </div>
      <a href="<?php bloginfo('rss2_url'); ?>" title="Subscribe To New Listings Feed"><div id="rss"></div></a>
      <a href="http://www.facebook.com/pages/Ella-Mae-Dexter-Realtor-Danville-Ky/" title="Facebook Page"><div id="facebook"></div></a>  
</div>
   <!-- End Header -->