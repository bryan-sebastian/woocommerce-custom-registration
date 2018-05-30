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
		$validation_errors->add( 'billing_first_name_error', __( '<strong>Error</strong>: First name is required.', 'woocommerce' ) );

	if ( isset( $_POST['last_name'] ) && empty( $_POST['last_name'] ) )
		$validation_errors->add( 'billing_last_name_error', __( '<strong>Error</strong>: Last name is required.', 'woocommerce' ) );
	
	if ( isset( $_POST['contact_number'] ) && empty( $_POST['contact_number'] ) )
		$validation_errors->add( 'billing_phone_error', __( '<strong>Error</strong>: Contact number is required.', 'woocommerce' ) );
	
	if ( isset( $_POST['address'] ) && empty( $_POST['address'] ) )
		$validation_errors->add( 'billing_address_1_error', __( '<strong>Error</strong>: Address is required.', 'woocommerce' ) );
	
	if ( isset( $_POST['city'] ) && empty( $_POST['city'] ) )
		$validation_errors->add( 'billing_city_error', __( '<strong>Error</strong>: City is required.', 'woocommerce' ) );
	
	if ( isset( $_POST['zip_code'] ) && empty( $_POST['zip_code'] ) )
		$validation_errors->add( 'billing_zip_code_error', __( '<strong>Error</strong>: Postal / Zip code is required.', 'woocommerce' ) );
	
	if ( isset( $_POST['country'] ) && empty( $_POST['country'] ) )
		$validation_errors->add( 'billing_country_error', __( '<strong>Error</strong>: Country is required.', 'woocommerce' ) );

	if ( isset( $_POST['retype_password'] ) && empty( $_POST['retype_password'] ) )
		$validation_errors->add( 'retype_password_error', __( '<strong>Error</strong>: Re-Type password is required.', 'woocommerce' ) );

	if( isset( $_POST['password'] ) && ! empty( $_POST['password'] ) && isset( $_POST['retype_password'] ) && ! empty( $_POST['retype_password'] ) ) {
		if( $_POST['password'] != $_POST['retype_password'] )
			$validation_errors->add( 'password_retypepassword_validation_error', __( "<strong>Error</strong>: Passwords don't match.", 'woocommerce' ) );
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
	}

	if ( isset( $_POST['last_name'] ) ) {
		// WordPress default last name field.
		update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['last_name'] ) );

		// WooCommerce billing last name.
		update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['last_name'] ) );
	}

	if ( isset( $_POST['contact_number'] ) ) {
		// WooCommerce billing phone
		update_user_meta( $customer_id, 'billing_phone', sanitize_text_field( $_POST['contact_number'] ) );
	}

	if ( isset( $_POST['address'] ) ) {
		// WooCommerce billing address line 1
		update_user_meta( $customer_id, 'billing_address_1', sanitize_text_field( $_POST['address'] ) );
	}

	if ( isset( $_POST['city'] ) ) {
		// WooCommerce billing city
		update_user_meta( $customer_id, 'billing_city', sanitize_text_field( $_POST['city'] ) );
	}

	if ( isset( $_POST['zip_code'] ) ) {
		// WooCommerce billing postcode
		update_user_meta( $customer_id, 'billing_postcode', sanitize_text_field( $_POST['zip_code'] ) );
	}

	if ( isset( $_POST['country'] ) ) {
		// WooCommerce billing country
		update_user_meta( $customer_id, 'billing_country', sanitize_text_field( $_POST['country'] ) );
	}
}
add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields' );