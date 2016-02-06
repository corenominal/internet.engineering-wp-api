<?php
/**
 * Login for internet·engineering account holders
 */
function ie_api_login( $request_data )
{
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

    // create hash for user
    $hash = uniqid();

    // insert hash into ie_user_sessions table along with userid

    // set custom user cookie
    setcookie( 'ie_account', $hash, strtotime( '+30 days' ),
    '/', str_replace('https://','',get_bloginfo('url')) );
	
	$data['user'] = $user;
	return $data;

}
