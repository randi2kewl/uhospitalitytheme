<?php
/**
 * Template Name: Project API
 *
 * This template is used for getting more projects.
 */
?>

<?php get_template_part('templates/projects'); ?>
<?php $page = intval(get_query_var('page')); ?>
<?php (0 < $page) ? projects_by_page($page, 6) : ""; ?>

