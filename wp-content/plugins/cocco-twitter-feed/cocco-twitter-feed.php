<?php
/*
Plugin Name: Cocco Twitter Feed
Description: Plugin that adds Twitter feed functionality to our theme
Author: Mikado Themes
Version: 1.0.4
*/

define( 'COCCO_TWITTER_FEED_VERSION', '1.0.4' );
define( 'COCCO_TWITTER_ABS_PATH', dirname( __FILE__ ) );
define( 'COCCO_TWITTER_REL_PATH', dirname( plugin_basename( __FILE__ ) ) );
define( 'COCCO_TWITTER_URL_PATH', plugin_dir_url( __FILE__ ) );
define( 'COCCO_TWITTER_ASSETS_PATH', COCCO_TWITTER_ABS_PATH . '/assets' );
define( 'COCCO_TWITTER_ASSETS_URL_PATH', COCCO_TWITTER_URL_PATH . 'assets' );
define( 'COCCO_TWITTER_SHORTCODES_PATH', COCCO_TWITTER_ABS_PATH . '/shortcodes' );
define( 'COCCO_TWITTER_SHORTCODES_URL_PATH', COCCO_TWITTER_URL_PATH . 'shortcodes' );

if ( ! function_exists( 'cocco_twitter_feed_is_core_installed' ) ) {
    /**
     * Checks whether theme is installed or not
     * @return bool
     */
    function cocco_twitter_feed_is_core_installed() {
        return defined( 'COCCO_CORE_VERSION' );
    }
}

include_once 'load.php';

if ( ! function_exists( 'cocco_twitter_theme_installed' ) ) {
	/**
	 * Checks whether theme is installed or not
	 * @return bool
	 */
	function cocco_twitter_theme_installed() {
		return defined( 'MIKADO_ROOT' );
	}
}

if ( ! function_exists( 'cocco_twitter_feed_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function cocco_twitter_feed_text_domain() {
		load_plugin_textdomain( 'cocco-twitter-feed', false, COCCO_TWITTER_REL_PATH . '/languages' );
	}
	
	add_action( 'plugins_loaded', 'cocco_twitter_feed_text_domain' );
}