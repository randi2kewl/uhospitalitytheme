<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php if( is_page( 'discussions' ) ): ?>
    <?php while (have_posts()) : the_post(); ?>
        <meta property="og:description"   content="<?php echo the_content(); ?>" />
    <?php endwhile; ?>
  <?php endif; ?>
  <?php wp_head(); ?>
</head>
