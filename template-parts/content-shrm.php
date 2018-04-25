<?php
/**
 * The template used for displaying page content in shrm-page.php
 *
 * @package WordPress
 * @subpackage learnArmor-child
 * @since Boss 1.0.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<header class="entry-header shrm">
                    <img class="img-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/css/images/SHRM-page-banner.png" alt="shrm foundation" title="SHRM Foundation" />
		<?php
                //the_title( '<h1 class="entry-title">', '</h1>' );
                ?>
                </header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'boss' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->

		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'boss' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->

	</article><!-- #post -->
