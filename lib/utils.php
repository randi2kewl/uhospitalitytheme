<?php

namespace Roots\Sage\Utils;

/**
 * Tell WordPress to use searchform.php from the templates/ directory
 */
function get_search_form() {
  $form = '';
  locate_template('/templates/searchform.php', true, false);
  return $form;
}
add_filter('get_search_form', __NAMESPACE__ . '\\get_search_form');

/*
 * Get time difference in format of "1 day ago" or "6 hours ago"
 */
function humanTiming ($time)
{
    $time = time() - strtotime($time); // to get the time since that moment

    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'') . ' ago';
    }
}

// Took from Q&A plugin but needed the word Comment instead of Answer
function uh_answer_count( $question_id = 0 ) {
    $comments = get_comment_count( $question_id ? $question_id : get_the_ID() );

    if($comments) {
        $count = $comments['approved'];
    } else {
        $count = 0;
    }

    return sprintf( _n( '1 Comment', '%d Comments', $count, QA_TEXTDOMAIN ), number_format_i18n( $count ) );
}

function csv_upload_import( $entry, $form ) {
global $bp, $wpdb;

  $bp->group_invite_email = new \stdClass();

/* For internal identification */
  $bp->group_invite_email->id = 'group_invite_email';
  $bp->group_invite_email->table_name = $wpdb->base_prefix . 'bp_group_invite_email';
  $bp->group_invite_email->format_notification_function = 'bp_group_invite_email_format_notifications';

    /* For internal identification */
    $bp->group_invite_email->id = 'group_invite_email';
    $bp->group_invite_email->table_name = $wpdb->base_prefix . 'bp_group_invite_email';
    $bp->group_invite_email->format_notification_function = 'bp_group_invite_email_format_notifications';
    
    if ( ! class_exists( '\\BP_Groups_Group' ) || ! class_exists( '\\BP_Group_Invite_Email' )  )
        return;

     $file = rgar( $entry, '1' );
     $handle = fopen($file, 'r');

     //skip first row for headers
     fgetcsv($handle);

     while( ($row = fgetcsv($handle) ) !== FALSE ) {

        if(isset($row[0]) && isset($row[1])) {
 
            $new_group = new \BP_Groups_Group();

            if(! isset($row[2])) {
                $row[2] = 1;
            }

            $slug = strtolower(str_replace(' ', '_', $row[1]) . $row[2]);

            $new_group->id = \BP_Groups_Group::get_id_from_slug($slug);

            if(empty($new_group->id)) {
                $new_group->creator_id   = $bp->loggedin_user->id;
                $new_group->name         = stripslashes( $row[1] );
                $new_group->slug         = $slug;
                $new_group->description  = '';
                $new_group->status       = 'hidden';
                $new_group->enable_forum = 0;
                $new_group->date_created = $group->date_created;

         
                $check = $new_group->save();

                if($id = $new_group->id) {
                    groups_update_groupmeta( $id, "total_member_count", 1 );
                    groups_update_groupmeta( $id, "last_activity", time() );
                    groups_update_groupmeta( $id, "invite_status", "mods" );
                }
            }



            if($new_group->id) {
                //now add the student to that group
                $invite = new \BP_Group_Invite_Email();
                $invite->recipient_email = trim($row[0]);
                $invite->group_id = $new_group->id;
                $invite->sender_id = $bp->loggedin_user->id;
                $invite->send_email();
                $invite->save();

                groups_join_group( $new_group->id );
                groups_promote_member( $bp->loggedin_user->id, $new_group->id, 'mod' );
            }
        }
     }

     fclose($handle);
}
add_action( 'gform_after_submission_4', __NAMESPACE__ . '\\csv_upload_import', 10, 2 );

function string_part($input = "", $maxLen = 180) {
    if ( strlen($input) > $maxLen)
        return substr($input, 0, $maxLen) . '...';
    else
        return $input;
}

function user_is_teacher( $user_id = null ) {

    if ( ! $user_id ) {
        $user_id = get_current_user_id();
    }

    $types = bp_get_member_type($user_id, false);
    
    if ( is_array($types) ) {
        return in_array('teacher', $types);
    } else {
        return 'teacher' === $types;
    }    
}
