<?php
/**
 * Plugin Name: internet.engineering WP API
 * Plugin URI: https://github.com/corenominal/internet.engineering-wp-api
 * Description: A WordPress plugin to provide extra functionality for the internet.engineering site.
 * Author: Philip Newborough
 * Version: 0.0.1
 * Author URI: https://corenominal.org
 */

/**
 * Plugin activation functions
 */
function iewp_api_activate()
{
	require_once( plugin_dir_path( __FILE__ ) . 'activation/db.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'activation/user_roles.php' );
}
register_activation_hook( __FILE__, 'iewp_api_activate' );

/**
 * Include all helpers
 */
foreach ( glob( plugin_dir_path( __FILE__ ) . 'helpers/*.php' ) as $helper )
{
    require_once( $helper );
}

/**
 * Register REST endpoints
 */
require_once( plugin_dir_path( __FILE__ ) . 'endpoints.php' );

/**
 * Required for Twitter App
 */
require_once( plugin_dir_path( __FILE__ ) . 'libraries/twitter/twitteroauth.php' );
require_once( plugin_dir_path( __FILE__ ) . 'twitter_app_settings.php' );
