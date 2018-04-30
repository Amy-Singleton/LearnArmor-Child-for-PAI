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
	<div id="login-modal" class="modal fade">
	  	<div class="modal-dialog">
		    <div class="modal-content">
			  	<div class="modal-header">
			    	      <button type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
			    	      <div class="login">
					<h2 class="text-align-center">Login Form</h2>
				      </div>
				      
			  	</div>
			  	<!--/.modal-header-->
			  	<div class="modal-body col-sm-12">
					
				    <form action="<?php echo site_url( 'wp-login.php'); ?>" method="post" name="loginform">
					  	<div class="form-field">
					  		<label id="login" class="col-sm-12">Username:</label>
					  		<input type="text" class="login-username col-sm-12" name="login" aria-labelledby="login"/>
					  	</div>
					  	<div class="form-field">
					  		<label id="pwd"class="col-sm-12">Password:</label>
					  		<input type="password" class="login-password col-sm-12" name="pwd" aria-labelledby="pwd"//>
					  	</div>
					  	<div class="form-field">
							<label id="checkbox" for="rememberme" class="mm-remember-me col-sm-12">
								<input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" aria-labelledby="checkbox"/>
								Remember me
							</label>
						</div>
						 <?php do_action( 'wordpress_social_login' ); ?>
					  	<div class="center-button col-sm-12">
					  		<button type="submit" name="wp-submit" class="btn btn-primary btn-block" tabindex="0">
								<span class="fa fa-sign-in" aria-hidden="true"> Log In</span>
							</button>
							<input type="hidden" name="redirect_to" value="<?php echo esc_attr($_SERVER['REQUEST_URI']); ?>" />
					  	</div>
					</form>
			  	
				</div>
			  	<!--/.modal-body-->
                                <div class="modal-footer">
					<p class="txt-align-center">
						<a rel="nofollow" href="<?php bloginfo( 'url' ); ?>/wp-login.php?action=register">Register</a> | <a href="<?php bloginfo( 'url' ); ?>/wp-login.php?action=lostpassword">Lost your password?</a>
					</p>
                                </div>
		  	</div><!--/.modal-content-->
	  	</div>
	  	<!--/.modal-dialog-->
	</div>
	<!--/.modal-->
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
