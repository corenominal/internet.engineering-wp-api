<?php
/**
 * Database set-up
 */
function iewp_api_db_setup()
{
	global $wpdb;

	// Create users table
	$query = $wpdb->query( 'SHOW TABLES LIKE "ie_users"' );
	if( !$query )
	{
		$sql = "CREATE TABLE `ie_users` (
		  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
		  `user_login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
		  `user_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
		  `user_id` int(11) DEFAULT 0 NOT NULL,
		  PRIMARY KEY (`ID`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

		$query = $wpdb->query( $sql );
	}

	// Create table for storing user's twitter accounts
	$query = $wpdb->query( 'SHOW TABLES LIKE "ie_twitter_accounts"' );
	if( !$query )
	{
		$sql = "CREATE TABLE `ie_twitter_accounts` (
		  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
		  `user_id` int(11) DEFAULT 0 NOT NULL,
		  `twitter_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
		  `screen_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
		  `oauth_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
		  `oauth_token_secret` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
		  `account_str` text COLLATE utf8mb4_unicode_ci NOT NULL,
		  `date_created` int(11) DEFAULT 0 NOT NULL,
		  PRIMARY KEY (`ID`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

		$query = $wpdb->query( $sql );
	}
}

iewp_api_db_setup();
