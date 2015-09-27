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
          <div class="navbar-brand">
            <a class="logo" href="<?= esc_url(home_url('/')); ?>"><img src="<?= get_template_directory_uri(); ?>/dist/images/logo.png"></a>
            <a class="logo" href="<?= esc_url('http://www.gsu.edu/'); ?>"><img src="<?= get_template_directory_uri(); ?>/dist/images/gsu_logo.jpeg"></a>
          </div>
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
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
      <?php gravity_form('Registration', false, false, false, '', true, 1, true); ?>
    </div>
  </div>

  <div id="login-form-container" class="row">
    <div id="login-form-label" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center"></div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
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
