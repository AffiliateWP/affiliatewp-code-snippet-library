<?php
/**
 * Plugin Name: AffiliateWP - 404 Redirect For Invalid Referral Links
 * Plugin URI: https://affiliatewp.com
 * Description: Redirects all invalid affiliate referral links to the 404 page.
 * Author: Alex Standiford, alexstandiford
 * Author URI: https://www.alexstandiford.com
 * Version: 1.0.0
 */

/*
 * Any URL that refers an inactive affiliate will be redirected to the 404 page.
 *
 * @since 1.0.0
 */
add_action( 'template_redirect', function() {
	global $wp_query;

	// Return early if not using AffiliateWP.
	if ( ! function_exists( 'affiliate_wp' ) ) {
		return;
	}

	// Get the referral variable being used in AffiliateWP.
	$referral_var = affiliate_wp()->tracking->get_referral_var();

	// Check if the referral var is set in the request.
	if ( isset( $_GET[ $referral_var ] ) ) {
		$affiliate_id = (int) $_GET[ $referral_var ];

		// If the affiliate is not active, redirect to the 404 page.
		if ( true !== affwp_is_active_affiliate( $affiliate_id ) ) {
			$wp_query->set_404();
			status_header( 404 );
			get_template_part( 404 );
			exit();
		}
	}
} );
