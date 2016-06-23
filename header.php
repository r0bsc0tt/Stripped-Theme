<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">  
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   
  <title><?php wp_title(''); ?></title>
      
  <meta name="theme-color" content="#121212">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">  

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

  <div id="container">

    <header class="header" itemscope itemtype="http://schema.org/WPHeader">

      <div id="inner-header" class="wrap cf">

        <?php if (get_theme_mod('r0bsc0tt_logo')) { ?>
        <div id="logo">
          <a href="<?php echo home_url(); ?>" rel="nofollow">
            <img src="<?php echo get_theme_mod('r0bsc0tt_logo'); ?>" alt="<?php r0bsc0tt_bizName_callback(); ?>"/>
          </a>
        </div>
        <?php } else{ ?>
          <p id="logo" class="h1" itemscope itemtype="http://schema.org/Organization"><a href="<?php echo home_url(); ?>" rel="nofollow"><?php r0bsc0tt_bizName_callback(); ?></a></p>
        <?php } ?>
      
        <nav role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
            <?php wp_nav_menu(array(
                'container' => false,                           // remove nav container
                'container_class' => 'menu cf',                 // class of container (should you choose to use it)
                'menu' => __( 'The Main Menu', 'stripped' ),  // nav name
                'menu_class' => 'nav top-nav cf',               // adding custom nav class
                'theme_location' => 'main-menu',                // where it's located in the theme
                'before' => '',                                 // before the menu
                'after' => '',                                  // after the menu
                'link_before' => '',                            // before each link
                'link_after' => '',                             // after each link
                'depth' => 0,                                   // limit the depth of the nav
                'fallback_cb' => ''                             // fallback function (if there is one)
            )); ?>

        </nav>

      </div>

    </header>