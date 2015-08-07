<div id="project-container" class="row">
	<?php if ( !have_posts() ) : ?>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<p><?php $project_ptype = get_post_type_object( 'project' ); echo $project_ptype->labels->not_found; ?></p>
		</div>
	<?php else: ?>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center medium-grey project-section-header">
		<h2>Lorem ipsum is simply dummy text of the printing and typesetting industry.</h2>
	</div>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
		<a href="/new-project" id="project-form-button" class="btn btn-green btn-outlined">Submit New Project</a>
	</div>

	<?php projects_by_page(1, 6); ?>
	<?php endif; ?>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
		<a id="see-all-projects-button" class="btn btn-blue btn-outlined">SHOW MORE</a>
	</div>
</div>

