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
	<?php if ( !have_posts() ) : ?>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<p><?php $question_ptype = get_post_type_object( 'question' ); echo $question_ptype->labels->not_found; ?></p>
		</div>
	<?php else: ?>

		<?php
		$question_query = new WP_Query( array(
			'post_type' => 'question',
			'posts_per_page' => 20,
		) );

		while ( $question_query->have_posts() ) : $question_query->the_post(); ?>
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 discussion-card">

				<div class="row">
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 avatar-container text-right">
						<?php echo bp_core_fetch_avatar ( array( 'item_id' => $post->post_author, 'type' => 'thumb' ) ) ?>
					</div>
					<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
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
		<?php endwhile; wp_reset_query();?>

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
			<a id="see-all-discussions-button" class="btn btn-blue btn-outlined" href="<?php echo network_home_url('/discussions'); ?>">SHOW MORE</a>
		</div>
	<?php endif; ?>
</div>

