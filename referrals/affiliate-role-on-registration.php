<?php
/**
  * Plugin Name: AffiliateWP - Affiliate role on registration
  * Plugin URI: http://affiliatewp.com
  * Description: Sets an affiliate user's role to a specific role when being added as an affiliate
  * Author: Pippin Williamson
  * Author URI: http://pippinsplugins.com
  * Version: 1.0
  */

function pw_affwp_set_role_on_registration( $affiliate_id = 0 ) {

	$user_id = affwp_get_affiliate_user_id( $affiliate_id );
	$user = new WP_User( $user_id );
	$user->add_role( 'affiliate' );
}
add_action( 'affwp_insert_affiliate', 'pw_affwp_set_role_on_registration' );