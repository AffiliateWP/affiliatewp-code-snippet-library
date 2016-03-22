<?php
/**
 * Plugin Name: AffiliateWP - Make Promotion Field Required
 * Plugin URI: http://affiliatewp.com
 * Description: Makes the promotion field on the affiliate registration form required
 * Author: Michael Beil
 * Author URI: http://michaelbeil.com
 * Version: 1.0
 */

 function affwp_make_promotion_field_required() {

	$affiliate_wp = affiliate_wp();

	if ( empty( $_POST['affwp_promotion_method'] ) ) {
 		$affiliate_wp->register->add_error( 'affwp_promotion_method_invalid', 'Please explain how you will promote us' );
 		}

}
 add_action( 'affwp_process_register_form', 'affwp_make_promotion_field_required' );
