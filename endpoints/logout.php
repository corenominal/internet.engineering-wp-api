<?php
/**
 * Logout for internet·engineering users
 */
function ie_api_logout()
{
	// unset custom user cookie
    setcookie( 'ie_account', '', strtotime( '-30 days' ),
    '/', str_replace('https://','',get_bloginfo('url')) );
	
	// logout wp
	wp_logout();
	
	// return something
	$data['logout'] = true;
	return $data;
}
