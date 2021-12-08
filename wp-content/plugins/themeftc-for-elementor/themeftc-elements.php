<?php
/**
 * Plugin Name: ThemeFTC for Elementor 
 * Description: Advanced utility for more options with Elementor, Elementor plugin required.
 * Plugin URI: https://demo.themeftc.com
 * Version: 1.0.4
 * Author: ThemeFTC Team
 * Author URI: https://demo.themeftc.com
 * Text Domain: ftc-element
 *
 * @package WordPress
 * @subpackage FTC Elements
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define FTC_ELEMENTS_PLUGIN_FILE.
if ( ! defined( 'FTC_ELEMENTS_PLUGIN_FILE' ) ) {
	define( 'FTC_ELEMENTS_PLUGIN_FILE', __FILE__ );
}

// Define plugin dir path.
if ( ! defined( 'FTC_ELEMENTS_DIR' ) ) {
	define( 'FTC_ELEMENTS_DIR', plugin_dir_path( __FILE__ ) );
}

// Define plugin url.
if ( ! defined( 'FTC_ELEMENTS_URL' ) ) {
	define( 'FTC_ELEMENTS_URL', plugin_dir_url( __FILE__ ) );
}

// Define plugin version.
if ( ! defined( 'FTC_ELEMENTS_VERSION' ) ) {
	define( 'FTC_ELEMENTS_VERSION', '1.0.0' );
}

require_once FTC_ELEMENTS_DIR . 'includes/class-main-elements.php';
