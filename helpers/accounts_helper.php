<?php
/**
 * Helper functions for user accounts
 */

// User is logged in
function iewp_api_user_is_logged_in()
{
	if( !isset( $_COOKIE['ie_account'] ) )
		return false;

	return true;
}

// Return user id from hash
function iewp_api_id_from_hash()
{
	global $wpdb;

	if( !isset( $_COOKIE['ie_account'] ) )
		return false;

	$hash = $_COOKIE['ie_account'];

	$account = $wpdb->get_row( "SELECT * FROM ie_users WHERE user_hash = '$hash'", ARRAY_A );

	if( $account == null )
		return false;

	return( $account['user_id'] );

}