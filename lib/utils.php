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