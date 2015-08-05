<?php $post = get_post(); ?>
<?php $post_meta = get_post_meta($post->ID); ?>

<div id="topBanner" class="row">
	<div id="topBannerText" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
		<h1><?php echo $post_meta['Top Title'][0]; ?></h1>
	</div>
</div>

<?php if ( ! is_user_logged_in() ) : ?>

	<div id="registration-form-container" class="row">
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xs-offset-2">
			<?php gravity_form(1, false, false, false, null, false, 1, true); ?>
		</div>
	</div>

	<div id="login-form-container" class="row">
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xs-offset-2">
			<?php $args = array(
				'echo'           => true,
				'redirect' => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
				'form_id'        => 'loginform',
				'label_username' => __( 'Username' ),
				'label_password' => __( 'Password' ),
				'label_remember' => __( 'Remember Me' ),
				'label_log_in'   => __( 'Log In' ),
				'id_username'    => 'user_login',
				'id_password'    => 'user_pass',
				'id_remember'    => 'rememberme',
				'id_submit'      => 'wp-submit',
				'remember'       => false,
				'value_username' => '',
				'value_remember' => false
			); ?>
			<?php wp_login_form(); ?>
		</div>
	</div>


<?php endif; ?>

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
