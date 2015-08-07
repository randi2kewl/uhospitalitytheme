<div id="project-container" class="row">

	<?php if ( !have_posts() ) : ?>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<p><?php $project_ptype = get_post_type_object( 'project' ); echo $project_ptype->labels->not_found; ?></p>
		</div>
	<?php else: ?>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center medium-grey project-section-header">
		<h2>Lorem ipsum is simply dummy text of the printing and typesetting industry.</h2>
	</div>

	<?php
		$project_query = new WP_Query( array(
		'post_type' => 'project',
		'posts_per_page' => 3,
	) );

	while ( $project_query->have_posts() ) : $project_query->the_post(); ?>
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 project-card light-grey">

			<div class="row">

				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
					by <span class="blue"><?= get_post_field('by', $post) ?></span>
				</div>

				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-right">
					<?= \Roots\Sage\Utils\humanTiming($post->post_date); ?>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 project-title">
					<span class="black">Project:</span> <?= mb_strimwidth(the_title(), 0, 50, ''); ?>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<?= mb_strimwidth(the_excerpt(), 0, 250, '...'); ?>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<a href="<?php the_permalink(); ?>" class="btn btn-green btn-block">Learn More</a>
				</div>

			</div> <!-- /.row -->

		</div> <!-- /.project-card -->
	<?php endwhile; wp_reset_query();?>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
		<a id="see-all-projects-button" class="btn btn-blue btn-outlined" href="<?php echo network_home_url('/projects'); ?>">SEE ALL PROJECTS</a>
	</div>
	<?php endif; ?>

</div>

