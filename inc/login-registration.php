<?php
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
        #registerform > p > select {
                width: 100%;
                padding: 10px;
                margin: 1em auto;
        }
        p.newsletter-auto-signup-notice {
            text-align: center;
            font-size:16px;
            font-weight: 300;
            color: #1c3a54;
            border-top: 1px solid #efefef;
            padding: 15px;
            border-bottom: 1px solid #efefef;
        }
        #registerform > p#reg_passmail {
                font-size: 18px;
                font-weight: 300;
                text-align: center;
                border-top: 1px solid #efefef;
                padding: 15px;
                border-bottom: 1px solid #efefef;
        }
	.login #backtoblog, .login #nav {
	
		text-align: center;
	}
         </style>';
}
add_action( 'login_head', 'learnarmor_child_custom_login_style', 99 );

add_action('admin_head', 'learnarmor_child_admin_css');
function learnarmor_child_custom_title_on_logo() {
	return 'PsychArmor Institute';
}
add_filter('login_headertitle', 'learnarmor_child_custom_title_on_logo', 99);
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
 * Add Registration Field
 * @link https://codex.wordpress.org/Customizing_the_Registration_Form
 *
 */
add_action( 'register_form', 'learnarmor_child_register_form', 1 );
function learnarmor_child_register_form() {

$first_name = ( ! empty( $_POST['first_name'] ) ) ? sanitize_text_field( $_POST['first_name'] ) : '';
    
    ?>
    <p>
        <label for="first_name"><?php _e( 'First Name', 'learnarmor-child' ) ?><br />
            <input type="text" name="first_name" id="first_name" class="input" value="<?php echo esc_attr(  $first_name  ); ?>" size="25" /></label>
    </p>
    <?php
  $last_name = ( ! empty( $_POST['last_name'] ) ) ? sanitize_text_field( $_POST['last_name'] ) : '';
    
    ?>
    <p>
        <label for="last_name"><?php _e( 'Last Name', 'learnarmor-child' ) ?><br />
            <input type="text" name="last_name" id="last_name" class="input" value="<?php echo esc_attr(  $last_name  ); ?>" size="25" /></label>
    </p>
    <?php
    $organization = ( ! empty( $_POST['organization'] ) ) ? sanitize_text_field( $_POST['organization'] ) : '';
    
    ?>
    <p>
        <label for="organization"><?php _e( 'Organization', 'learnarmor-child' ) ?><br />
            <input type="text" name="organization" id="organization" class="input" value="<?php echo esc_attr(  $organization  ); ?>" size="25" /></label>
    </p>
    <?php
    
    $role_with_veterans = ( ! empty( $_POST['role_with_veterans'] ) ) ? sanitize_text_field( $_POST['role_with_veterans'] ) : '';
    
    ?>
    <p>
        <?php
        $user = wp_get_current_user();
        ?>
        <label for="role_with_veterans">Role with Veterans</label>
	<select name="role_with_veterans" id="role_with_veterans" >
		<option> -- Select Your Role with Veterans -- </option>
		<option value="Cargiver/Familiy" <?php selected( 'Cargiver/Familiy', get_the_author_meta( 'role_with_veterans', $user->ID ) ); ?>>Cargiver/Familiy</option>
		<option value="Employer" <?php selected( 'Employer', get_the_author_meta( 'role_with_veterans', $user->ID ) ); ?>>Employer</option>
		<option value="Helathcare/Mental Healthcare Provider" <?php selected( 'Helathcare/Mental Healthcare Provider', get_the_author_meta( 'role_with_veterans', $user->ID ) ); ?>>Helathcare/Mental Healthcare Provider</option>
		<option value="Member of a civic, non-profit or other organization that supports Veterans" <?php selected( 'Member of a civic, non-profit or other organization that supports Veterans', get_the_author_meta( 'role_with_veterans', $user->ID ) ); ?>>Member of a civic, non-profit or other organization that supports Veterans</option>
		<option value="Volunteer" <?php selected( 'Volunteer', get_the_author_meta( 'role_with_veterans', $user->ID ) ); ?>>Volunteer</option>
		<option value="Transitioning service member or Veteran" <?php selected( 'Transitioning service member or Veteran', get_the_author_meta( 'role_with_veterans', $user->ID ) ); ?>>Transitioning service member or Veteran</option>
		<option value="Other" <?php selected( 'Other', get_the_author_meta( 'role_with_veterans', $user->ID ) ); ?>>Other</option>
        </select>
    </p>
    <?php
}

//2. Add validation. In this case, we make sure first_name is required.
add_filter( 'registration_errors', 'learnarmor_child_registration_errors', 10, 3 );
function learnarmor_child_registration_errors( $errors, $sanitized_user_login, $user_email ) {
    
    if ( empty( $_POST['first_name'] ) || ! empty( $_POST['first_name'] ) && trim( $_POST['first_name'] ) == '' ) {
    $errors->add( 'first_name_error', sprintf('<strong>%s</strong>: %s',__( 'ERROR', 'learnarmor-child' ),__( 'Please enter your first name.', 'learnarmor-child' ) ) );

    }
    if ( empty( $_POST['last_name'] ) || ! empty( $_POST['last_name'] ) && trim( $_POST['last_name'] ) == '' ) {
    $errors->add( 'last_name_error', sprintf('<strong>%s</strong>: %s',__( 'ERROR', 'learnarmor-child' ),__( 'Please enter your last name.', 'learnarmor-child' ) ) );

    }
    if ( empty( $_POST['organization'] ) || ! empty( $_POST['organization'] ) && trim( $_POST['organization'] ) == '' ) {
    $errors->add( 'organization_error', sprintf('<strong>%s</strong>: %s',__( 'ERROR', 'learnarmor-child' ),__( 'Please enter your organization name.', 'learnarmor-child' ) ) );

    }
    return $errors;
}

//3. Finally, save our extra registration user meta.
add_action( 'user_register', 'learnarmor_child_user_register' );
function learnarmor_child_user_register( $user_id ) {
    if ( ! empty( $_POST['first_name'] ) ) {
        update_user_meta( $user_id, 'first_name', sanitize_text_field( $_POST['first_name'] ) );
    }
    if ( ! empty( $_POST['last_name'] ) ) {
        update_user_meta( $user_id, 'last_name', sanitize_text_field( $_POST['last_name'] ) );
    }
    if ( ! empty( $_POST['organization'] ) ) {
        update_user_meta( $user_id, 'organization', sanitize_text_field( $_POST['organization'] ) );
    }    
    if ( ! empty( $_POST['role_with_veterans'] ) ) {
        update_user_meta( $user_id, 'role_with_veterans', sanitize_text_field( $_POST['role_with_veterans'] ) );
    }

}


add_action( 'register_form', 'learnarmor_child_newsletter_auto_enroll_msg' );
function learnarmor_child_newsletter_auto_enroll_msg() {
    echo '<p class="newsletter-auto-signup-notice">By Registering for this site you&#39;re automatically registered for our Newsletter. Don&#39;t worry we hate spam too and you can unsubscribe at any time.</p>';
}
/**
 *
 * Add Registration Field
 * @link https://wordpress.stackexchange.com/questions/34306/extra-profile-field-as-select-box
 *
 */    
   
add_action( 'show_user_profile', 'learndash_child_show_extra_profile_fields', 1 );
add_action( 'edit_user_profile', 'learndash_child_show_extra_profile_fields', 1 );

function learndash_child_show_extra_profile_fields( $user ) { ?>
    <h3>Extra profile information</h3>
    <table class="form-table">
        <tr>
            <th><label for="gender">Gender</label></th>
            <td>
                <select name="gender" id="gender" >
                    <option value="Male" <?php selected( 'Male', get_the_author_meta( 'gender', $user->ID ) ); ?>>Male</option>
                    <option value="Female" <?php selected( 'Female', get_the_author_meta( 'gender', $user->ID ) ); ?>>Female</option>
                </select>
            </td>
        </tr>
    </table>
        <table class="form-table">
        <tr>
            <th><label for="gender">Organization</label></th>
            <td>
            <input type="text" name="organization" id="organization" class="input" value="<?php echo esc_attr(  $organization  ); ?>" size="25" /></label>
            </td>
        </tr>
    </table>
    <table class="form-table">
        
            <table class="form-table">
        <tr>
            <th><label for="role_with_veterans">Role with Veterans</label></th>
            <td>
                <select name="role_with_veterans" id="role_with_veterans" >
                    <option value="Cargiver/Familiy" <?php selected( 'Cargiver/Familiy', get_the_author_meta( 'role_with_veterans', $user->ID ) ); ?>>Cargiver/Familiy</option>
                    <option value="Employer" <?php selected( 'Employer', get_the_author_meta( 'role_with_veterans', $user->ID ) ); ?>>Employer</option>
                    <option value="Helathcare/Mental Healthcare Provider" <?php selected( 'Helathcare/Mental Healthcare Provider', get_the_author_meta( 'role_with_veterans', $user->ID ) ); ?>>Helathcare/Mental Healthcare Provider</option>
                    <option value="Member of a civic, non-profit or other organization that supports Veterans" <?php selected( 'Member of a civic, non-profit or other organization that supports Veterans', get_the_author_meta( 'role_with_veterans', $user->ID ) ); ?>>Member of a civic, non-profit or other organization that supports Veterans</option>
                    <option value="Volunteer" <?php selected( 'Volunteer', get_the_author_meta( 'role_with_veterans', $user->ID ) ); ?>>Volunteer</option>
                    <option value="Transitioning service member or Veteran" <?php selected( 'Transitioning service member or Veteran', get_the_author_meta( 'role_with_veterans', $user->ID ) ); ?>>Transitioning service member or Veteran</option>
                    <option value="Other" <?php selected( 'Other', get_the_author_meta( 'role_with_veterans', $user->ID ) ); ?>>Other</option>
                </select>
            </td>
        </tr>
    </table>
<?php }

add_action( 'personal_options_update', 'learndash_child_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'learndash_child_save_extra_profile_fields' );

function learndash_child_save_extra_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
    update_usermeta( $user_id, 'gender', $_POST['gender'] );
    update_usermeta( $user_id, 'organization', $_POST['organization'] );
    update_usermeta( $user_id, 'role_with_veterans', $_POST['role_with_veterans'] );
}