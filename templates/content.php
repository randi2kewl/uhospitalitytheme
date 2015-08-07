<?php
while (have_posts()) : the_post();
  get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format());
endwhile;