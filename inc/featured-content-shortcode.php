<?php

function learnarmor_child_custom_excerpts($limit) {
    return wp_trim_words(get_the_excerpt(), $limit);
}

add_filter( 'excerpt_length', 'learnarmor_custom_excerpt_length', 999 );
add_post_type_support('sfwd-courses', 'excerpt');
function custom_query_shortcode($atts = [], $content = null, $tag = '') {  
    // override default attributes with user attributes
    $a = shortcode_atts( array(
            "post_type"         => '',
            "taxonomy"          =>'',
            "term"              => '',
            "class"             => '',
            "posts_per_page"    => '',
            "order"             => '',
            "orderby"          => '',
            "excerpt_length"    => '',
    ), $atts, $tag);
    // normalize attribute keys, lowercase
    $atts = array_change_key_case((array)$atts, CASE_LOWER);

    $query = new WP_Query(
        array(
            'post_status'       => 'publish',
            "post_type"         => $a['post_type'],// not "post-type" !
            "taxonomy"          => $a['taxonomy'],
            "term"              => $a['term'],
            "class"             => $a['class'],
            "posts_per_page"    => $a['posts_per_page'],
            "orderby"           => $a['orderby'],
            "order"             => $a['order']
            //'caller_get_posts'  => 1
        ) );
    $content = '';   
    while ($query->have_posts()) : $query->the_post();
    
    /* grab the url for the full size featured image */
    $featured_img_url = get_the_post_thumbnail_url($query->ID, 'full'); 
    $the_title = get_the_title();
    $post_url = get_post_permalink();
        $content .='<div class="' . $a['class'] . '">';
        $content .= '<a href="' . $post_url . '" />';
        $content .= '<div class="post-wrap">';
        $content .= '<div class="post-thumbnail">';
        $content .= '<img src="' . $featured_img_url . '" alt="' . $the_title . ' ' . 'featured content' . '"' . '/>';
        $content .='</div>';
        $content .= '<div class="wrap-text"><span class="bold-font">';
        $content .= $the_title . ' ' . '-'. ' ';
        $content .='</span>';
        $content .='<span class="light-font">';
        $content .= learnarmor_child_custom_excerpts(20);
        $content .='</span></div>';
        $content .='</div></a></div>';
      
       // return $content;
    endwhile;

return html_entity_decode($content);
   wp_reset_query();
}
add_shortcode("featured_content", "custom_query_shortcode");
