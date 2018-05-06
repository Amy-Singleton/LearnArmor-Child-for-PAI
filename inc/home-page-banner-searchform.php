<?php

/**
 *
 * Shortcode to show a custom search form in the Introduction section of the home page
 * 
 */

function learnarmor_child_searchform( $form ) {
 
    $form = '<div class="col-sm-12"><form role="search" method="get" id="searchform" class="col-sm-6" action="' . home_url( '/' ) . '" >
    <label id="s" class="screen-reader-text" for="s">' . __('Search for:') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="search-field" class="col-sm-8" placeholder="What would you like to learn about?" aria-labelledby="searchform s" />
    <input type="submit" id="search-submit-banner" class="col-sm-3" value="'. esc_attr__('Search') .'" />
    </form></div>';
 
    return $form;
}
add_shortcode('wp_search', 'learnarmor_child_searchform');
