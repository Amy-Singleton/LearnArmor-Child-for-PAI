<?php
if( is_plugin_active( 'sfwd-lms/sfwd_lms.php' ) ) {
    // Plugin is active
/**
 * LearnDash Vidoe Duration Meta Box
 * @link http://jeremyhixon.com/tool/wordpress-meta-box-generator/
 */

function learnarmor_duration_get_meta( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

function learnarmor_duration_add_meta_box() {
        add_meta_box(
		'learnarmor_duration-learnarmor-duration',
		__( 'Video Duration', 'learnarmor_duration' ),
		'learnarmor_duration_html',
		'sfwd-courses',
		'side',
		'high'
	);
	add_meta_box(
		'learnarmor_duration-learnarmor-duration',
		__( 'Video Duration', 'learnarmor_duration' ),
		'learnarmor_duration_html',
		'sfwd-lessons',
		'side',
		'high'
	);
	add_meta_box(
		'learnarmor_duration-learnarmor-duration',
		__( 'Video Duration', 'learnarmor_duration' ),
		'learnarmor_duration_html',
		'sfwd-topic',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'learnarmor_duration_add_meta_box' );

function learnarmor_duration_html( $post) {
	wp_nonce_field( '_learnarmor_duration_nonce', 'learnarmor_duration_nonce' ); ?>

	<table width="100%">
            <tr>
                <td>
                    <label for="learnarmor_duration_video_duration"><?php _e( 'Duration', 'learnarmor_duration' ); ?></label><br>
                </td>
                <td>
                    <input type="text" name="learnarmor_duration_video_duration" id="learnarmor_duration_video_duration" value="<?php echo learnarmor_duration_get_meta( 'learnarmor_duration_video_duration' ); ?>">
                </td>
            </tr>
        </table>
	<?php
}

function learnarmor_duration_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['learnarmor_duration_nonce'] ) || ! wp_verify_nonce( $_POST['learnarmor_duration_nonce'], '_learnarmor_duration_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['learnarmor_duration_video_duration'] ) )
		update_post_meta( $post_id, 'learnarmor_duration_video_duration', esc_attr( $_POST['learnarmor_duration_video_duration'] ) );
}
add_action( 'save_post', 'learnarmor_duration_save' );

/*
	Usage: learnarmor_duration_get_meta( 'learnarmor_duration_video_duration' )
*/

}//End if plugin SWFD_LMS is active