<?php
/**
 * Method for Twitter login
 */
function ie_api_twitter_login()
{
	// Test user is logged in
	if( !iewp_api_user_is_logged_in() )
		die( 'Error: please sign in' );

	// Twitter app credentials
	$consumer_key = trim( get_option( 'iewp_api_twitterapp_consumer_key', '' ) );
	$consumer_secret = trim( get_option( 'iewp_api_twitterapp_consumer_secret', '' ) );
	$callback_url = site_url( 'wp-json/ie-api/twitter-callback' );

	// Test app creds have been set
	if( $consumer_key == '' || $consumer_secret == '' )
		die( 'Error: invalid twitter app credentials' );

	// Get a request token
	$connection = new TwitterOAuth( $consumer_key, $consumer_secret );
	$request_token = $connection->getRequestToken( $callback_url );

	// Store the request token for use in callback
	$user_id = iewp_api_id_from_hash();
	update_user_meta( $user_id, 'twitter_oauth_token', $request_token['oauth_token'] );
	update_user_meta( $user_id, 'twitter_oauth_token_secret', $request_token['oauth_token_secret'] );

	// Redirect to Twitter app approval page
	$redirect_url = $connection->getAuthorizeURL($request_token);
	wp_redirect($redirect_url);
	exit;
}
