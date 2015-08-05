<header class="banner" role="banner">
  <div class="container-fluid">

    <nav class="navbar">
      <div class="container">
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
      </div><!-- /.container -->
    </nav><!-- /.navbar -->
  </div> <!-- /.container-fluid -->
</header>