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

function mb_profile_menu_tabs(){
  global $bp;

  if( \Roots\Sage\Utils\user_is_teacher( get_current_user_id() ) ) {
    $bp->bp_options_nav['settings']['invites'] = $bp->bp_options_nav['groups']['invites'];
    $bp->bp_options_nav['settings']['invites']['position'] = 20;
  }

  $bp->bp_options_nav['settings']['general']['position'] = 10;

  $bp->bp_options_nav['settings']['change-avatar'] = $bp->bp_options_nav['profile']['change-avatar'];
  $bp->bp_options_nav['settings']['change-avatar']['position'] = 30;


//  $bp->bp_options_nav['settings']

  unset($bp->bp_nav['activity']);
  unset($bp->bp_nav['profile']);
  unset($bp->bp_nav['notifications']);
  unset($bp->bp_nav['groups']);

  unset($bp->bp_options_nav['profile']);
  unset($bp->bp_options_nav['activity']);
  unset($bp->bp_options_nav['groups']);
  unset($bp->bp_options_nav['notifications']);

  unset($bp->bp_options_nav['settings']['profile']);
  unset($bp->bp_options_nav['settings']['notifications']);

  $bp->bp_nav['q-and-a']['name'] = 'View Profile';
}
add_action('bp_setup_nav', __NAMESPACE__ . '\\mb_profile_menu_tabs', 201);

function send_teacher_report_emails(){
  global $bp;

  if ( bp_has_groups( array('show_hidden' => true) ) ) {

    while ( bp_groups() ) {
      bp_the_group();

      $html = "<table>";
      $html .= "<tr><td>Name</td><td>Email</td><td>Created Discussions</td><td>Comments</td><td>Discussions Viewed</td></tr>";

      $args = array(
          'exclude_admin_mods' => true,
          'group_id' => bp_get_group_id()
      );

      if ( bp_group_has_members( $args ) ) {
        while( bp_members() ) {
          bp_the_member();

          $student_id = bp_get_member_user_id();

          $html .= "<tr>";

          // student name
          $html .=  "<td>" . bp_get_member_name() . "</td>";

          // student email
          $html.= "<td>" . bp_get_member_user_email() . "</td>";

          // number of created discussions
          $html .= "<td>" . intval(get_user_meta( $student_id, 'weekly_created_discussion_count', true )) . "</td>";
          update_user_meta( $student_id, 'weekly_created_discussion_count', 0 );

          // number of comments
          $html .= "<td>" . intval(get_user_meta( $student_id, 'weekly_created_comments_count', true )) . "</td>";
          update_user_meta( $student_id, 'weekly_created_comments_count', 0 );

          // number of discussions viewed
          $html .= "<td>" . intval(get_user_meta( $student_id, 'weekly_viewed_discussion_count', true )) . "</td>";
          update_user_meta( $student_id, 'weekly_viewed_discussion_count', 0 );

          // number of logins
          // $html .= "<td>" . intval(get_user_meta( $student_id, 'weekly_login_count', true )) . "</td>";
          update_user_meta( $student_id, 'weekly_login_count', 0 );

          $html .= "</tr>";
        }
      }

      $html .= "</table>";

       $args = array(
          'group_id' => bp_get_group_id(),
          'exclude_admin_mods' => false,
          'group_role' => array('mod', 'admin')
      );

      if ( bp_group_has_members($args) ) {
        while( bp_members() ) {
            bp_the_member();

            wp_mail( bp_get_member_user_email(), 'Weekly Usage Report: ' . bp_get_group_name(), $html );
        }
      }

    }
  }
}
add_action('weekly_report_emails', __NAMESPACE__ . '\\send_teacher_report_emails');
// add_action( 'qa_after_content', __NAMESPACE__ . '\\send_teacher_report_emails');

function activation_check() {
  if(!wp_next_scheduled('weekly_report_emails')) {
    wp_schedule_event( time(), 'weekly', 'weekly_report_emails' );
  }
}
add_action( 'wp', __NAMESPACE__ . '\\activation_check');

function uptick_weekly_discussion_count() {
    global $bp;

    $user_id = bp_loggedin_user_id();

    $current_count = intval(get_user_meta( $user_id, 'weekly_created_discussion_count', true ));
    update_user_meta( $user_id, 'weekly_created_discussion_count', $current_count + 1 );
}
add_action( 'qa_new_question_published', __NAMESPACE__ . '\\uptick_weekly_discussion_count');

function uptick_weekly_comments_count() {
    global $bp;

    $user_id = bp_loggedin_user_id();

    $current_count = intval(get_user_meta( $user_id, 'weekly_created_comments_count', true ));
    update_user_meta( $user_id, 'weekly_created_comments_count', $current_count + 1 );
}
add_action( 'qa_new_answer_published', __NAMESPACE__ . '\\uptick_weekly_comments_count');

function your_function($user_login, $user) {
    $current_count = intval(get_user_meta( $user->ID, 'weekly_login_count', true ));
    update_user_meta( $user->ID, 'weekly_login_count', $current_count + 1 );
}
add_action( 'wp_login', __NAMESPACE__ . '\\uptick_weekly_login_count');

function uptick_weekly_viewed_discussion_count() {
    global $bp;

    $user_id = bp_loggedin_user_id();

    $current_count = intval(get_user_meta( $user_id, 'weekly_viewed_discussion_count', true ));
    update_user_meta( $user_id, 'weekly_viewed_discussion_count', $current_count + 1 );
}
add_action( 'qa_after_content', __NAMESPACE__ . '\\uptick_weekly_viewed_discussion_count');
