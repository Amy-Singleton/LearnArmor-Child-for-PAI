<?php
/**
 * Change Order by Price to Order by Date
 * @https://www.speakinginbytes.com/2016/05/customize-woocommerce-sorting-dropdown/
 **/
add_filter( 'woocommerce_catalog_orderby', 'learnarmor_child_woocommerce_catalog_orderby', 20 );
function learnarmor_child_woocommerce_catalog_orderby( $orderby ) {
	// Add "Sort by date: oldest to newest" to the menu
	// We still need to add the functionality that actually does the sorting
	$orderby['oldest_to_recent'] = __( 'Sort by date: oldest to newest', 'woocommerce' );
	// Change the default "Sort by newness" to "Sort by date: newest to oldest"
	$orderby["date"] = __('Sort by date: newest to oldest', 'woocommerce');
	// Remove price & price-desc
	unset($orderby["price"]);
	unset($orderby["price-desc"]);
	return $orderby;
}
/**
 * Sort Products by oldest to newest
 * @https://www.speakinginbytes.com/2016/05/customize-woocommerce-sorting-dropdown/
 **/
add_filter( 'woocommerce_get_catalog_ordering_args', 'learnarmor_child_woocommerce_get_catalog_ordering_args', 20 );
function learnarmor_child_woocommerce_get_catalog_ordering_args( $args ) {
	$orderby_value = isset( $_GET['orderby'] ) ? woocommerce_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
	if ( 'oldest_to_recent' == $orderby_value ) {
		$args['orderby'] = 'date';
		$args['order']   = 'ASC';
	}
	return $args;
}

/**
 * Removes coupon form, order notes, and several billing fields if the checkout doesn't require payment
 * @link http://skyver.ge/c
 */
add_action( 'wp', 'learnarmor_child_free_checkout_fields' );
function learnarmor_child_free_checkout_fields() {
	
	// Bail we're not at checkout, or if we're at checkout but payment is needed
	if ( function_exists( 'is_checkout' ) && ( ! is_checkout() || ( is_checkout() && WC()->cart->needs_payment() ) ) ) {
		return;
	}

	// remove coupon forms since why would you want a coupon for a free cart??
	remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
	
	// Remove the "Additional Info" order notes
	add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );
       	
        add_filter("woocommerce_checkout_fields", "order_fields");
        function order_fields($fields) {
		$order = array(
		"billing_first_name",
		"billing_last_name",
		"billing_phone",
		"billing_email",
		"billing_company",
		"billing_address_1",
		"billing_address_2",
		"billing_city",
		"billing_state",
		"billing_postcode",
		"billing_country"
        );
            foreach($order as $field)
            {
            $ordered_fields[$field] = $fields["billing"][$field];
            }
            
            $fields["billing"] = $ordered_fields;
            
            $fields['billing']['billing_first_name']['priority'] = 10;
            $fields['billing']['billing_last_name']['priority'] = 20;
            $fields['billing']['billing_phone']['priority'] = 30;
            $fields['billing']['billing_email']['priority'] = 40;
            $fields['billing']['billing_company']['priority'] = 50;
            $fields['billing']['billing_address_1']['priority'] = 60;
            $fields['billing']['billing_address_2']['priority'] = 70;
            $fields['billing']['billing_city']['priority'] = 80;
            $fields['billing']['billing_state']['priority'] = 90;
            $fields['billing']['billing_postcode']['priority'] = 100;
            $fields['billing']['billing_country']['priority'] = 110;
            
            return $fields;
        }

	// A tiny CSS tweak for the account fields; this is optional
	function print_custom_css() {
		echo '<style>.create-account { margin-top: 6em; }</style>';
	}
	add_action( 'wp_head', 'print_custom_css' );
}
/**
 * Change $0.00 to Free Publication if the price equals zero
 *
 **/
add_filter('woocommerce_get_price_html', 'learnarmor_child_free_price_notice', 10, 2);
function learnarmor_child_free_price_notice($price, $product) {
	error_log($price);
	if ( $price == wc_price( 0.00 ) )
		return '<strong>' .'Free Publication' . '</strong>';
	else
		return $price;
}


add_filter( 'woocommerce_product_single_add_to_cart_text', 'learnarmor_child_custom_cart_button_text' );    // 2.1 +
function learnarmor_child_custom_cart_button_text() {
        return __( 'Order Print Version', 'woocommerce' );
}
add_filter( 'woocommerce_product_add_to_cart_text', 'woo_archive_custom_cart_button_text' );    // 2.1 +
function woo_archive_custom_cart_button_text() {
        return __( 'Add to Cart', 'woocommerce' );
}

/**
 * Hide the Coupon Field on the Cart Page
 *
 **/
function learnarmor_child_hide_coupon_field_on_cart( $enabled ) {
	if ( is_cart() ) {
		$enabled = false;
	}
	return $enabled;
}
add_filter( 'woocommerce_coupons_enabled', 'learnarmor_child_hide_coupon_field_on_cart' );
/**
 * Hide the Coupon Field on the Checkout Page
 *
 **/
function learnarmor_child_hide_coupon_field_on_checkout( $enabled ) {
	if ( is_checkout() ) {
		$enabled = false;
	}
	return $enabled;
}
add_filter( 'woocommerce_coupons_enabled', 'learnarmor_child_hide_coupon_field_on_checkout' );


/**
 * Auto Complete all WooCommerce orders.
 */
add_action( 'woocommerce_thankyou', 'learnarmor_child_woocommerce_auto_complete_order' );
function learnarmor_child_woocommerce_auto_complete_order( $order_id ) {
	
// Get an instance of the WC_Order object
$order = wc_get_order($order_id);

// Iterating through each WC_Order_Item_Product objects
foreach ($order->get_items() as $item_key => $item_values):
   /* Access Order Items data properties (in an array of values) */
    $item_data = $item_values->get_data();

    $quantity = $item_data['quantity'];

endforeach;
	if ( ! $order_id ) {
	    return;
	}
	//If the quantity is less than 50 Publicaitons, return
    	if ($quantity <= 49) {
		return;

	} else {
		//return;
		$order = wc_get_order( $order_id );
		$order->update_status( 'processing');
		$order->update_status( 'on-hold' );
	}
}


/** 
 * Reduce the strength requirement on the woocommerce password.
 * @link https://gist.github.com/BurlesonBrad/c89a825a64732a46b87c
 * @link https://rudrastyh.com/woocommerce/password-strength-meter.html
 * Strength Settings
 * 3 = Strong (default)
 * 2 = Medium
 * 1 = Weak
 * 0 = Very Weak / Anything
 */
add_filter( 'woocommerce_get_script_data', 'learnarmor_child_strength_meter_custom_strings', 10, 2 );
function learnarmor_child_strength_meter_custom_strings( $data, $handle ) {
	if ( 'wc-password-strength-meter' === $handle ) {
	    $data_new = array(
		'min_password_strength' => 2,
	        'i18n_password_error'   => esc_attr__( 'Please enter a stronger password.', 'learnarmor-child' ),
	        'i18n_password_hint'    => esc_attr__( 'Password must be at least <strong>9 Characters</strong>, contain a mix of <strong>UPPER</strong> and <strong>lowercase</strong> letters, <strong>numbers</strong>, and <strong>symbols</strong> (e.g., <strong> ! \" ? $ % ^ & </strong>). You cannot save changes until this prompt disappears.', 'learnarmor-child' )
	    );

		$data = array_merge( $data, $data_new );
	}

    return $data;
}
function learnarmor_wc_registration_strength_meter( $data ) {

    return array_merge( $data, array(
		'min_password_strength' => 2,
		'i18n_password_error' => 'Please enter a stronger password.',
		'i18n_password_hint' => 'Password must be at least <strong>9 Characters</strong>, contain a mix of <strong>UPPER</strong> and <strong>lowercase</strong> letters, <strong>numbers</strong>, and <strong>symbols</strong> (e.g., <strong> ! \" ? $ % ^ & </strong>). You cannot save changes until this prompt disappears.'
	) );
}

add_action( 'wp_enqueue_scripts',  'learnarmor_wc_registration_password_messages', 10,2 );
 
function learnarmor_wc_registration_password_messages() {
 
	wp_localize_script( 'wc-password-strength-meter', 'pwsL10n', array(
		'short' => 'Too short',
		'bad' => 'Not Good',
		'good' => 'There You Go!',
		'strong' => 'Now that\'s Even Better',
		'mismatch' => 'Your passwords do not match, please re-enter them.'
	) );
 
}