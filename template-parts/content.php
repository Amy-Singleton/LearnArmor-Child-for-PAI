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
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			// in the loop
			$category = get_the_category();
			$currentcat = $category[0]->cat_ID;
			$currentcatname = $category[0]->cat_name;
			$currentcatslug = $category[0]->slug;
			echo '<h2 class="entry-title">' . $category[0]->cat_name . '</h2>';
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<!-- <div class="entry-meta"> -->
			<?php
				//learnarmor_posted_on();
			?>
		<!-- </div> .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		if (is_home()) {
			if ( has_post_thumbnail()) {
				echo '<div class="post-thumbnail">' . the_post_thumbnail() . '</div>';
				the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			} 
			the_excerpt(35);
		} else {
			if (class_exists( 'SFWD_LMS' ) && is_singular('sfwd-courses')) {
				if ( has_post_thumbnail()) {
					echo '<div class="post-thumbnail">' . the_post_thumbnail() . '</div>';
				} 
				the_excerpt();
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
		if (!is_home()){
			learnarmor_entry_footer();
		}?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
