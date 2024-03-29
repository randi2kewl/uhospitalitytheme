<?php

namespace Roots\Sage\Init;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain('sage', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'sage'),
    'footer_navigation' => __('Footer Navigation', 'sage')
  ]);

  // Add post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');

  // Add post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Add HTML5 markup for captions
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list']);

  // Tell the TinyMCE editor to use a custom stylesheet
  add_editor_style(Assets\asset_path('styles/editor-style.css'));

  // Disable the admin bar for non-admins
  // https://codex.wordpress.org/Function_Reference/show_admin_bar
  if( ! current_user_can('administrator') && ! is_admin() ) {
    add_filter('show_admin_bar', '__return_false');
  }
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init() {
  register_sidebar([
    'name'          => __('Primary', 'sage'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Footer', 'sage'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');


function infinite_scroll_render() {
  while (have_posts()) : the_post();
  $post_type = (get_post_type() != 'post') ? get_post_type() : get_post_format();

  if($post_type == 'question') {
    $post_type = 'q';
  }
    get_template_part('templates/content', $post_type);
  endwhile;
}

function infinite_scroll_init() {
  add_theme_support( 'infinite-scroll', array(
      'type'           => 'click',
      'footer'         => 'footer-social-links',
      'footer_widgets' => false,
      'container'      => 'content',
      'wrapper'        => true,
      'render'         =>  __NAMESPACE__ . '\\infinite_scroll_render',
      'posts_per_page' => false,
  ) );

}
add_action( 'init', __NAMESPACE__ . '\\infinite_scroll_init' );

function user_setup_after_registration( $user_id ) {
    $user_email = $_POST['input_8'];

    $sent = \wpMandrill::mail(
        $user_email, //to email
        "Welcome to Uhospitality!", //subject
        "", //html
        "", //headers
        array(), //attachments
        array('new_member'), //tags
        "Uhospitality", //from name
        "anandp@myriann.com", //from email
        "wp_welcome_email" // template name
    );
}
add_action( 'user_register', __NAMESPACE__ . '\\user_setup_after_registration', 10, 1);
