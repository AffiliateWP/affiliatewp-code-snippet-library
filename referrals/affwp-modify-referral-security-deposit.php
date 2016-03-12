<?php
/**
 * Plugin Name: AffiliateWP - Modify Referral If A Security Deposit Is Present
 * Plugin URI: https://affiliatewp.com
 * Description: Modify referral rate for all products to be 20% after the security deposit is deducted.
 * Author: Michael Beil
 * Author URI: https://affiliatewp.com
 * Version: 1.0
 */

function affwp_modify_referral_security_deposit( $referral_amount, $affiliate_id, $amount, $reference, $product_id ) {

	$security_deposit = 100;
	$special_referral_rate = 0.2;
	$special_referral_amount = ($amount - $security_deposit) * $special_referral_rate; // 20% of the total amount after we subtract the $100 security deposit

	if ( $amount > 100 ) {
		$referral_amount = $special_referral_amount;
	}
	return $referral_amount;
}

add_filter( 'affwp_calc_referral_amount', 'affwp_modify_referral_security_deposit', 10, 5 );