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
		<div class="usaaef-color-bar"><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span></div>
		<div id="footer-widgets" class="secondary">
			<div id="footer-sidebar">
				<?php
				if(is_active_sidebar('footer-sidebar')){
					dynamic_sidebar('footer-sidebar');
				}
				?>
			</div><!-- footer-sidebar -->
		</div><!-- footer-widgets-->
	
		</div>
	</footer><!-- #colophon -->
	<div class="col-sm-12 below-footer-container">
	<div id="copyright" class="col-sm-6">
		<p>Copyright &copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'title' ); ?></p>
	</div><!-- #footer -->
	<div id="legal-nav" class="col-sm-6">
		<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-links', 'menu_class' => '') ); ?>
	</div><!-- col-sm-12 -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
