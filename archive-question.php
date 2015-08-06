<div class="row tag-cloud">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<span class="medium-grey">Popular Tags:</span>
		<?php
			wp_tag_cloud(array(
				'smallest' => 1, 'largest' => 1, 'unit' => 'em', 'number' => 8,
				'format' => 'flat', 'separator' => "", 'orderby' => 'count', 'order' => 'DESC',
				'exclude' => '', 'include' => '', 'link' => 'view', 'taxonomy' => 'question_tag', 'post_type' => '', 'echo' => true
			));
		?>
	</div>
</div>

<div id="discussion-container" class="row">

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right question-search">
		<form method="get" action="<?php echo qa_get_url('archive'); ?>" id="custom-search-form" class="form-search form-horizontal pull-right">
			<div class="input-append">
				<input type="text" name="s" class="search-query" placeholder="Search Discussions" value="<?php echo get_search_query(); ?>">
				<button type="submit" class="btn"><i class="fa fa-search"></i></button>
			</div>
		</form>
	</div>

	<?php do_action( 'qa_before_content', 'archive-question' ); ?>

	<?php if ( !have_posts() ) : ?>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<p><?php $question_ptype = get_post_type_object( 'question' ); echo $question_ptype->labels->not_found; ?></p>
		</div>
	<?php else: ?>

		<?php global $wp_query; ?>

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h2 class="light-grey"><?php single_cat_title('Category: '); ?></h2>
			</div>
		</div>


		<?php
		while ( have_posts() ) : the_post(); ?>
			<?php do_action( 'qa_before_question_loop' ); ?>
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 discussion-card">

				<div class="row">
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 avatar-container text-center">
						<?php echo bp_core_fetch_avatar ( array( 'item_id' => $post->post_author, 'type' => 'thumb' ) ) ?>
					</div>
					<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 name-container light-grey">
								by <?php the_qa_user_link( $post->post_author ); ?>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 excerpt-container">
								<?php the_title(); ?>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 view-discussion-button">
								<a href="<?php the_permalink(); ?>" class="btn btn-block btn-green">View Discussion</a>
							</div>

							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 comments-container light-grey">
								<?= \Roots\Sage\Utils\uh_answer_count(); ?>
							</div>

							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 age-container light-grey text-right">
								<?= \Roots\Sage\Utils\humanTiming($post->post_date); ?>
							</div>
						</div>
					</div>
				</div>

			</div> <!-- /.discussion-card -->
		<?php endwhile; $wp_query->set('posts_per_page', 6); ?>

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
			<a id="see-all-discussions-button" class="btn btn-blue btn-outlined" href="<?php echo network_home_url('/discussions'); ?>">SHOW MORE</a>
		</div>
	<?php endif; ?>
</div>

