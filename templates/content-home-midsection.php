<?php $post = get_post(); ?>
<?php $post_meta = get_post_meta($post->ID); ?>

<div id="topBanner" class="row">
	<div id="topBannerText" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
		<h1><?php echo $post_meta['Top Title'][0]; ?></h1>
	</div>
</div>