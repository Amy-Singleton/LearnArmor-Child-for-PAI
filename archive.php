<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package learnarmor-child
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main col-sm-9" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
				if ( is_category() || is_tag() || is_archive() || is_home() || is_search() || is_page('blog') {
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					// check if the post or page has a Featured Image assigned to it.
					if ( has_post_thumbnail() ) {
					    the_post_thumbnail();
					}
					the_excerpt(35);
				    } else {
					/*
					* Include the Post-Format-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Format name) and that will be used instead.
					*/
				       get_template_part( 'template-parts/content', get_post_format() );
				    } 
				

			endwhile;

			learnarmor_content_nav();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_sidebar();
get_footer();
