<?php

/**
 * Check a plugin activate
 */

if( !function_exists('charitus_plugin_active') ){
	function charitus_plugin_active( $plugin ) {
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( is_plugin_active( $plugin ) ) {
			return true;
		}

		return false;
	}
}