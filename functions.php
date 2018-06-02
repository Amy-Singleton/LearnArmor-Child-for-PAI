<?php
/**
 * learnarmor-child functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package learnarmor-child
 */
add_action( 'after_setup_theme', 'learnarmor_child_setup' );
if ( ! function_exists( 'learnarmor_child_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function learnarmor_child_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on learnarmor, use a find and replace
		 * to change 'learnarmor' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'learnarmor-child', get_template_directory() . '/languages' );
	}
endif;

/**
 * @link https://wordpress.stackexchange.com/questions/189985/how-to-properly-dequeue-scripts-and-styles-in-child-theme
 *
 **/
function learnarmor_child_dequeue_unnecessary_styles() {
    wp_dequeue_style( 'learnarmor-bootstrap-style' );
    wp_deregister_style( 'learnarmor-bootstrap-style' );
    //Dequeue Learnarmor Default Google Font Open Sans
    wp_dequeue_style( 'learnarmor-google-font');
    wp_deregister_style( 'learnarmor-google-font');
    //Deque LearnArmor Default Google Font Martel
    wp_dequeue_style( 'learnarmor-martel-google-fonts');
    wp_deregister_style( 'learnarmor-martel-google-fonts');  
}
add_action( 'wp_print_styles', 'learnarmor_child_dequeue_unnecessary_styles' );

function learnarmor_child_dequeue_parent_scripts() {
    wp_dequeue_script( 'learnarmor-bootstrap-script' );
    wp_deregister_script( 'learnarmor-bootstrap-script' );
    wp_dequeue_script( 'learnarmor-navigation' );
    wp_deregister_script( 'learnarmor-navigation');
}
add_action( 'wp_print_styles', 'learnarmor_child_dequeue_parent_scripts' );

function learnarmor_child_enqueue_scripts() {
    // Bootstrap Styles
    $bootstrap_style = 'learnarmor-child-bootstrap-style';
    wp_enqueue_style( 'learnarmor-child-bootstrap-style', get_template_directory_uri() . '/css/bootstrap.css', '20172410');
    $parent_style = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css', array(), filemtime(get_stylesheet_directory() .'/style.css'), 'all' );
   //Enqueue PsychArmor Fonts
    wp_enqueue_style( 'learnarmor-child-google-font', 'https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700|Roboto:300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet' );
    wp_enqueue_style( 'dashicons' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ), filemtime(get_stylesheet_directory() .'/style.css'), 'all' );
    wp_enqueue_script( 'learnarmor-child-bootstrap-js', get_stylesheet_directory_uri() . '/js/bootstrap.js', array(), '20180411', true );
    wp_enqueue_script( 'learnarmor-child-bootstrap-sponsor-carousel-js', get_stylesheet_directory_uri() . '/js/bootstrap-sponsors-carousel.js', array(), '20180525', true );
    if (is_page('my-dashboard') || get_post_type() == 'sfwd-courses' || get_post_type() == 'sfwd-lessons') {
        wp_enqueue_script( 'learnarmor-child-ld-customizations', get_stylesheet_directory_uri() . '/js/custom-learndash-scripts.js', array(), '20180518', true );
    }
    if(is_page(95515) && !is_user_logged_in()){
        wp_enqueue_script( 'learnarmor-child-ld-shrm', get_stylesheet_directory_uri() . '/js/shrm-scripts.js', array(), '20180501', true );
    }
}
add_action( 'wp_enqueue_scripts', 'learnarmor_child_enqueue_scripts' );
/**
 *
 * Remove Parent Theme Login Menu
 * 
 */
function remove_default_menu(){
    unregister_nav_menu('login');
}
add_action( 'after_setup_theme', 'remove_default_menu', 11 );
/**
 *
 * Add Bootstrap 3 Child Theme Menu
 * 
 */
function load_child_walker(){
    remove_action('after_setup_theme','load_parent_walker' );
    require_once get_stylesheet_directory() . '/walkermenu.php';
}
add_action( 'after_setup_theme', 'load_child_walker' );
/**
 *
 * Make the Bootstrap 3 Menu Support a depth of 3 
 * Add support for custom .shrink child menu items
 * 
 */
add_action ('wp_footer','learnarmor_child_custom_head',1);
function learnarmor_child_custom_head() { ?> 
    <script>
    jQuery(document).ready(function($) {
           $('.dropdown-submenu a').on('focus', function(e){
                $('.dropdown > .dropdown-submenu > .dropdown-menu').css('display','block');
            });
	    $('.dropdown-submenu a').on('blur', function(e){
                $('.dropdown > .dropdown-submenu > .dropdown-menu').css('display','none');
            });
            $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
                event.preventDefault(); 
                event.stopPropagation(); 
                $(this).parent().siblings().removeClass('open');
                $(this).parent().toggleClass('open');
            });
         $(window).scroll(function () {
		if ($(window).scrollTop() > 75 && $(window).width() > 1024) {
                    $('#search-in-header').addClass('shrink');
		} else {
                    $('#search-in-header').removeClass('shrink');
		}
	});
        $('a.back-to-top > span.glyphicon').removeClass('glyphicon-circle-arrow-up');
        $('a.back-to-top > span.glyphicon').removeClass('glyphicon');
        $('a.back-to-top > span').addClass('dashicons dashicons-arrow-up-alt2');
    });
    </script>
<?php }

/**
 * 
 * Add Aria lables to drip links and input fields
 *
 **/
add_action ('wp_footer','learnarmor_child_accessibility',1);
function learnarmor_child_accessibility() {
?>
<script>
	jQuery(document).ready(function($) {
            $('div.drip-powered-by a').attr('aria-label','drip newsletter developer external site link');
            $('.drip-text-field').attr('aria-label', 'email');
        });
</script>

<?php 
}
/**
 * Remove the Serach Form from the Primary Menu
 */

remove_filter( 'wp_nav_menu_items','learnarmor_add_search_box', 10, 2 );

function learnarmor_child_admin_css() {
    wp_enqueue_style('admin_styles' , get_template_directory_uri().'/css/admin.css');
}
add_action('admin_enqueue_scripts', 'learnarmor_child_admin_css');
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function learnarmor_child_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Search', 'learnarmor' ),
		'id'            => 'sidebar-search',
		'description'   => esc_html__( 'Add search widgets here.', 'learnarmor-child' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
        //Search Sidebar Widget Area

}
add_action( 'widgets_init', 'learnarmor_child_widgets_init' );
/**
 * Customize JetPack
 */
if ( defined( 'JETPACK__VERSION' ) ) {
    require get_stylesheet_directory() . '/inc/customize-jetpack.php';
}
/**
 * Customize Login and Registration
 */
require get_stylesheet_directory() . '/inc/login-registration.php';
/**
 * Featured Content Shortcode by Taxonomy 
 */
require get_stylesheet_directory() . '/inc/featured-content-shortcode.php';
/**
 * Include Custom Template Tags
 */
require get_stylesheet_directory() . '/inc/custom-template-tags.php';

/**
 * LearnDash Vidoe Duration
 */
require get_stylesheet_directory() . '/inc/learndash-video-duration.php';

/**
 * Subject Matter Expert Widget
 */
require get_stylesheet_directory() . '/inc/subject-matter-expert.php';
/**
 * Sponsored By Widget
 */
require get_stylesheet_directory() . '/inc/sponsored-by.php';
/**
 * Change WP Default From Name and Email Address for Emails
 */
require get_stylesheet_directory() . '/inc/wp-from-email-address.php';
/**
 * Add a Search Form with a Shortcode
 */
require get_stylesheet_directory() . '/inc/home-page-banner-searchform.php';

/**
 * Customize Archive Pages
 * @link https://premium.wpmudev.org/blog/add-custom-post-types-to-tags-and-categories-in-wordpress/
 *
 */

function learnarmor_child_add_custom_types_to_tax( $query ) {
if (( is_tag() || is_category() ) && $query->is_main_query() && empty( $query->query_vars['suppress_filters'] )) {

    // Get all your post types
    $post_types = get_post_types();
    
    $query->set( 'post_type', $post_types );
    return $query;
    }
}
add_filter( 'pre_get_posts', 'learnarmor_child_add_custom_types_to_tax' );

if (class_exists( 'SFWD_LMS')) {
    function learnarmor_child_search_filter($query) {
    
    remove_action('pre_get_posts','learnarmor_search_filter');
        if ( !is_admin() && $query->is_main_query() ) {
            if ($query->is_search) {
              $query->set('post_type', array( 'post', 'sfwd-courses' ) );
            }
        }
    }
    //add_action('pre_get_posts','learnarmor_child_search_filter');

    function learnarmor_child_add_excerpt_support_for_cpt() {
        add_post_type_support( 'sfwd-courses', 'excerpt' );
    }
    add_action( 'init', 'learnarmor_child_add_excerpt_support_for_cpt' );
}


/**
 *
 * Add Post and Page IDs if is admin Admin
 * @link https://premium.wpmudev.org/blog/display-wordpress-post-page-ids/
 *
 */

if (is_admin()){
    function learnarmor_child_post_id_column( $columns ) {
       $columns['revealid_id'] = 'ID';
       return $columns;
    }
    add_filter( 'manage_posts_columns', 'learnarmor_child_post_id_column', 5 );
    
    function learnarmor_child_post_id_column_content( $column, $id ) {
      if( 'revealid_id' == $column ) {
        echo $id;
      }
    }
    add_action( 'manage_posts_custom_column', 'learnarmor_child_post_id_column_content', 5, 2 );
}
function remove_additional_p($content){
  $content = force_balance_tags($content);
  return preg_replace('#<p>\s*+(<br\s*/*>)?|s*</p>#i','',$content);
}
//add_filter('the_content','remove_additional_p',20,1);

?>