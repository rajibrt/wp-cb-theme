<?php 
/*
*My Theme Functions
*/

// Theme Title
add_theme_support('title-tag' );

// Theme CSS and jQuery File Calling Function
function cb_css_js_file_calling(){
wp_enqueue_style('cb-style', get_stylesheet_uri());
wp_register_style('bootstrap', get_template_directory_uri().'/css/bootstrap.css', array(),'v5.3.0', 'all');
wp_register_style('custom', get_template_directory_uri().'/css/custom.css', array(),'1.0.0', 'all');
wp_enqueue_style('bootstrap');
wp_enqueue_style('custom');

// jQuery
wp_enqueue_script('jquery');
wp_enqueue_script('bootstrap', get_template_directory_uri().'/js/bootstrap.js',array(), '5.0.2', 'true');
wp_enqueue_script('main', get_template_directory_uri().'/js/bootstrap.js',array(), '1.0.0', 'true');
wp_enqueue_script('main');
}
add_action('wp_enqueue_scripts', 'cb_css_js_file_calling');

// Google Fonts Enqueue
function cb_add_google_fonts(){
    wp_enqueue_style('cb_google_fonts', 'https://fonts.googleapis.com/css2?family=Kaisei+Decol&family=Oswald&display=swap', false);
  }
  add_action('wp_enqueue_scripts', 'cb_add_google_fonts');
  

// Theme Functions
function cb_customize_register($wp_customize){

    // Header Area Functions
    $wp_customize->add_section('cb_header_area', array(
        'title' => __('Header Area','kayum'),
        'description' => 'If you interested to update your header area, you can do it from here.',
    ));

    $wp_customize->add_setting('cb_logo', array(
        'default' => get_bloginfo('template_directory') . '/img/logo.png',
    ));

    $wp_customize-> add_control(new WP_Customize_Image_Control($wp_customize, 'cb_logo', array(
        'label' => 'Logo Upload',
        'description' => 'If you interested to update the site logo, you can do it from here.',
        'settings' => 'cb_logo',
        'section' => 'cb_header_area',
    )));

  // Menu Position Option
  $wp_customize->add_section('cb_menu_option', array(
    'title' => __('Menu Position Option', 'kayum'),
    'description' => 'If you interested to change your menu position you can do it.'
  ));

  $wp_customize->add_setting('cb_menu_position', array(
    'default' => 'right_menu',
  ));

  $wp_customize-> add_control('cb_menu_position', array(
    'label' => 'Menu Position',
    'description' => 'Select your menu position',
    'setting' => 'cb_menu_position',
    'section' => 'cb_menu_option',
    'type' => 'radio',
    'choices' => array(
      'left_menu' => 'Left Menu',
      'right_menu' => 'Right Menu',
      'center_menu' => 'Center Menu',
    ),
  ));

  // Footer Option
  $wp_customize->add_section('cb_footer_option', array(
    'title' => __('Footer Option', 'kayum'),
    'description' => 'If you interested to change your footer setting you can do it.'
  ));

  $wp_customize->add_setting('cb_copyright_section', array(
    'default' => '&copy; Copyright 2023 | Powered by Raisha Host',
  ));

  $wp_customize-> add_control('cb_copyright_section', array(
    'label' => 'Copyright Text',
    'description' => 'Copyright Text Here',
    'setting' => 'cb_copyright_section',
    'section' => 'cb_footer_option',
    ));   
}

add_action('customize_register','cb_customize_register');

// Menu Register
register_nav_menu('main_menu', __('Main Menu', 'kayum'));

// Menu Item Description
function cb_nav_description( $item_output, $item, $args){
    if( !empty ($item->description)){
      $item_output = str_replace($args->link_after . '</a>', '<span class="walker_nav">' . $item->description . '</span>' . $args->link_after . '</a>', $item_output);
    }
    return $item_output;
  }

  add_filter('walker_nav_menu_start_el', 'cb_nav_description', 10, 3);
