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

add_action( 'wp_enqueue_scripts', 'learnarmor_child_enqueue_styles' );
function learnarmor_child_enqueue_styles() {
    // Bootstrap Styles
    $bootstrap_style = 'learnarmor-child-bootstrap-style';
    wp_enqueue_style( 'learnarmor-child-bootstrap-style', get_template_directory_uri() . '/css/bootstrap.css', '20172410');
    $parent_style = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css', array(), filemtime(get_stylesheet_directory() .'/style.css'), 'all' );     
    //Enqueue USAAEF Fonts
    wp_enqueue_style( 'learnarmor-child-usaaef-google-font', 'https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet' );
    //wp_enqueue_style( 'learnarmor-child-usaaef-font', get_template_directory_uri() . '/css/MyFontsWebfontsKit.css' );
    $woo_parent = 'learnarmor-woocommerce-style';
    wp_enqueue_style( 'learnarmor-child-woocommerce-style', get_template_directory_uri() . '/css/woocommerce.css', array($woo_parent), filemtime(get_stylesheet_directory() . '/css/woocommerce.css'), 'all');
    wp_enqueue_style( 'dashicons' );
    $child_style = 'child-style';
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ), filemtime(get_stylesheet_directory() .'/style.css'), 'all' );   
}
//add_action( 'widgets_init', 'learnarmor_child_learndash_custom_sidebar' );
//function learnarmor_child_learndash_custom_sidebar() {
//
//}
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
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
    require get_stylesheet_directory() . '/inc/customize-woocommerce.php';
}
/**
 * Customize JetPack
 */
if ( defined( 'JETPACK__VERSION' ) ) {
    require get_stylesheet_directory() . '/inc/customize-jetpack.php';
}
/* Fix the From Name and Email Address for Emails */
add_filter('wp_mail_from', 'learnarmor_child_new_mail_from');
add_filter('wp_mail_from_name', 'learnarmor_child_new_mail_from_name');
/**
 * Change the Wordpress Default From Name and Email Address for Emails
 * @link https://www.daretothink.co.uk/change-default-wordpress-email-address/
 */ 
function learnarmor_child_new_mail_from($old) {
return 'info@psycharmor.org';
}
function learnarmor_child_new_mail_from_name($old) {
return 'PsychArmor Institute';
}

?>
