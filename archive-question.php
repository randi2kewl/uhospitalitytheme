<?php if(isset($_REQUEST['s'])) { ?>

<?php
get_template_part('templates/head');
get_template_part('templates/header');
?>
<?php } ?>

<?php global $wp_query; ?>

<div class="row tag-cloud">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<span class="medium-grey">Popular Tags:</span>
		<?php
			wp_tag_cloud(array(
				'smallest' => 1, 'largest' => 1, 'unit' => 'em', 'number' => 8,
				'format' => 'flat', 'separator' => "", 'orderby' => 'count', 'order' => 'DESC',
				'exclude' => '', 'include' => '', 'link' => 'view', 'taxonomy' => 'question_tag', 'post_type' => '', 'echo' => true
			));
		?>
	</div>
</div>

<div id="discussion-container" class="row">

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
		<a id="start-discussion-button" href="discussions/ask" class="btn btn-blue btn-outlined">Start Discussion</a>
	</div>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right question-search">
		<form method="get" action="<?php echo qa_get_url('archive'); ?>" id="custom-search-form" class="form-search form-horizontal pull-right">
			<div class="input-append">
				<input type="text" name="s" class="search-query" placeholder="Search Discussions" value="<?php echo get_search_query(); ?>">
				<button type="submit" class="btn"><i class="fa fa-search"></i></button>
			</div>
		</form>
	</div>


	<?php if ( !have_posts() ) : ?>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<p><?php $question_ptype = get_post_type_object( 'question' ); echo 'No discussions were found.' ?></p>
		</div>
	<?php else: ?>

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h2 class="light-grey"><?php single_cat_title('Tag: '); ?></h2>
			</div>
		</div>


		<div id="content">
			<?php get_template_part('templates/content', 'question'); ?>
		</div>
	<?php endif; ?>
</div>


<?php if(isset($_REQUEST['s'])) { ?>
	<?php get_template_part('templates/footer'); ?>
<?php } ?>