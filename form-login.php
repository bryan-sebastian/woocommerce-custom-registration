<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<div id="customer_login_register">
	<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

	<div class="container">
		<div class="row">
			<div class="col-12">
				<?php wc_print_notices(); ?>
			</div>
		</div>
		<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
			<div class="row">
				<div class="__login col-lg-4">
		<?php endif; ?>
					<h2><?php esc_html_e( 'LOGIN YOU ACCOUNT', 'woocommerce' ); ?></h2>
					<form name="login" method="post">
						<?php do_action( 'woocommerce_login_form_start' ); ?>

						<input type="text" class="__input_field" name="username" id="username" placeholder="Username" required value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" />
						<input type="password" class="__input_field" name="password" id="password" placeholder="Password" required />

						<?php do_action( 'woocommerce_login_form' ); ?>
						
						<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="__lost_password"><?php esc_html_e( 'Forgot your password?', 'woocommerce' ); ?></a>

						<p class="__form_action">
							<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
							<button type="submit" class="__submit" name="login" value="<?php esc_attr_e( 'Log In', 'woocommerce' ); ?>"><?php esc_html_e( 'Log In', 'woocommerce' ); ?></button>
							<label class="__remember_me">
								<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
							</label>
						</p>

						<?php do_action( 'woocommerce_login_form_end' ); ?>
					</form>
		<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
				</div>
				<div class="__register col-lg-8">
					<h2><?php esc_html_e( 'DON’T HAVE AN ACCOUNT? REGISTER NOW', 'woocommerce' ); ?></h2>
					<form name="register" method="post">
						<?php do_action( 'woocommerce_register_form_start' ); ?>

						<div class="row">
							<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
								<div class="col-md-6">
									<input type="text" class="__input_field" name="username" id="reg_username" placeholder="Username" required value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" />
								</div>
							<?php endif; ?>
							
							<div class="col-md-6">
								<input type="text" class="__input_field" name="first_name" id="reg_first_name" placeholder="First Name" required value="<?php echo ( ! empty( $_POST['first_name'] ) ) ? esc_attr( wp_unslash( $_POST['first_name'] ) ) : ''; ?>" />
							</div>
							<div class="col-md-6">
								<input type="text" class="__input_field" name="last_name" id="reg_last_name" placeholder="Last Name" required value="<?php echo ( ! empty( $_POST['last_name'] ) ) ? esc_attr( wp_unslash( $_POST['last_name'] ) ) : ''; ?>" />
							</div>
							<div class="col-md-6">
								<input type="email" class="__input_field" name="email" id="reg_email" placeholder="Email" required value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" />
							</div>
							<div class="col-md-6">
								<input type="tel" class="__input_field" name="contact_number" id="reg_contact_number" placeholder="Contact Number" required value="<?php echo ( ! empty( $_POST['contact_number'] ) ) ? esc_attr( wp_unslash( $_POST['contact_number'] ) ) : ''; ?>" />
							</div>
							<div class="col-md-6">
								<input type="text" class="__input_field" name="address" id="reg_address" placeholder="Address" required value="<?php echo ( ! empty( $_POST['address'] ) ) ? esc_attr( wp_unslash( $_POST['address'] ) ) : ''; ?>" />
							</div>
							<div class="col-md-6">
								<input type="text" class="__input_field" name="city" id="reg_city" placeholder="City" required value="<?php echo ( ! empty( $_POST['city'] ) ) ? esc_attr( wp_unslash( $_POST['city'] ) ) : ''; ?>" />
							</div>
							<div class="col-md-6">
								<input type="text" class="__input_field" name="zip_code" id="reg_zip_code" placeholder="Postal / Zip Code" required value="<?php echo ( ! empty( $_POST['zip_code'] ) ) ? esc_attr( wp_unslash( $_POST['zip_code'] ) ) : ''; ?>" />
							</div>
							<div class="col-md-6">
								<select class="__input_field" name="country" id="reg_country">
									<option value="">Select Country</option>
									<option value="PH">Philippines</option>
									<option value="CH">Switzerland</option>
								</select>
							</div>

							<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
								<div class="col-md-6">
									<input type="password" class="__input_field" name="password" id="reg_password" placeholder="Password" required />
								</div>
								<div class="col-md-6">
									<input type="password" class="__input_field" name="retype_password" id="reg_retype_password" placeholder="Re-Type Password" required />
								</div>
							<?php endif; ?>
						</div>

						<?php do_action( 'woocommerce_register_form' ); ?>

						<p class="__form_action">
							<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
							<button type="submit" class="__submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
						</p>

						<?php do_action( 'woocommerce_register_form_end' ); ?>
					</form>
				</div>
			</div>
		<?php endif; ?>
	</div>

	<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
</div>