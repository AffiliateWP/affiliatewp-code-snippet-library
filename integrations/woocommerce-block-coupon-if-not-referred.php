<?php
/**
 * Plugin Name: AffiliateWP - Block WooCommerce Tracked Affiliate Coupon If Not Referred
 * Plugin URI: http://affiliatewp.com
 * Description: Prevents a tracked coupon code from being used at WooCommerce's checkout unless the customer was referred by an affiliate
 * Author: Andrew Munro, Sumobi
 * Author URI: http://sumobi.com
 * Version: 1.0
 */

/**
 * Make coupon invalid if customer is not currently tracking an affiliate (can be any affiliate)
 */
function affwp_custom_block_coupon_if_no_referrer( $return, $coupon ) {
	
	// make sure AffiliateWP is installed
	if ( ! function_exists( 'affiliate_wp' ) ) {
		return $return;
	}

	// check to see if the coupon is linked to an affiliate
	$is_tracked_coupon = get_post_meta( $coupon->id, 'affwp_discount_affiliate', true );

	// make sure an affiliate is being tracked 
	if ( ! affiliate_wp()->tracking->was_referred() && $is_tracked_coupon ) {
		$return = false; // disallow the coupon
	}

	return $return;
}
add_filter( 'woocommerce_coupon_is_valid', 'affwp_custom_block_coupon_if_no_referrer', 10, 2 );