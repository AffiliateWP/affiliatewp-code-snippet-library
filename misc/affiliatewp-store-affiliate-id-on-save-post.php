<?php
/**
 * Plugin Name: AffiliateWP - Store Affiliate ID on Post Save
 * Plugin URI: http://affiliatewp.com
 * Description: Add affiliate ID to postmeta table on save_post hook. This plugin is needed to save the affiliate ID to the postmeta table when bulk generating coupons in WooCommerce Smart Coupons.
 * Author: James Tyler
 * Author URI: http://www.jamestyler.me
 * Version: 1.0
 */
 
// This function is a copy of the store_discount_affiliate function from the class-woocommerce.php file in Affiliate WP.
function jt_affwp_store_discount_affiliate( $coupon_id = 0 ) {
		
		global $post;
		
		// Check post type and only run if type is 'shop_coupon'.
		if( $post->post_type != 'shop_coupon' ) {
			if( empty( $_POST['user_name'] ) ) {
	
				delete_post_meta( $coupon_id, 'affwp_discount_affiliate' );
				return;
	
			}
	
			if( empty( $_POST['user_id'] ) && empty( $_POST['user_name'] ) ) {
				return;
			}
	
			if( empty( $_POST['user_id'] ) ) {
				$user = get_user_by( 'login', $_POST['user_name'] );
				if( $user ) {
					$user_id = $user->ID;
				}
			} else {
				$user_id = absint( $_POST['user_id'] );
			}
	
			$affiliate_id = affwp_get_affiliate_id( $user_id );
	
			update_post_meta( $coupon_id, 'affwp_discount_affiliate', $affiliate_id );
		}
	}

// Store affiliate ID on save_post -> function in class-woocommerce.php is storing id on woocommerce_coupon_options_save.
add_action( 'save_post', 'jt_affwp_store_discount_affiliate' );
