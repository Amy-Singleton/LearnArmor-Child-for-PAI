<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package learnarmor-child
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main col-sm-9" role="main">

		<?php
		while ( have_posts() ) : the_post();
                    	/*
                        * Include the Post-Format-specific template for the content.
                        * If you want to override this in a child theme, then include a file
                        * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                        */
                       get_template_part( 'template-parts/content', get_post_format() );
             				
			if ( is_singular( array( 'sfwd-lessons' ) ) || is_singular( array( 'sfwd-topic' ) ) && function_exists( 'sharing_display' ) ) {
				sharing_display( '', false );
			} elseif(function_exists( 'sharing_display' )) {
				sharing_display( '', true );
			}
			if ( is_singular( array( 'post' ) ) && class_exists( 'Jetpack_Likes' ) ) {
				$custom_likes = new Jetpack_Likes;
				echo $custom_likes->post_likes( '' );
			}
			if ( is_singular( array( 'post', 'sfwd-courses' ) ) && class_exists( 'Jetpack_RelatedPosts' ) ) {
			    echo do_shortcode( '[jetpack-related-posts]' );
			}
			the_post_navigation();
			if ( is_singular( array( 'post' )) ) {                     
			 // If comments are open or we have at least one comment, load up the comment template.
			      if ( comments_open() || get_comments_number() ) :
				 comments_template();
			      endif;
			}
		endwhile; // End of the loop.
		?>

		</main><!-- #main -->

<?php
if ( get_post_type( get_the_ID() ) == 'sfwd-courses' || get_post_type( get_the_ID() ) == 'sfwd-lessons'|| get_post_type( get_the_ID() ) == 'sfwd-topic'|| get_post_type( get_the_ID() ) == 'sfwd-quiz' ) {
    //if is true
	if ( is_active_sidebar( 'ld-sidebar' ) ) : ?>
	<div id="course-sidebar" class="widget-area col-sm-3" role="complementary">
		<?php dynamic_sidebar( 'ld-sidebar' ); ?>
		</div><!-- #secondary -->
	<?php	endif; ?>
	<div class="comment-wrap col-sm-9">
		<?php  // If comments are open or we have at least one comment, load up the comment template.
                  if ( is_singular( array( 'sfwd-courses' )) || get_post_type( get_the_ID() ) == 'sfwd-courses' && comments_open() || get_comments_number() ) :
                           comments_template();
                   endif; ?>
	</div>
<?php }
else {
	get_sidebar();
} ?>
	</div><!-- #primary -->
<?php 	
get_footer();