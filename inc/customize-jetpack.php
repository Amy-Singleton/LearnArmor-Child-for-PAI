<?php

/**
 * Remove Jetpack sharing so we can move it below the course list for:
 * boss-child/boss-learndash/course.php and boss-child/content.php
 *
 **/
add_action( 'loop_start', 'jptweak_remove_share' );
function jptweak_remove_share() {
    remove_filter( 'the_content', 'sharing_display', 19 );
    remove_filter( 'the_excerpt', 'sharing_display', 19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
} 

/**
 * Remove Jetpack Related Posts so we can put it below the course content
 * 
 *
 **/
add_filter( 'wp', 'jetpackme_remove_rp', 20 );
function jetpackme_remove_rp() {
    if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
        $jprp = Jetpack_RelatedPosts::init();
        $callback = array( $jprp, 'filter_add_target_to_dom' );
        remove_filter( 'the_content', $callback, 40 );
    }
}


/**
 * Change the Jetpack Related Posts headline
 * 
 **/
add_filter( 'jetpack_relatedposts_filter_headline', 'jetpackme_related_posts_headline',20 );
function jetpackme_related_posts_headline( $headline ) {
$headline = sprintf(
            '<h3 class="jp-relatedposts-headline"><em>%s</em></h3>',
            esc_html( 'Additional Information' )
            );
    
        return $headline;
}

function jetpackme_add_pages_to_related( $post_type, $post_id ) {
    if ( is_array( $post_type ) ) {
        $search_types = $post_type;
    } else {
        $search_types = array( $post_type );
    }
 
    // Add pages
    $search_types[] = array('page','sfwd-courses');
    return $search_types;
}
add_filter( 'jetpack_relatedposts_filter_post_type', 'jetpackme_add_pages_to_related', 10, 2 );

//function jetpackme_allow_pages_for_relatedposts( $enabled ) {
//    if ( is_page('budget-videos') ) {
//        $enabled = true;
//    }
//    return $enabled;
//}        
//add_filter( 'jetpack_relatedposts_filter_enabled_for_request', 'jetpackme_allow_pages_for_relatedposts' );
