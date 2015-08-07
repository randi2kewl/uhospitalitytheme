<?php get_template_part('templates/head'); ?>
<?php get_template_part('templates/header'); ?>

<div class="row">
    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-offset-1 light-grey">
    	<h1>Ask a Question</h1>
    </div>
</div>

<div id="qa-page-wrapper" class="row">
    <div id="qa-content-wrapper" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <?php do_action( 'qa_before_content', 'ask-question' ); ?>

    <div id="ask-question">
    <?php the_question_form(); ?>
    </div>

    <?php do_action( 'qa_after_content', 'ask-question' ); ?>
    </div>
</div><!--#qa-page-wrapper-->

<?php get_template_part('templates/footer'); ?>
