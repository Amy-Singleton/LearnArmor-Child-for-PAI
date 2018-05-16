<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package learnarmor
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main col-sm-9" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
		<div class="facetwp-template">
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
				if ( is_category() || is_tag() || is_archive() || class_exists( 'SFWD_LMS' ) && !is_singular('sfwd-courses')) {
					?>
			<div class="col-sm-4 post">
				<div class="wrap-post">
					<div class="post-thumbnail">
					<?php if ( has_post_thumbnail() ) {
					    the_post_thumbnail();
					 } ?>
					</div>
					<div class="entry-summary">
					 <?php
						the_title( sprintf( '<span class="semi-bold-font"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a> - </span>' );
						$length = apply_filters('excerpt_length',20);
						echo wp_trim_words(get_the_excerpt(),$length);
						?>
					</div>
					<footer class="entry-footer">
						<?php
							learnarmor_child_entry_footer();
						?>
					</footer><!-- .entry-footer -->
				</div>
			</div><!-- .col-sm-4 -->
	<?php 
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
		</div><!-- .facetwp-template -->
		</main><!-- #main -->
	<?php
get_sidebar(); ?>
</div><!-- #primary -->
<?php
get_footer();