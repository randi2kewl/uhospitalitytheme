<?php
if (post_password_required()) {
  return;
}
?>

<section id="comments" class="comments">

  <?php if (!comments_open() && get_comments_number() != '0' && post_type_supports(get_post_type(), 'comments')) : ?>
    <div class="alert alert-warning">
      <?php _e('Comments are closed.', 'sage'); ?>
    </div>
  <?php endif; ?>

  <?php comment_form([
    'comment_notes_after'   => '',
    'label_submit'          => 'Comment',
    'submit_button'         => '<input name="%1$s" type="submit" id="%2$s" class="%3$s comment-button" value="%4$s" />',
    'logged_in_as'          => '',
    'title_reply'           => '',
    'class_submit'          => 'btn btn-green pull-right',
    'comment_notes_before'  => '',
    'title_reply'           => '',
    'title_reply_to'        => '',
    'cancel_reply_link'     => '',
    'comment_field'         => '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><textarea id="comment" name="comment" cols="45" rows="8" aria-describedby="form-allowed-tags" aria-required="true" required="required"></textarea></div></div>'
  ]); ?>

  <?php if (have_comments()) : ?>
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <?= get_comments_number_text(); ?>
        </div>
      </div>
    <?php $comments = get_approved_comments(get_the_ID()); ?>

      <?php foreach( $comments as $comment ) { ?>
        <div class="row the-comment">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <hr>
          </div>
          <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
            <?= bp_core_fetch_avatar ( array( 'item_id' => $comment->user_id, 'type' => 'thumb' ) ) ?>
          </div>

          <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">

            <div class="row">
              <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-left">
                by <?php bp_core_get_userlink($comment->user_id); ?>
              </div>

              <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
                <?= date('n/d/Y', strtotime($comment->comment_date)); ?>
              </div>

              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?= $comment->comment_content; ?>
              </div>
            </div>

          </div>
        </div>

      <?php } ?>
    <?php if (count($comments) > 1 && get_option('page_comments')) : ?>
      <nav>
        <ul class="pager">
          <?php if (get_previous_comments_link()) : ?>
            <li class="previous"><?php previous_comments_link(__('&larr; Older comments', 'sage')); ?></li>
          <?php endif; ?>
          <?php if (get_next_comments_link()) : ?>
            <li class="next"><?php next_comments_link(__('Newer comments &rarr;', 'sage')); ?></li>
          <?php endif; ?>
        </ul>
      </nav>
    <?php endif; ?>
  <?php endif; // have_comments() ?>
</section>