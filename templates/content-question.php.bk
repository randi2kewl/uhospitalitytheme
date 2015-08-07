<div id="discussion-container" class="row">
	<?php if ( !have_posts() ) : ?>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<p><?php $question_ptype = get_post_type_object( 'question' ); echo $question_ptype->labels->not_found; ?></p>
		</div>
	<?php else: ?>

		<?php
		$question_query = new WP_Query( array(
			'post_type' => 'question',
			'posts_per_page' => 6,
		) );

		while ( $question_query->have_posts() ) : $question_query->the_post(); ?>
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
		<?php endwhile; wp_reset_query();?>

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
			<a id="see-all-discussions-button" class="btn btn-blue btn-outlined" href="<?php echo network_home_url('/discussions'); ?>">SEE ALL DISCUSSIONS</a>
		</div>
	<?php endif; ?>
</div>

