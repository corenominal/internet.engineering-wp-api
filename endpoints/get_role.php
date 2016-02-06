<?php
/**
 * Return capabilities for the 'ie_account'
 */
function ie_api_get_role( $request_data )
{
	// Temp
	if( isset( $_COOKIE['ie_account'] ) )
	{
		$data['ie_account'] = $_COOKIE['ie_account'];
		return $data;
	}

	// Capture request data
	$request = $request_data->get_params();

	// Test for role field
	if( !isset( $request['role'] ) )
	{
		$data['error'] = 'Please provide a role. e.g. ?role=administrator';
		return $data;
	}
	
	// Get the capabilities
	$data = get_role( $request['role'] );
	
	// Test capabilities
	if( null != $data )
		return $data;

	$data['error'] = 'Could not retrieve capabilities for given role.';
	return $data;

}
