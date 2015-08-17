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
		<?php get_template_part( 'templates/content', 'project' ); ?>
	<?php endwhile; wp_reset_query();?>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
		<a id="see-all-projects-button" class="btn btn-blue btn-outlined" href="<?php echo network_home_url('/projects'); ?>">SEE ALL PROJECTS</a>
	</div>
	<?php endif; ?>

</div>

