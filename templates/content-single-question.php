<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>

    <div class="row light-grey">

      <div id="authorImage" class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xs-offset-1 text-right">
        <?= bp_core_fetch_avatar ( array( 'item_id' => $post->post_author, 'type' => 'thumb' ) ) ?>
      </div>

      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <div class="row question-body">

          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-left">
            by <?php the_qa_user_link( $post->post_author ); ?>
          </div>

          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
            Posted: <?= date('n/d/Y', strtotime($post->post_date)); ?>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <hr>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <h2 class="entry-title black"><?php the_title(); ?></h2>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 entry-content">
            <?php the_content(); ?>
          </div><!-- /.entry-content -->

          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php comments_template('/templates/comments.php'); ?>
          </div>

        </div><!-- /.row -->

      </div>
    </div><!-- /.single-question-container -->
  </article>
<?php endwhile; ?>
