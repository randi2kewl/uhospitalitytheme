<?php

use Roots\Sage\Config;
use Roots\Sage\Wrapper;

?>

	<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>
<!--[if lt IE 9]>
<div class="alert alert-warning">
	<?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
</div>
<![endif]-->
<?php
do_action('get_header');
get_template_part('templates/header');
?>

<div class="wrap container-fluid" role="document">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 member-info">
					<?php do_action( 'qa_before_content', 'edit-question' ); ?>

					<div id="qa-user-box">

						<?php
						global $bp; //BuddyPress active
						$userdata = (isset($bp) ) ? $userdata = $bp->displayed_user->userdata : get_queried_object();
						//var_dump($userdata);
						?>

						<?php echo get_avatar( $userdata->ID, 128 ); ?>
						<?php //the_qa_user_rep( $userdata->ID ); ?>
					</div>

					<table id="qa-user-details">
						<tr>
							<th><?php _e( 'Name', QA_TEXTDOMAIN ); ?></th>
							<td><strong><?php echo $userdata->display_name; ?></strong></td>
						</tr>
						<tr>
							<th><?php _e( 'Member for', QA_TEXTDOMAIN ); ?></th>
							<td><?php echo human_time_diff( strtotime( $userdata->user_registered ) ); ?></td>
						</tr>
					</table>
				</div>
			</div>

		<?php
		$question_query = new WP_Query( array(
		'author' => $userdata->ID,
		'post_type' => 'question',
		'posts_per_page' => 20,
		'update_post_term_cache' => false
		) );
		?>

			<div id="discussion-container" class="row">

				<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-offset-1">
					<h3>Recent questions</h3>
					<hr>
				</div>

				<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-offset-1">

					<?php
					while ( $question_query->have_posts() ) : $question_query->the_post(); ?>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 discussion-card post">

						<div class="row">

							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 excerpt-container">
										<?php the_title(); ?>
									</div>

									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 view-discussion-button">
										<a href="<?php the_permalink(); ?>" class="btn btn-block btn-green">View Discussion</a>
									</div>

									<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 comments-container light-grey">
										<?= \Roots\Sage\Utils\uh_answer_count(); ?>
									</div>

									<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 age-container light-grey text-right">
										<?= \Roots\Sage\Utils\humanTiming($post->post_date); ?>
									</div>
								</div>
							</div>
						</div>

					</div> <!-- /.discussion-card -->
					<?php endwhile; wp_reset_query(); ?>

				</div>
			</div>
	</div>

<?php
do_action('get_footer');
get_template_part('templates/footer');
wp_footer();
?>
</body>
</html>
