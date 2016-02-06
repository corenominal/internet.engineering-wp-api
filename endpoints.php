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
}
add_action( 'rest_api_init', 'ie_api_register_endpoints' );

/**
 * Endpoint to check role capabilities
 */
require_once( plugin_dir_path( __FILE__ ) . 'endpoints/get_role.php' );

/**
 * Endpoint for user login
 */
require_once( plugin_dir_path( __FILE__ ) . 'endpoints/login.php' );

/**
 * Endpoint for user logout
 */
require_once( plugin_dir_path( __FILE__ ) . 'endpoints/logout.php' );
