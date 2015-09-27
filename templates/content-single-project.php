<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>

    <div class="row light-grey">

      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xs-offset-2">

      <div class="row">
        <div class="col-xs-10 col-sm-4 col-md-3 col-lg-3 pull-right">
          <?php if (has_post_thumbnail( $post->ID ) ): ?>
          <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
          <img class="project-avatar" src="<?php echo $image[0]; ?>" style="width: 100%;">
          <?php endif; ?>
        </div>
      </div>

        <div class="row question-body">

          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-left">
            by <span class="blue"><?= get_post_field('by') ?></span>
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
        </div><!-- /.row -->

      </div>
    </div><!-- /.single-question-container -->
  </article>

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
      <div id="project_information_form">
        <?php gravity_form('Project Information Form', false, false, false, '', true, 1, true); ?>
      </div>
    </div>
  </div>
<?php endwhile; ?>
