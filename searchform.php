<?php
/**
 * Template for displaying search forms in LearnArmor Child
 *
 * @package learnarmor-child
 * 
 */

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'learnarmor-child' ); ?></span>
		<input type="search-field" id="" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'learnarmor-child' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	
	<button type="submit" class="search-submit"><?php echo '<span class="dashicons dashicons-search"></span>'; ?><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'learnarmor-child' ); ?></span></button>
</form>