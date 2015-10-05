<div id="footer-social-links" class="row">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
	  <h3><span>
    <a href="https://www.facebook.com/uhospitality"><span class="fa fa-facebook black"></span></a>
    <a href="https://twitter.com/u_hospitality"><span class="fa fa-twitter black"></span></a>
    <a href="https://www.linkedin.com/company/uhospitality"><span class="fa fa-linkedin black"></span></a>
	  </span></h3>
  </div>
</div>

<footer class="content-info light-grey" role="contentinfo">

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="navbar-brand">
            <a class="logo" href="<?= esc_url(home_url('/')); ?>"><img src="<?= get_template_directory_uri(); ?>/dist/images/logo.png"></a>
            <a class="logo" href="<?= esc_url('http://www.gsu.edu'); ?>"><img src="<?= get_template_directory_uri(); ?>/dist/images/gsu_logo.png"></a>

            </div>
		</div>

		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 text-right">
			<nav>
				<?php
				if (has_nav_menu('footer_navigation')) :
					wp_nav_menu(['theme_location' => 'footer_navigation', 'container' => 'container', 'menu_class' => 'nav navbar-nav navbar-right']);
				endif;
				?>
			</nav>
		</div>
	</div>

</footer>