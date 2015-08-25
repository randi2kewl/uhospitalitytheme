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
	<div id="contact_form_container" class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2">
		<?php echo do_shortcode($post->post_content); ?>
	</div>
</div>
