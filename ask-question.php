<?php get_template_part('templates/head'); ?>
<?php get_template_part('templates/header', 'question'); ?>

<div class="row">
    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-offset-1 light-grey">
    	<h1>Start a Discussion</h1>
    </div>
</div>

<?php do_action( 'qa_before_content', 'ask-question' ); ?>

<div class="row">
    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-offset-1">
        <div id="ask-question">
        <?php the_question_form(); ?>
        </div>
    </div>
</div><!--#qa-page-wrapper-->

<?php get_template_part('templates/footer'); ?>
