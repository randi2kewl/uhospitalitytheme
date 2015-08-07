<div id="discussion-container" class="row">
	<?php if ( !have_posts() ) : ?>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<p><?php $question_ptype = get_post_type_object( 'question' ); echo $question_ptype->labels->not_found; ?></p>
		</div>
	<?php else: ?>

		<?php
		global $wp_query;

		$wp_query = new WP_Query( array(
			'post_type' => 'question',
			'posts_per_page' => 6,
		) ); ?>

		<?php get_template_part('templates/content', 'question'); ?>
		<?php wp_reset_query();?>

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
			<a id="see-all-discussions-button" class="btn btn-blue btn-outlined" href="<?php echo network_home_url('/discussions'); ?>">SEE ALL DISCUSSIONS</a>
		</div>
	<?php endif; ?>
</div>

