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
    if (is_page('my-dashboard') || get_post_type() == 'sfwd-courses') {
        wp_enqueue_script( 'learnarmor-child-ld-customizations', get_stylesheet_directory_uri() . '/js/custom-learndash-scripts.js', array(), '20180501', true );
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
 *
 * Remove the Serach Form from the Primary Menu
 * 
 */

remove_filter( 'wp_nav_menu_items','learnarmor_add_search_box', 10, 2 );

function learnarmor_child_admin_css() {
    wp_enqueue_style('admin_styles' , get_template_directory_uri().'/css/admin.css');
}

add_action('admin_head', 'learnarmor_child_admin_css');
function learnarmor_child_custom_title_on_logo() {
	return 'PsychArmor Institute';
}
add_filter('login_headertitle', 'learnarmor_child_custom_title_on_logo', 99);

/**
 * WordPress Custom Login Styles
 */
 
function learnarmor_child_custom_login_style() {
        echo '<style type="text/css">
        .login h1 a {
            -webkit-background-size: 320px;
            background-size: 320px;
            width: auto;
        }
        .login #login_error, .login .message {
                border-left: 4px solid #b23232;
        }
        .login form .input {
            background: #eeeeee;
            color: #555555 !important;
        }
        .login form .input::-webkit-input-placeholder { /* Chrome/Opera/Safari */
            color: #555555!important;
        }
        .login form .input::-moz-placeholder { /* Firefox 19+ */
            color: #555555!important;
        }
        .login form .input:-ms-input-placeholder { /* IE 10+ */
            color: #555555!important;
        }
        .login form .input:-moz-placeholder { /* Firefox 18- */
                    color: #555555!important;
        }
        .login form .forgetmenot input[type="checkbox"] {
             opacity: 1;
        }
        .wp-core-ui .button-primary {
             text-shadow: none;
        }
        #login form p.submit input {
             background-color: #1c3a54 !important;
        }

         </style>';
}
add_action( 'login_head', 'learnarmor_child_custom_login_style', 99 );

/**
 * Customize JetPack
 */
if ( defined( 'JETPACK__VERSION' ) ) {
    require get_stylesheet_directory() . '/inc/customize-jetpack.php';
}

/**
 * Change the Wordpress Default From Name and Email Address for Emails
 * @link https://www.daretothink.co.uk/change-default-wordpress-email-address/
 */ 
function learnarmor_child_new_mail_from($old) {
    return 'info@psycharmor.org';
}
add_filter('wp_mail_from', 'learnarmor_child_new_mail_from');
function learnarmor_child_new_mail_from_name($old) {
    return 'PsychArmor Institute';
}
add_filter('wp_mail_from_name', 'learnarmor_child_new_mail_from_name');

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
    add_action('pre_get_posts','learnarmor_child_search_filter');

    function learnarmor_child_add_excerpt_support_for_cpt() {
        add_post_type_support( 'sfwd-courses', 'excerpt' );
    }
    add_action( 'init', 'learnarmor_child_add_excerpt_support_for_cpt' );
}

/**
 *
 * Add a login/logout link to Primary navigation menu
 * 
 */
function learndash_child_add_login_logout_link($items, $args) {
     if($args->theme_location == 'primary') {
        ob_start();
        wp_loginout('index.php');
        $loginoutlink = ob_get_contents();
        ob_end_clean();
        $items .= '<li id="in-out" class="login-logout">'. $loginoutlink .'</li>';
     }
     if(!is_user_logged_in()){
        ?>
        <script>
                jQuery(document).ready(function($) {
                    $('.login-logout>a').attr('data-toggle', 'modal');
                    $('.login-logout>a').attr('href','#login-modal');
                });
        </script>
        <?php
     }
    return $items;
}
add_filter('wp_nav_menu_items', 'learndash_child_add_login_logout_link', 10, 2);

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
?>
