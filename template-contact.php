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
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<?php echo do_shortcode($post->post_content); ?>
	</div>
</div>
