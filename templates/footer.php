<div id="footer-social-links" class="row">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
	  <h3><span>
    <a href="http://twitter.com"><span class="fa fa-facebook black"></span></a>
    <a href="http://twitter.com"><span class="fa fa-twitter black"></span></a>
    <a href="http://twitter.com"><span class="fa fa-linkedin black"></span></a>
	  </span></h3>
  </div>
</div>

<footer class="content-info light-grey" role="contentinfo">

	<div class="row">
		<div class="col-xs-4 col-sm-4 col-md-3 col-lg-3">
			<a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>"><img src="<?= get_template_directory_uri(); ?>/dist/images/logo.png"></a>
		</div>

		<div class="col-xs-8 col-sm-8 col-md-9 col-lg-9 text-right">
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