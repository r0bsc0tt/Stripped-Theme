<?php
/*
Author: r0bsc0tt
URL: http://robjscott.com
*/

//Remove some of the things i do not like in WP head
function r0bsc0tt_cleanup_head(){
  // remove rsd link
  remove_action( 'wp_head', 'rsd_link' );
  // remove windows live writer
  remove_action( 'wp_head', 'wlwmanifest_link' );
  // remove relational link
  remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
  remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
  remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); 
  // remove WP generator meta tag showing WP version
  remove_action( 'wp_head', 'wp_generator' );
  // remove WP version from css
  add_filter( 'style_loader_src', 'r0bsc0tt_remove_wp_ver_css_js', 9999 );
  // remove WP version from scripts
  add_filter( 'script_loader_src', 'r0bsc0tt_remove_wp_ver_css_js', 9999 );
}


// A better title - http://deluxeblogtips.com/2012/03/better-title-meta-tag.html
function rw_title( $title, $sep, $seplocation ) {
  global $page, $paged;
  // Don't affect in feeds.
  if ( is_feed() ) return $title;
  // Add the blog's name
  if ( 'right' == $seplocation ) {
    $title .= get_bloginfo( 'name' );
  } else {
    $title = get_bloginfo( 'name' ) . $title;
  }
  // Add the blog description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title .= " {$sep} {$site_description}";
  }
  // Add a page number if necessary:
  if ( $paged >= 2 || $page >= 2 ) {
    $title .= " {$sep} " . sprintf( __( 'Page %s', 'stripped' ), max( $paged, $page ) );
  }
  return $title;
}


// remove WP version from RSS
function r0bsc0tt_rss_version() { return ''; }


// remove WP version from scripts. part deux.
function r0bsc0tt_remove_wp_ver_css_js( $src ) {
  if ( strpos( $src, 'ver=' ) )
    $src = remove_query_arg( 'ver', $src );
  return $src;
}


// remove recent comments widget style
function r0bsc0tt_remove_wp_widget_recent_comments_style() {
  if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' )) {
    remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
  }
}


// remove injected CSS from recent comments widget
function r0bsc0tt_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
  }
}


// remove injected CSS from gallery
function r0bsc0tt_gallery_style($css) {
  return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}


//Add styles & scripts 
function r0bsc0tt_styles_and_scripts() {
  global $wp_styles;  
  if (!is_admin()) {
    // modernizr (without media query polyfill)
    wp_register_script( 'r0bsc0tt-modernizr', get_stylesheet_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array(), '2.5.3', false );
    // register main stylesheet
    wp_register_style( 'r0bsc0tt-stylesheet', get_stylesheet_directory_uri() . '/library/css/style.css', array(), '', 'all' );
    // ie-only style sheet
    wp_register_style( 'r0bsc0tt-ie-only', get_stylesheet_directory_uri() . '/library/css/ie.css', array(), '' );
    //genericons
    wp_register_style('genericons', get_stylesheet_directory_uri() . '/library/css/fonts/genericons/genericons.css', array(), '', 'all' );
    //other javascripts in the footer
    wp_register_script( 'r0bsc0tt-js', get_stylesheet_directory_uri() . '/library/js/scripts.js', array( 'jquery' ), '', true );

    // comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script( 'comment-reply' );
    }
  
    // enqueue styles and scripts
    wp_enqueue_script( 'r0bsc0tt-modernizr' );
    wp_enqueue_style( 'r0bsc0tt-stylesheet' );
    wp_enqueue_style( 'r0bsc0tt-ie-only' );
    wp_enqueue_style( 'genericons' );
    $wp_styles->add_data( 'r0bsc0tt-ie-only', 'conditional', 'lt IE 9' ); // add conditional wrapper around ie stylesheet
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'r0bsc0tt-js' );
  }
}


// remove the p tags from around imgs
function r0bsc0tt_filter_ptags_on_images($content){
  return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}


// This removes the annoying […] to a Read More link
function r0bsc0tt_excerpt_more($more) {
  global $post;
  return '...  <a class="excerpt-read-more" href="'. get_permalink( $post->ID ) . '" title="'. __( 'Read ', 'stripped' ) . esc_attr( get_the_title( $post->ID ) ).'">'. __( 'Read more &raquo;', 'stripped' ) .'</a>';
}


// Change Comment Layout
function r0bsc0tt_comments( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php $bgauthemail = get_comment_author_email(); ?>
        <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'stripped' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'stripped' ),'  ','') ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'stripped' )); ?> </a></time>
      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'stripped' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WP automatically
}


// author info with gravatar
function r0bsc0tt_author_info(){ ?>
<div class="author">
  <div class="author-avatar"> 
    <a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
      <?php echo get_avatar( get_the_author_meta( 'user_email' ) );?>
    </a>
  </div>
  <div class="author-info">
  <p>Posted by</p>
  <a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
    <span class="entry-author" itemprop="author" itemscope itemptype="http://schema.org/Person">
      <?php 
          if (get_the_author_meta('first_name') || get_the_author_meta('last_name')) {
            echo the_author_meta('first_name')." ";
            echo the_author_meta('last_name'); 
          }else{
            echo the_author_meta('user_nicename');
          }
      ?>
    </span>
  </a><time class="updated entry-time" datetime="<?php echo get_the_time('Y-m-d'); ?>" itemprop="datePublished">
  <?php echo get_the_time(get_option('date_format')); ?> 
  </time>
</div> <?php
}


// add theme support for menus, thumbnails, html5, feed
function r0bsc0tt_theme_support() {
  // title tag
  add_theme_support('title-tag');
  // feed links
  add_theme_support('automatic-feed-links');

  // enable HTML5 markup support.
  add_theme_support( 'html5', array(
    'comment-list',
    'search-form',
    'comment-form'
  ));

  // add custom background
  add_theme_support( 'custom-background',
      array(
      'default-image' => '',
      'default-color' => '',
      'wp-head-callback' => '_custom_background_cb',
      'admin-head-callback' => '',
      'admin-preview-callback' => ''
      )
  );

  // wp menu support
  add_theme_support( 'menus' );

  // registering menus
  register_nav_menus(
    array(
      'main-menu' => __( 'The Main Menu', 'stripped' ),
      'footer-menu' => __( 'Footer Menu', 'stripped' )
    )
  );

  //add thumbnails
  add_theme_support('post-thumbnails');
  
  // default thumbnail size
  set_post_thumbnail_size(125, 125, true);

  //add image sizes
  add_image_size( 'r0bsc0tt-thumb-l', 825, 825, false );
  add_image_size( 'r0bsc0tt-thumb-m', 375, 375, false );
  add_image_size( 'r0bsc0tt-thumb-s', 150, 150, false );

  //set content width
  if ( ! isset( $content_width ) ) {
    $content_width = 680;
  }
}


// add image sizes to dropdown in media gallery
function r0bsc0tt_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
      'r0bsc0tt-thumb-l' => __('825px', 'stripped'),
      'r0bsc0tt-thumb-m' => __('375px', 'stripped'),
      'r0bsc0tt-thumb-s' => __('150px', 'stripped'),        
    ));
}


// add sidebars for sidebar and footer
function r0bsc0tt_register_sidebars() {
  register_sidebar(array(
    'id' => 'sidebar',
    'name' => __( 'Sidebar', 'stripped' ),
    'description' => __( 'The sidebar widgets.', 'stripped' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'footerwidgets',
    'name' => __( 'Footer Widgets', 'stripped' ),
    'description' => __( 'The footer widgets.', 'stripped' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));
}


// Page Navi 
function r0bsc0tt_page_navi() {
  global $wp_query;
  $bignum = 999999999;
  if ( $wp_query->max_num_pages <= 1 )
    return;
  echo '<nav class="pagination">';
  echo paginate_links( array(
    'base'         => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
    'format'       => '',
    'current'      => max( 1, get_query_var('paged') ),
    'total'        => $wp_query->max_num_pages,
    'prev_text'    => '&larr;',
    'next_text'    => '&rarr;',
    'type'         => 'list',
    'end_size'     => 3,
    'mid_size'     => 3
  ) );
  echo '</nav>';
}