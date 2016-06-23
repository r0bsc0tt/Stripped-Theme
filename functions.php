<?php
/*
Author: r0bsc0tt
URL: http://robjscott.com
*/

require_once( 'library/r0bsc0tt_functions.php');
require_once( 'library/r0bsc0tt_theme_options.php' );
require_once( 'library/r0bsc0tt_social_options.php' );

function load_r0bsc0tt_theme_settings(){
  //Allow editor style.
  add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );
  // add language support
  load_theme_textdomain( 'stripped', get_template_directory() . '/library/translation' );
  // cleanup head
  add_action( 'init', 'r0bsc0tt_cleanup_head' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'r0bsc0tt_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'r0bsc0tt_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'r0bsc0tt_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'r0bsc0tt_gallery_style' );
  // enqueue scripts and styles
  add_action( 'wp_enqueue_scripts', 'r0bsc0tt_styles_and_scripts', 999 );
  // cleaning up random code around images
  add_filter( 'the_content', 'r0bsc0tt_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'r0bsc0tt_excerpt_more' );
  // add theme support items
  r0bsc0tt_theme_support();
  // adding sidebars for sidebar and footer
  add_action( 'widgets_init', 'r0bsc0tt_register_sidebars' );
  // add image sizes to dropdown in media gallery
  add_filter( 'image_size_names_choose', 'r0bsc0tt_custom_image_sizes' );
}
add_action('after_setup_theme','load_r0bsc0tt_theme_settings');