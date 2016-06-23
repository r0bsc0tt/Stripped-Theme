<?php
/*
Author: r0bsc0tt
URL: http://robjscott.com
*/

add_action('customize_register', 'r0bsc0tt_branding_customize');
function r0bsc0tt_branding_customize($wp_customize) {
    // add settings section for theme options
    $wp_customize->add_section( 'r0bsc0tt_settings', array(
        'title'          => __('Theme Settings', 'stripped'),
    ) );

    // remove header image
    remove_theme_support( 'custom-header' );

/************************
CONTACT INFO
************************/

    //BUSINESS NAME
    $wp_customize->add_setting( 'r0bsc0tt_bizName', array(
        'default'        => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
 
    $wp_customize->add_control( 'r0bsc0tt_bizName', array(
        'label'   => __('Business Name:', 'stripped'),
        'section' => 'r0bsc0tt_settings',
        'type'    => 'text',
    ) );

	//PHONE NUMBER
    $wp_customize->add_setting( 'r0bsc0tt_phoneNumber', array(
        'default'        => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
 
    $wp_customize->add_control( 'r0bsc0tt_phoneNumber', array(
        'label'   => __('Phone Number:', 'stripped'),
        'section' => 'r0bsc0tt_settings',
        'type'    => 'text',
    ) );

	//EMAIL ADDRESS
    $wp_customize->add_setting( 'r0bsc0tt_emailAddress', array(
        'default'        => '',
        'sanitize_callback' => 'sanitize_email',

    ) );
 
    $wp_customize->add_control( 'r0bsc0tt_emailAddress', array(
        'label'   => __('Email Address:', 'stripped'),
        'section' => 'r0bsc0tt_settings',
        'type'    => 'email',
    ) );

    //OFFICE ADDRESS
    $wp_customize->add_setting( 'r0bsc0tt_officeAddressStreet', array(
        'default'        => '',
        'sanitize_callback' => 'sanitize_text_field',

    ) );
 
    $wp_customize->add_control( 'r0bsc0tt_officeAddressStreet', array(
        'label'   => __('Street Address:', 'stripped'),
        'section' => 'r0bsc0tt_settings',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'r0bsc0tt_officeAddressCity', array(
        'default'        => '',
        'sanitize_callback' => 'sanitize_text_field',

    ) );
 
    $wp_customize->add_control( 'r0bsc0tt_officeAddressCity', array(
        'label'   => __('City:', 'stripped'),
        'section' => 'r0bsc0tt_settings',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'r0bsc0tt_officeAddressState', array(
        'default'        => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
 
    $wp_customize->add_control( 'r0bsc0tt_officeAddressState', array(
        'label'   => __('State:', 'stripped'),
        'section' => 'r0bsc0tt_settings',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'r0bsc0tt_officeAddressZip', array(
        'default'        => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
 
    $wp_customize->add_control( 'r0bsc0tt_officeAddressZip', array(
        'label'   => __('Zip Code:', 'stripped'),
        'section' => 'r0bsc0tt_settings',
        'type'    => 'text',
    ) );


/************************
BRANDING & COLORS
************************/
	//LOGO 
	$wp_customize->add_setting( 'r0bsc0tt_logo', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'r0bsc0tt_logo', array(
        'label'    => __('Logo', 'stripped'),
        'section'  => 'r0bsc0tt_settings',
        'settings' => 'r0bsc0tt_logo',
    )));  


	//MAIN BRANDING COLOR
    $wp_customize->add_setting( 'r0bsc0tt_branding_primary_color_setting', array(
        'default'               => '#000000',
        'sanitize_callback'     => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'r0bsc0tt_branding_primary_color_setting', array(
        'label'         => __('Primary Branding Color', 'stripped' ),
        'section'       => 'colors',
        'settings'      => 'r0bsc0tt_branding_primary_color_setting'
    )));


	//SECONDARY BRANDING COLOR
    $wp_customize->add_setting( 'r0bsc0tt_branding_secondary_color_setting', array(
        'default'           => '#000000',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'r0bsc0tt_branding_secondary_color_setting', array(
        'label'         => __('Secondary Branding Color', 'stripped' ),
        'section'       => 'colors',
        'settings'      => 'r0bsc0tt_branding_secondary_color_setting'
    )));


    //LINK & BUTTON COLOR
    $wp_customize->add_setting( 'r0bsc0tt_link_color_setting', array(
        'default'           => '#000000',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'r0bsc0tt_link_color_setting', array(
        'label'         => __('Link & Button Color', 'stripped'),
        'section'       => 'colors',
        'settings'      => 'r0bsc0tt_link_color_setting'
    )));

}

function r0bsc0tt_bizName_callback(){
    if (get_theme_mod('r0bsc0tt_bizName')) {
        echo get_theme_mod('r0bsc0tt_bizName');
    }else{
        echo bloginfo('name');
    }
}