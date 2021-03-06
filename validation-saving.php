<?php
/**
* Validate the extra register fields.
*
* @param string $username          Current username.
* @param string $email             Current email.
* @param object $validation_errorsWP_Error object.
*
* @return void
*/
function wooc_validate_extra_register_fields( $username, $email, $validation_errors ) {
	if ( isset( $_POST['first_name'] ) && empty( $_POST['first_name'] ) )
		$validation_errors->add( 'first_name_error', __( 'First name is required.', 'woocommerce' ) );

	if ( isset( $_POST['last_name'] ) && empty( $_POST['last_name'] ) )
		$validation_errors->add( 'last_name_error', __( 'Last name is required.', 'woocommerce' ) );
	
	if ( isset( $_POST['address'] ) && empty( $_POST['address'] ) )
		$validation_errors->add( 'address_1_error', __( 'Address is required.', 'woocommerce' ) );
	
	if ( isset( $_POST['city'] ) && empty( $_POST['city'] ) )
		$validation_errors->add( 'city_error', __( 'City is required.', 'woocommerce' ) );
	
	if ( isset( $_POST['zip_code'] ) && empty( $_POST['zip_code'] ) )
		$validation_errors->add( 'zip_code_error', __( 'Postal / Zip code is required.', 'woocommerce' ) );
	
	if ( isset( $_POST['country'] ) && empty( $_POST['country'] ) )
		$validation_errors->add( 'country_error', __( 'Country is required.', 'woocommerce' ) );

	if ( isset( $_POST['retype_password'] ) && empty( $_POST['retype_password'] ) )
		$validation_errors->add( 'retype_password_error', __( 'Re-Type password is required.', 'woocommerce' ) );

	if( isset( $_POST['password'] ) && ! empty( $_POST['password'] ) && isset( $_POST['retype_password'] ) && ! empty( $_POST['retype_password'] ) ) {
		if( $_POST['password'] != $_POST['retype_password'] )
			$validation_errors->add( 'password_retypepassword_validation_error', __( "Passwords don't match.", 'woocommerce' ) );
	}
}
add_action( 'woocommerce_register_post', 'wooc_validate_extra_register_fields', 10, 3 );

/**
* Save the extra register fields.
*
* @paramint $customer_id Current customer ID.
*
* @return void
*/
function wooc_save_extra_register_fields( $customer_id ) {
	if ( isset( $_POST['first_name'] ) ) {
		// WordPress default first name field.
		update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['first_name'] ) );

		// WooCommerce billing first name.
		update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['first_name'] ) );

		// WooCommerce shipping first name.
		update_user_meta( $customer_id, 'shipping_first_name', sanitize_text_field( $_POST['first_name'] ) );
	}

	if ( isset( $_POST['last_name'] ) ) {
		// WordPress default last name field.
		update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['last_name'] ) );

		// WooCommerce billing last name.
		update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['last_name'] ) );

		// WooCommerce shipping last name.
		update_user_meta( $customer_id, 'shipping_last_name', sanitize_text_field( $_POST['last_name'] ) );
	}

	if ( isset( $_POST['contact_number'] ) ) {
		// WooCommerce billing phone
		update_user_meta( $customer_id, 'billing_phone', sanitize_text_field( $_POST['contact_number'] ) );
	}

	if ( isset( $_POST['address'] ) ) {
		// WooCommerce billing address line 1
		update_user_meta( $customer_id, 'billing_address_1', sanitize_text_field( $_POST['address'] ) );

		// WooCommerce shipping address line 1
		update_user_meta( $customer_id, 'shipping_address_1', sanitize_text_field( $_POST['address'] ) );
	}

	if ( isset( $_POST['city'] ) ) {
		// WooCommerce billing city
		update_user_meta( $customer_id, 'billing_city', sanitize_text_field( $_POST['city'] ) );

		// WooCommerce shipping city
		update_user_meta( $customer_id, 'shipping_city', sanitize_text_field( $_POST['city'] ) );
	}

	if ( isset( $_POST['zip_code'] ) ) {
		// WooCommerce billing postcode
		update_user_meta( $customer_id, 'billing_postcode', sanitize_text_field( $_POST['zip_code'] ) );

		// WooCommerce shipping postcode
		update_user_meta( $customer_id, 'shipping_postcode', sanitize_text_field( $_POST['zip_code'] ) );
	}

	if ( isset( $_POST['country'] ) ) {
		// WooCommerce billing country
		update_user_meta( $customer_id, 'billing_country', sanitize_text_field( $_POST['country'] ) );

		// WooCommerce shipping country
		update_user_meta( $customer_id, 'shipping_country', sanitize_text_field( $_POST['country'] ) );
	}
}
add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields' );