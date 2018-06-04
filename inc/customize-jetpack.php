<?php
/**
 *
 * Exclude an entire category from ever appearing among Related Posts results
 * 
 */
function jetpackme_filter_exclude_category( $filters ) {
    $filters[] = array( 'not' =>
      array( 'term' => array( 'taxonomy.ld_courses_category.slug' => 'branded' ) )
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


function learnarmor_child_jetpackme_exclude_related_post( $exclude_post_ids, $post_id ) {
    // $post_id is the post we are currently getting related posts for
    if ( is_singular() == '15-things-veterans-want-know-uncw' || is_singular() == '15-things-veterans-want-know-ivmf' || is_singular() == '15-things-veterans-want-know-phoenix') {
        $exclude_post_ids[] = 15637; // 15 Things for HCP
        $exclude_post_ids[] = 7969; // 15 Things
    }
    if ( is_singular() == '15-things-veterans-want-know') {
        $exclude_post_ids[] = 15637; // 15 Things for HCP
    }
     if ( is_singular() == '15-things-veterans-want-know-healthcare-providers') {
        $exclude_post_ids[] = 7969; // 15 Things
    }
    $exclude_post_ids[] = 10209;    // UNCW
    $exclude_post_ids[] = 10141;    // UNCW
    $exclude_post_ids[] = 10254;    // UNCW
    $exclude_post_ids[] = 10314;    // UNCW
    $exclude_post_ids[] = 10261;    // UNCW
    $exclude_post_ids[] = 10322;    // UNCW
    $exclude_post_ids[] = 10332;    // UNCW
    $exclude_post_ids[] = 10338;    // UNCW
    $exclude_post_ids[] = 10268;    // UNCW
    $exclude_post_ids[] = 10273;    // UNCW
    $exclude_post_ids[] = 10342;    // UNCW
    $exclude_post_ids[] = 10280;    // UNCW    
    $exclude_post_ids[] = 10118;    // IVMF
    $exclude_post_ids[] = 10119;    // IVMF
    $exclude_post_ids[] = 10120;    // IVMF
    $exclude_post_ids[] = 10121;    // IVMF
    $exclude_post_ids[] = 10122;    // IVMF
    $exclude_post_ids[] = 10123;    // IVMF
    $exclude_post_ids[] = 10124;    // IVMF
    $exclude_post_ids[] = 10125;    // IVMF
    $exclude_post_ids[] = 10126;    // IVMF
    $exclude_post_ids[] = 10069;    // IVMF
    $exclude_post_ids[] = 9954;     // IVMF
    $exclude_post_ids[] = 50789;    // Phoenix
    $exclude_post_ids[] = 50791;    // Phoenix
    $exclude_post_ids[] = 50795;    // Phoenix
    $exclude_post_ids[] = 50797;    // Phoenix
    $exclude_post_ids[] = 50793;    // Phoenix
    $exclude_post_ids[] = 50799;    // Phoenix
    return $exclude_post_ids;
}
add_filter( 'jetpack_relatedposts_filter_exclude_post_ids', 'learnarmor_child_jetpackme_exclude_related_post', 20, 2 );

// change thumbnail size
function jetpackchange_image_size ( $thumbnail_size ) {
 $thumbnail_size['width'] = 326;
 $thumbnail_size['height'] = 245;
// $thumbnail_size['crop'] = true;
 return $thumbnail_size;
}
add_filter( 'jetpack_relatedposts_filter_thumbnail_size', 'jetpackchange_image_size' );