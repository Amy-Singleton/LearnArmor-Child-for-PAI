<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package learnarmor-child
 */

?>
<?php if(!is_singular() && is_home()) { ?>
<div class="facetwp-template">
<?php } ?>
<article id="post-<?php the_ID(); ?>"
	<?php
	if(!is_singular() && is_home()) {
		post_class('col-sm-4 post');
	} else {
		post_class(); 	
	}
	?>>
	<?php if(!is_singular() && is_home()) { ?>
	<div class="wrap-post">
	<?php }
	if( is_singular() ) { ?>
	<header class="entry-header">
		<?php 
			the_title( '<h1 class="entry-title">', '</h1>' );
	}
	if (is_home() && !is_singular()) { ?>
	<header class="entry-header">
		<?php
			if ( has_post_thumbnail()) {
				echo '<div class="post-thumbnail">';
					the_post_thumbnail();
				echo '</div>';
			}
	} ?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php
		if (is_home()) {
			the_title( sprintf( '<span class="semi-bold-font"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a> - </span>' );
			$length = apply_filters('excerpt_length',20);
			echo wp_trim_words(get_the_excerpt(),$length); 
		} else {
			if (class_exists( 'SFWD_LMS' ) && is_singular('sfwd-courses')) {
				if ( has_post_thumbnail()) {?>
					<div class="col-sm-12 course-description">
						<div class="course-thumbnail col-sm-4">
						<?php 						   
						/* grab the url for the full size featured image */
						$featured_img_url = get_the_post_thumbnail_url($query->ID, 'full');
						$the_title = get_the_title();
						?>
							<img src="<?php echo $featured_img_url; ?>" alt="<?php echo $the_title . ' ' . 'Course' ?>" />
						</div>
				<?php } ?>
						<div class="course-excerpt col-sm-8">
							<?php the_excerpt(); ?>
						</div>
					</div>
				<?php 
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
		learnarmor_child_entry_footer();
	?>
	</footer><!-- .entry-footer -->
	<?php if(!is_singular() && is_home()) { ?>
	 </div><!-- End .wrap-post -->
	<?php } ?>
</article><!-- #post-<?php the_ID(); ?> -->
<?php if(!is_singular() && is_home()) { ?>
</div><!-- End .facetwp-template -->
<?php } ?>
