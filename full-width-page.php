<?php
/**
 * Template Name: Full Width Template
 *
 * This is a full width template that does not have a sidebar
 * 
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package learnarmor
 */
get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main col-sm-12" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content', 'page' ); ?>
			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
