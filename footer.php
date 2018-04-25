<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package learnarmor
 */

?>

	</div><!-- #content -->
	
	<footer id="colophon" class="site-footer col-sm-12">
		<div id="footer-widgets" class="secondary">
			<div id="footer-sidebar">
				<?php
				if(is_active_sidebar('footer-sidebar')){
					dynamic_sidebar('footer-sidebar');
				}
				?>
			</div><!-- footer-sidebar -->
		</div><!-- footer-widgets-->
	</footer><!-- #colophon -->
	<div class="col-sm-12 below-footer-container">
		<div id="copyright" class="col-sm-5">
			<p>Copyright &copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'title' ); ?></p>
		</div><!-- #copyright -->
		<div id="guidestar" class="col-sm-2">
			<p><img class="aligncenter" src="<?php bloginfo( 'url' ); ?>/wp-content/themes/learnarmor-child/css/images/guidestar-platinum-participant.png" alt="guidstar platinum nonprofit participant" /></p>
		</div><!-- #guidestar -->
		<div id="legal-nav" class="col-sm-5">
		<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-links', 'menu_class' => '') ); ?>
	</div><!-- #legal-nav -->
	</div><!-- .below-footer-container -->
<?php wp_footer(); ?>
</div><!-- #page -->
</body>
</html>
