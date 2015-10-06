<?php $post = get_page_by_title( 'Activate' ); ?>
<?php $post_meta = get_post_meta($post->ID); ?>

<?php if( isset($post_meta['Top Title'][0]) && $post_meta['Top Title'][0] !== '' ) : ?>
    <div id="topBanner" class="row">
        <div id="topBannerText" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <h1><?php echo $post_meta['Top Title'][0]; ?></h1>
        </div>
    </div>
<?php endif; ?>


<div id="buddypress_activate_container" class="row">
	<?php

	/**
	 * Fires before the display of the member activation page.
	 *
	 * @since BuddyPress (1.1.0)
	 */
	do_action( 'bp_before_activation_page' ); ?>

	<div class="page col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2" id="activate-page">

		<?php if( isset($post->post_content) ) : ?>
			<div>
				<?php echo do_shortcode($post->post_content ); ?>
			</div>
		<?php endif; ?>

		<?php

		/** This action is documented in bp-templates/bp-legacy/buddypress/activity/index.php */
		do_action( 'template_notices' ); ?>

		<?php

		/**
		 * Fires before the display of the member activation page content.
		 *
		 * @since BuddyPress (1.1.0)
		 */
		do_action( 'bp_before_activate_content' ); ?>

		<?php if ( bp_account_was_activated() ) : ?>

			<?php if ( isset( $_GET['e'] ) ) : ?>
				<p><?php _e( 'Your account was activated successfully! Your account details have been sent to you in a separate email.', 'buddypress' ); ?></p>
			<?php else : ?>
				<p><?php printf( __( 'Your account was activated successfully! You can now <a href="%s">log in</a> with the username and password you provided when you signed up.', 'buddypress' ), wp_login_url( bp_get_root_domain() ) ); ?></p>
			<?php endif; ?>

		<?php else : ?>

			<p><?php _e( 'Please provide a valid activation key.', 'buddypress' ); ?></p>

			<form action="" method="get" class="standard-form" id="activation-form">

				<label for="key"><?php _e( 'Activation Key:', 'buddypress' ); ?></label>
				<input type="text" name="key" id="key" value="" />

				<p class="submit">
					<input class="btn-outlined btn-blue" type="submit" name="submit" value="<?php esc_attr_e( 'Activate', 'buddypress' ); ?>" />
				</p>

			</form>

		<?php endif; ?>

		<?php

		/**
		 * Fires after the display of the member activation page content.
		 *
		 * @since BuddyPress (1.1.0)
		 */
		do_action( 'bp_after_activate_content' ); ?>

	</div><!-- .page -->

	<?php

	/**
	 * Fires after the display of the member activation page.
	 *
	 * @since BuddyPress (1.1.0)
	 */
	do_action( 'bp_after_activation_page' ); ?>

</div><!-- #buddypress -->
