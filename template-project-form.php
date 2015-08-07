<?php
/**
 * Template Name: Project Submission Form
 *
 * This template is used for the project submission page.
 *
 * Top Navigation: Primary Menu
 */
?>
<?php $post = get_post(get_the_ID(), OBJECT, 'display'); ?>

<div id="project-form-container" class="row">
	<div class="col-xs-10 col-sm-10 col-md-8 col-lg-8 col-xs-offset-1 col-md-offset-2">
		<?php echo do_shortcode($post->post_content); ?>
	</div>
</div>
