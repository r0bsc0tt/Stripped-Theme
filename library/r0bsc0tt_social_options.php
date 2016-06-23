<?php
/*
Author: r0bsc0tt
URL: http://robjscott.com
*/

function social_media_accounts_translated(){
//use these sites (all are included in genericons)
$social_media_accounts = array(
  __('Facebook', 'stripped'),
  __('Twitter', 'stripped'),
  __('Google', 'stripped'),
  __('LinkedIn', 'stripped'),
  __('Pinterest', 'stripped'),
  __('Flickr', 'stripped'),
  __('Vimeo', 'stripped'),
  __('YouTube', 'stripped'),
  __('Tumblr', 'stripped'),
  __('Instagram', 'stripped'),
  __('github', 'stripped'),
  __('Dribble', 'stripped'),
  __('WordPress', 'stripped'),
  __('CodePen', 'stripped'),
  __('PollDaddy', 'stripped'),
  __('Path', 'stripped'),
  __('Skype', 'stripped'),
  __('Digg', 'stripped'),
  __('reddit', 'stripped'),
  __('StumbleUpon', 'stripped'),
  __('Pocket', 'stripped'),
  __('Dropbox', 'stripped'),
  __('FourSquare', 'stripped')
);
return $social_media_accounts;
}

//add customizer settings for social media profiles
add_action('customize_register', 'r0bsc0tt_social_customize');
function r0bsc0tt_social_customize($wp_customize) {
  //add social media profiled section
  $wp_customize->add_section( 'r0bsc0tt_social_settings_new', array(
    'title'          => 'Social Media Profiles',
  ));
  // create controls and settings for social media accoutnts
  $social_media_accounts = social_media_accounts_translated();
  foreach ($social_media_accounts as $account => $name) {
    $wp_customize->add_setting('r0bsc0tt_social_'.$name.'', array(
      'default'        => '',
      'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control( 'r0bsc0tt_social_'.$name.'', array(
      'label'   => $name,
      'section' => 'r0bsc0tt_social_settings_new',
      'type'    => 'url',
    ));
  }
}

// Use this function to dislay genericon link for social media account
function r0bsc0tt_social_callback(){ 
  $social_media_accounts = social_media_accounts_translated();
  //loop through to get accounts, then use genericons to display a link to each
  foreach ($social_media_accounts as $account => $name) {
  	if (get_theme_mod('r0bsc0tt_social_'.$name.'')) {
    		echo '<a href="'.get_theme_mod('r0bsc0tt_social_'.$name.'').'" class="r0bsc0tt-social-icons" id="r0bsc0tt-social-'.strtolower($name).'" target="_blank"><span>'.$name.'</span></a>'. PHP_EOL;
    }
  }
}