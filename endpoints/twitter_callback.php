<?php
/**
 * Callback method for Twitter Oauth
 */
function ie_api_twitter_callback( $request_data )
{
	global $wpdb;

	// Capture request data
	$data = $request_data->get_params();

	// Test user is logged in
	if( !iewp_api_user_is_logged_in() )
		die( 'Error: please sign in' );

	// Twitter app credentials
	$consumer_key = trim( get_option( 'iewp_api_twitterapp_consumer_key', '' ) );
	$consumer_secret = trim( get_option( 'iewp_api_twitterapp_consumer_secret', '' ) );

	// Test app creds have been set
	if( $consumer_key == '' || $consumer_secret == '' )
		die( 'Error: invalid twitter app credentials' );

	// Retrieve the user's id
	$user_id = iewp_api_id_from_hash();

	// Sanity check - user denied access
	if ( isset( $data['denied'] ) )
		die( 'Error: you denied access' );

	// Sanity check - no get vars from Twitter
	if ( !isset( $data['oauth_token'] ) || !isset( $data['oauth_verifier'] ) )
		die( 'Error: there was a problem retrieving tokens' );

	// Retrieve user's oauth token
	$twitter_oauth_token = get_user_meta($user_id, 'twitter_oauth_token', true);
	$twitter_oauth_token_secret = get_user_meta($user_id, 'twitter_oauth_token_secret', true);

	// Verify the token and get credentials for future use
	$connection = new TwitterOAuth( $consumer_key, $consumer_secret, $twitter_oauth_token, $twitter_oauth_token_secret );
	$token_credentials = $connection->getAccessToken( $data['oauth_verifier'] );

	// Get account details
	$twitter = new TwitterOAuth($consumer_key, $consumer_secret, $token_credentials['oauth_token'], $token_credentials['oauth_token_secret']);
	$account = $twitter->get('account/verify_credentials');
	
	// Cleanup any previous credentials
    $wpdb->delete( 'ie_twitter_accounts', array( 'user_id' => $user_id ), array( '%d' ) );

    // Insert user credentials
	$wpdb->insert('ie_twitter_accounts', 
			  array( 'user_id'				=> $user_id,
			  		 'twitter_id'			=> $account->id_str,
			  		 'screen_name'			=> $account->screen_name,
			  		 'oauth_token'			=> $token_credentials['oauth_token'],
			  		 'oauth_token_secret'	=> $token_credentials['oauth_token_secret'],
			  		 'account_str'			=> json_encode( $account ),
			  		 'date_created'  		=> time()
			  ), 
			  array( 
			  		 '%d',
			  		 '%s',
			  		 '%s',
			  		 '%s',
			  		 '%s',
			  		 '%s',
			  		 '%d'
			  )
	);

	// TODO: redirect

}
