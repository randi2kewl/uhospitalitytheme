<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Config;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Config\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

/**
 * WordPress register with email only, make it possible to register with email
 * as username in a multisite installation
 * @param  Array $result Result array of the wpmu_validate_user_signup-function
 * @return Array         Altered result array
 */
function custom_register_with_email($result) {

  if ( $result['user_name'] != '' && is_email( $result['user_name'] ) ) {
    unset( $result['errors']->errors['user_name'] );
  }

  return $result;
}
add_filter('wpmu_validate_user_signup','custom_register_with_email');

add_filter('sage/wrap_base', __NAMESPACE__ . '\\sage_wrap_base_cpts'); // Add our function to the sage/wrap_base filter

function sage_wrap_base_cpts($templates) {
  $cpt = get_post_type(); // Get the current post type
  if ($cpt) {
    array_unshift($templates, 'base-' . $cpt . '.php'); // Shift the template to the front of the array
  }
  return $templates; // Return our modified array with base-$cpt.php at the front of the queue
}

function add_login_logout_link($items, $args) {

  if($args->theme_location == 'primary_navigation') {

    ob_start();
    wp_loginout('index.php');
    $loginoutlink = ob_get_contents();
    ob_end_clean();

    if(is_user_logged_in()) {
      $items .= '<li class="btn btn-blue btn-outlined menu-item"><a href="'.bp_loggedin_user_domain().'">Account</a></li>';
      $items .= '<li class="btn btn-light btn-outlined menu-item"><a href="'.wp_logout_url( '/' ).'">Logout</a></li>';
    } else {
      $items .= '<li class="btn btn-blue btn-outlined registration-button menu-item"><a href="#">Sign Up</a></li>';
      $items .= '<li class="btn btn-light btn-outlined login-button menu-item"><a href="#">Login</a></li>';
    }

  }
  
  return $items; 
}
add_filter('wp_nav_menu_items', __NAMESPACE__ . '\\add_login_logout_link', 10, 2);

function remove_user_posts_column($column_headers) {
  // Remove
  unset($column_headers['posts']);
  unset($column_headers['role']);
  unset($column_headers['email']);

  // Add
  $column_headers['discussions'] = 'Discussions';
  $column_headers['comments'] = 'Comments';
  $column_headers['creation_date'] = 'Created';

  return $column_headers;
}
add_action('manage_users_columns', __NAMESPACE__ . '\\remove_user_posts_column');

function manage_users_lstdisplay($value, $column_name, $user_id) {
  $user = get_userdata( $user_id );

  switch($column_name) {
    case 'discussions':
      return count_user_posts( $user_id, "question" );
      break;

    case 'comments':
      $comments = get_comments(array(
          'user_id' => $user_id, // use user_id
          'count' => true //return only the count
      ));
      return $comments;
      break;

    case 'creation_date':
      return date( 'n/d/Y', strtotime( $user->user_registered ) );
      break;

    default:
      return $value;
      break;
  }
}
add_action('manage_users_custom_column', __NAMESPACE__ . '\\manage_users_lstdisplay', 10, 3);