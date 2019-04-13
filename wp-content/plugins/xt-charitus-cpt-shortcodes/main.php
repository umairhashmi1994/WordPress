<?php
/**
 * Plugin Name:       Charitus CPT and Shortcode
 * Plugin URI:        http://wpbean.com/plugins/
 * Description:       Custom post types and shortcodes for Charitus theme.
 * Version:           1.0
 * Author:            XooThemes
 * Author URI:        https://xoothemes.com
 * Text Domain:       xt-charitus-cpt-shortcode
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 


/**
 * Localization
 */

if( !function_exists('charitus_shortcode_plugin_textdomain') ){
	function charitus_shortcode_plugin_textdomain() {
		load_plugin_textdomain( 'xt-charitus-cpt-shortcode', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}
}
add_action( 'init', 'charitus_shortcode_plugin_textdomain' );



/**
 * Current version
 */

if ( ! defined( 'XT_THEME_VERSION' ) ) {
	define( 'XT_THEME_VERSION', '1.0' );
}

/**
 * Requred files 
 */


require_once dirname( __FILE__ ) . '/inc/theme-functions.php';
require_once dirname( __FILE__ ) . '/inc/theme-cpt.php';
require_once dirname( __FILE__ ) . '/inc/theme-shortcode.php';

if ( defined( 'WPB_VC_VERSION' ) || function_exists( 'vc_add_param' ) ) {
	require_once dirname( __FILE__ ) . '/inc/vc-map.php';
}
