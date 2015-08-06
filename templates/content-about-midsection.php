<?php $post = get_post(); ?>
<?php $post_meta = get_post_meta($post->ID); ?>

<div id="topBanner" class="row">
	<div id="topBannerText" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
		<h1><?php echo $post_meta['Top Title'][0]; ?></h1>
	</div>
</div>

<div class="row">
	<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xs-offset-2">

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h2><?php echo $post_meta['Lower Title'][0]; ?></h2>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 the-content">
				<?php echo $post->post_content; ?>
			</div>
		</div>

	</div>
</div>
