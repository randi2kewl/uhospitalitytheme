<header class="banner" role="banner">
  <div class="container-fluid">

    <nav class="navbar">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>"><img src="<?= get_template_directory_uri(); ?>/dist/images/logo.png"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapse-1">
          <?php
          if (has_nav_menu('primary_navigation')) :
            wp_nav_menu(['theme_location' => 'primary_navigation', 'container' => 'container', 'menu_class' => 'nav navbar-nav navbar-right']);
          endif;
          ?>
    </nav><!-- /.navbar -->
  </div> <!-- /.container-fluid -->
</header>


<?php if ( ! is_user_logged_in() ) : ?>

  <div id="registration-form-container" class="row">
    <div id="registration-form-label" class="ccol-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2 text-center">
      Fill in the form below and you're ready to go!
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
      <?php gravity_form('Registration', false, false, false, '', true, 1, true); ?>
    </div>
  </div>

  <div id="login-form-container" class="row">
    <div id="login-form-label" class="col-xs-12 col-sm-12 col-md-10 col-lg-9 col-md-offset-1 col-lg-offset-1 text-center">
      Fill in the form below and you're ready to go!
    </div>
    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-9 col-md-offset-1 col-lg-offset-1 col-xs-offset-2">
      <?php $args = array(
          'echo'           => true,
          'redirect' => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
          'form_id'        => 'loginform',
          'label_username' => __( '' ),
          'label_password' => __( '' ),
          'label_log_in'   => __( 'LOGIN' ),
          'id_username'    => 'user_login',
          'id_password'    => 'user_pass',
          'id_submit'      => 'wp-submit',
          'remember'       => false,
          'value_username' => '',
          'value_remember' => false
      ); ?>
        <div id="loginform">
            <?php echo do_shortcode('[login_widget]'); ?>
            <p id="forgot-password-link-container"><a href="#" id="forgot-password-link">Forgot password?</a></p>
        </div>

        <div id="resetpassform">
            <?php echo do_shortcode('[forgot_password]'); ?>
        </div>

    </div>
  </div>


<?php endif; ?>
