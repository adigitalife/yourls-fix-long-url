<?php
/*
Plugin Name: Fix Long URL
Plugin URI: https://github.com/adigitalife/yourls-fix-long-url/
Description: This plugin fixes links with %20 and other similar encodings in them
Version: 2.0
Author: Aylwin
Author URI: http://adigitalife.net/
*/

// Hook our custom function into the 'sanitize_url' filter
yourls_add_filter( 'sanitize_url', 'fix_long_url' );

// Replace '%2520' with '%20' in the URL
function fix_long_url( $url, $unsafe_url ) {

	$search = array ( '%2520', '%2521', '%2522', '%2523', '%2524', '%2525', '%2526', '%2527', '%2528', '%2529', '%252A', '%252B', '%252C', '%252D', '%252E', '%252F', '%253A', '%253D', '%253F', '%255C', '%255F' );
	$replace = array ( '%20', '%21', '%22', '%23', '%24', '%25', '%26', '%27', '%28', '%29', '%2A', '%2B', '%2C', '%2D', '%2E', '%2F', '%3A', '%3D', '%3F', '%5C', '%5F' );
	$url = str_ireplace ( $search, $replace ,$url );

	// Remove any trailing spaces from the long URL
	while (substr( $url, -strlen( '%20' ) ) == '%20') {
		$url = preg_replace('/%20$/', '', $url);
	}

	return yourls_apply_filter( 'after_fix_long_url', $url, $unsafe_url );
}
