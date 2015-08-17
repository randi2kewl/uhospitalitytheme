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