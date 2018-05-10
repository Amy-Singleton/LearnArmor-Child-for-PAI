<?php


function learnarmor_child_custom_excerpts($limit) {
    return wp_trim_words(get_the_excerpt(), $limit);
}
add_post_type_support('sfwd-courses', 'excerpt');
function custom_query_shortcode($atts = [], $content = null, $tag = '') {  
    // override default attributes with user attributes
    $a = shortcode_atts( array(
            "term"              => '',
            "class"             => '',
            "posts_per_page"    => ''
    ), $atts, $tag);
    // normalize attribute keys, lowercase
    $atts = array_change_key_case((array)$atts, CASE_LOWER);

    $query = new WP_Query(
        array( "post_type" => "sfwd-courses",// not "post-type" !
              "taxonomy" => "ld_course_tag",
               "term" => $a['term'],
               "class"=> '',
               "posts_per_page" => 3
        ) );
    while ($query->have_posts()) : $query->the_post();
     
        ob_start();
        echo '<div class="' . $a['class'] . '">';
        echo '<div class="post-thumbnail">';
        echo the_post_thumbnail();
        echo '</div>';
        echo '<div class="wrap-text"><h3>';
        echo the_title();
        echo '</h3>';
        echo '<span class="light-font">';
        echo  learnarmor_child_custom_excerpts(30);
        echo '</span>';
        echo '</div></div>';
        $content = ob_get_clean(); 
    endwhile;
    return $content;
}
add_shortcode("featured_content", "custom_query_shortcode");