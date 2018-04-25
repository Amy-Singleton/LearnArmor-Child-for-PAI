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

add_action( 'wp_print_styles', 'learnarmor_child_dequeue_unnecessary_styles' );
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

add_action( 'wp_print_styles', 'learnarmor_child_dequeue_parent_scripts' );
function learnarmor_child_dequeue_parent_scripts() {
    wp_dequeue_script( 'learnarmor-bootstrap-script' );
    wp_deregister_script( 'learnarmor-bootstrap-script' );
    wp_dequeue_script( 'learnarmor-navigation' );
    wp_deregister_script( 'learnarmor-navigation');
}

add_action( 'wp_enqueue_scripts', 'learnarmor_child_enqueue_scripts' );
function learnarmor_child_enqueue_scripts() {
    // Bootstrap Styles
    $bootstrap_style = 'learnarmor-child-bootstrap-style';
    wp_enqueue_style( 'learnarmor-child-bootstrap-style', get_template_directory_uri() . '/css/bootstrap.css', '20172410');
    $parent_style = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css', array(), filemtime(get_stylesheet_directory() .'/style.css'), 'all' );     
    //Enqueue USAAEF Fonts
   //Enqueue PsychArmor Fonts
    wp_enqueue_style( 'learnarmor-child-google-font', 'https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700|Roboto:300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet' );
    
    wp_enqueue_style( 'dashicons' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ), filemtime(get_stylesheet_directory() .'/style.css'), 'all' );
    wp_enqueue_script( 'learnarmor-child-bootstrap-js', get_stylesheet_directory_uri() . '/js/bootstrap.js', array(), '20180411', true );
    //wp_enqueue_script( 'learnarmor-child-navwalker-script', get_template_directory_uri() . '/js/bootstrap-nav-walker.js', array(), '20170928', true );
}

add_action( 'after_setup_theme', 'remove_default_menu', 11 );
function remove_default_menu(){
    unregister_nav_menu('login');
}


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
**/
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
 * Remove the Serach Form to the Primary Menu
 * @link https://bavotasan.com/2011/adding-a-search-bar-to-the-nav-menu-in-wordpress
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

/* SHRM */
add_action( 'loop_start', 'shrm_page_hide_buttons' );
function shrm_page_hide_buttons(){
        if(is_page(95515) && !is_user_logged_in()){?>
              <script>
                jQuery(document).ready(function($) {
                        $('div.course-button').remove();
                        $( '.shrm-course-group-reg' ).remove();
                });
              </script>
        <?php }
}

?>
