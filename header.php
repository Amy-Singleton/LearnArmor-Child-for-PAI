<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package learnarmor-child
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'learnarmor-child' ); ?></a>
<header id="masthead" class="site-header">
	<nav class="navbar navbar-default" role="navigation">
		<div>
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<div class="navbar-brand">
				<?php
			       
			       if ( the_custom_logo()) : 
					the_custom_logo();  
			        else : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			       <?php
			       endif;
       
			       $description = get_bloginfo( 'description', 'display' );
			       if ( $description || is_customize_preview() ) : ?>
				       <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			       <?php
			       endif; ?>
		        </div>
			 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#header-menus">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div id="header-menus" class="collapse in">
		  <div id="search-in-header" class="col-sm-4"><?php get_search_form( true ); ?></div>
		      <?php
			  wp_nav_menu( array(
			      'menu'              => 'primary',
			      'theme_location'    => 'primary',
			      'depth'             => 3,
			      'container'         => 'div',
			      'container_id'      => 'header-menu-primary',
			      'container_class'	  => 'header-menu-primary col-sm-8',
			      'menu_class'        => 'nav navbar-nav',
			      'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
			      'walker'            => new WP_Bootstrap_Navwalker())
			  );
		      ?>
		  </div>
		</div>
	      </nav><!-- #site-navigation -->
	</header><!-- #masthead -->
	
	<div id="content" class="site-content">
