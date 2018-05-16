<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package learnarmor_child
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('col-sm-4 search'); ?>>
<div class="wrap-search">
	<header class="entry-header">
		<div class="post-thumbnail">
		<?php if ( has_post_thumbnail() ) {
			the_post_thumbnail();
		} ?>
		</div>
		<?php
		//the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<!--<div class="entry-meta">-->
			<?php
			//learnarmor_posted_on();
			?>
		<!--</div>--><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
	<div class="entry-summary">
		<p>
		<?php
			the_title( sprintf( '<span class="semi-bold-font"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a> - </span>' );
			$length = apply_filters('excerpt_length',20);
			echo wp_trim_words(get_the_excerpt(),$length); 
	       ?>
	       </p>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php learnarmor_child_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	</div><!-- .wrap-search -->
</article><!-- #post -->
