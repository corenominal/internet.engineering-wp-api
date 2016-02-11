<?php
/**
 * Register endpoints
 */
function ie_api_register_endpoints()
{
	// endpoint:/wp-json/ie-api/get-role
	register_rest_route( 'ie-api', '/get-role', array(
        'methods' => 'GET',
        'callback' => 'ie_api_get_role',
    ));

    // endpoint:/wp-json/ie-api/login
	register_rest_route( 'ie-api', '/login', array(
        'methods' => 'GET',
        'callback' => 'ie_api_login',
    ));

    // endpoint:/wp-json/ie-api/logout
	register_rest_route( 'ie-api', '/logout', array(
        'methods' => 'GET',
        'callback' => 'ie_api_logout',
    ));

    // endpoint:/wp-json/ie-api/twitter-login
    register_rest_route( 'ie-api', '/twitter-login', array(
        'methods' => 'GET',
        'callback' => 'ie_api_twitter_login',
    ));

    // endpoint:/wp-json/ie-api/twitter-callback
    register_rest_route( 'ie-api', '/twitter-callback', array(
        'methods' => 'GET',
        'callback' => 'ie_api_twitter_callback',
    ));
}
add_action( 'rest_api_init', 'ie_api_register_endpoints' );

/**
 * Include all endpoints
 */
foreach ( glob( plugin_dir_path( __FILE__ ) . 'endpoints/*.php' ) as $endpoint )
{
    require_once( $endpoint );
}
