<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 project-card light-grey">

				<div class="row">

		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
			<?php if (has_post_thumbnail( $post->ID ) ): ?>
			<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
			<img class="project-avatar" src="<?php echo $image[0]; ?>" style="width: 100%;">
			<?php endif; ?>
		</div>

		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
			<div class="row">
				<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
					by <span class="blue"><?= get_post_field('by', $post) ?></span>
				</div>

				<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text-right">
					<?= \Roots\Sage\Utils\humanTiming($post->post_date); ?>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 project-title">
					<span class="black">Project:</span> <?= mb_strimwidth(the_title(), 0, 50, ''); ?>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 project-excerpt">
					<?= mb_strimwidth(the_excerpt(), 0, 250, '...'); ?>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<a href="<?php the_permalink(); ?>" class="btn btn-green btn-block">Learn More</a>
				</div>
			</div>
		</div>

	</div> <!-- /.row -->

</div> <!-- /.project-card -->