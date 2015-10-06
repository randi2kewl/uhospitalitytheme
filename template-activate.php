<?php
/**
 * Template Name: After Registration Page
 *
 * This template is used for the Contact page.
 *
 * Top Navigation: Primary Menu
 */
?>

<?php while (have_posts()) : the_post(); ?>

<?php $post_meta = get_post_meta($post->ID); ?>

<?php if( isset($post_meta['Top Title'][0]) && $post_meta['Top Title'][0] !== '' ) : ?>
    <div id="topBanner" class="row">
        <div id="topBannerText" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <h1><?php echo $post_meta['Top Title'][0]; ?></h1>
        </div>
    </div>
<?php endif; ?>

<div class="row">
	<div id="activate_page_content_container" class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2">
		<?php the_content(); ?>
	</div>
</div>
<?php endwhile; ?>
