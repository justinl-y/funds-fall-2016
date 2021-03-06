<?php
/**
 *
 * Template Name: Questionnaire
 *
*/
 	acf_form_head();
	get_header(); ?>

	<div id="primary">
		<div id="content" role="main">
			<div class="container wrap">
			<?php while ( have_posts() ) : the_post(); ?>
			<!--<p>single-questionnaire.php</p>-->

			<header class="page-header">
				<h1><?php the_title(); ?></h1>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php // check if the flexible content field has rows of data
					if( have_rows('questionnaire_item') ):
						// loop through the rows of data
						while ( have_rows('questionnaire_item') ) : the_row();
							// check current row layout
							if( get_row_layout() === 'questionnaire_question' ):
								$question = get_sub_field('question_name');
								$answer = get_sub_field('question_response');
							endif;
						endwhile;
					else :
						// no layouts found
					endif;
				
					acf_form( array( 'submit_value' => 'Submit',
										'return' => get_template_directory_uri() . '/notification-questionnaire/') ); ?>
			</div><!-- .entry-content -->

		<?php endwhile; // End of the loop. ?>
			</div> <!-- container -->
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>

