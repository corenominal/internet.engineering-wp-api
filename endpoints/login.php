<?php
/**
 * Login for internet·engineering account holders
 */
function ie_api_login( $request_data )
{
	global $wpdb;

	// Capture request data
	$request = $request_data->get_params();

	// Test for login credentials
	if( !isset( $request['user_login'] ) || !isset( $request['user_password'] ) )
	{
		$data['error'] = 'Please provide a username and password.';
		return $data;
	}

	$credentials = array(
		'user_login'    => $request['user_login'],
        'user_password' => $request['user_password'],
        'rememember'    => true
	);

	$user = wp_signon( $credentials, true );

	if ( is_wp_error( $user ) ) {
        $data['error'] = 'Invalid username and password combination.';
		return $data;
    }

    // clean-up any existing hashes with ie_user_sessions table
    $wpdb->delete( 'ie_users', array( 'user_id' => $user->ID ), array( '%d' ) );

    // create hash for user
    $hash = uniqid('ie.', true);

    // insert hash into ie_user_sessions table along with userid
	$wpdb->insert('ie_users', 
			  array( 'user_login' => $user->user_login,
			  		 'user_hash'  => $hash,
			  		 'user_id'    => $user->ID
			  ), 
			  array( 
			  		 '%s', 
			  		 '%s', 
			  		 '%d' 
			  )
	);

    // set custom user cookie
    setcookie( 'ie_account', $hash, strtotime( '+30 days' ),
    '/', str_replace('https://','',get_bloginfo('url')) );
	
	$data['user'] = $user;
	return $data;

}
