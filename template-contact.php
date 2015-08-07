<?php
/**
 * Template Name: Contact
 *
 * This template is used for the Contact page.
 *
 * Top Navigation: Primary Menu
 */
?>
<?php $post = get_post(get_the_ID(), OBJECT, 'display'); ?>

<div class="row">
	<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xs-offset-2">
		<?php echo do_shortcode($post->post_content); ?>
	</div>
</div>
