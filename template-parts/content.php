<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package learnarmor-child
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php 
		if ( is_singular() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		}
		else {
			the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		}
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		if (is_home()) {
			if ( has_post_thumbnail()) {
				echo '<div class="post-thumbnail">';
					the_post_thumbnail();
				echo '</div>';
			} 
			the_excerpt(35);
		} else {
			if (class_exists( 'SFWD_LMS' ) && is_singular('sfwd-courses')) {
				if ( has_post_thumbnail()) {
					echo '<div class="col-sm-12 course-description">
					<div class="course-thumbnail col-sm-6">';
						the_post_thumbnail();
					echo '</div>';
				}
				echo '<div class="course-excerpt col-sm-6">';
					the_excerpt();
				echo '</div></div>';
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'learnarmor' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );
			} else {
				the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'learnarmor' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
				) );
			}
		}
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'learnarmor' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		
		<?php
			learnarmor_entry_footer();
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
