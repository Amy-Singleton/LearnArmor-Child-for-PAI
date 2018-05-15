<?php
/**
 *
 * Exclude an entire category from ever appearing among Related Posts results
 * 
 */
function jetpackme_filter_exclude_category( $filters ) {
    $filters[] = array( 'not' =>
      array( 'term' => array( 'taxonomy.ld_course_category.slug' => 'branded' ) )
    );
    return $filters;
}
add_filter( 'jetpack_relatedposts_filter_filters', 'jetpackme_filter_exclude_category');
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
   if(is_singular( 'sfwd-courses')) {
        $headline = sprintf(
        '<h3 class="jp-relatedposts-headline"><em>%s</em></h3>',
        esc_html( 'Suggested Courses' )
        );
    } else {
        $headline = sprintf(
        '<h3 class="jp-relatedposts-headline"><em>%s</em></h3>',
        esc_html( 'Additional Info' )
        );
        
    }
    
        return $headline;
}

function jetpackme_add_pages_to_related( $post_type, $post_id ) {
    if ( is_array( $post_type ) ) {
        $search_types = $post_type;
    } else {
        $search_types = array( $post_type );
    }
 
    // Add pages
    $search_types[] = array('page','sfwd-courses','posts');
    return $search_types;
}
add_filter( 'jetpack_relatedposts_filter_post_type', 'jetpackme_add_pages_to_related', 10, 2 );


/**
 * Add theme support for Responsive Videos.
 */
function learnarmor_child_remove_jetpackme_responsive_videos_setup() {
    remove_action( 'after_setup_theme', 'jetpackme_responsive_videos_setup' );
}
add_action( 'after_setup_theme', 'learnarmor_child_remove_jetpackme_responsive_videos_setup', 1 );

