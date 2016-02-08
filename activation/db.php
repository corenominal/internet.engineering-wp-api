<?php
/**
 * Database set-up
 */
function iewp_api_db_setup()
{
	global $wpdb;

	//Create users table
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
}

iewp_api_db_setup();
