<?php
/*
Plugin Name: Cocco Instagram Feed
Description: Plugin that adds Instagram feed functionality to our theme
Author: Mikado Themes
Version: 2.0.2
*/
define('COCCO_INSTAGRAM_FEED_VERSION', '2.0.2');
define('COCCO_INSTAGRAM_ABS_PATH', dirname(__FILE__));
define('COCCO_INSTAGRAM_REL_PATH', dirname(plugin_basename(__FILE__ )));

if ( ! function_exists( 'cocco_instagram_feed_is_core_installed' ) ) {
    /**
     * Checks whether theme is installed or not
     * @return bool
     */
    function cocco_instagram_feed_is_core_installed() {
        return defined( 'COCCO_CORE_VERSION' );
    }
}

include_once 'load.php';

if(!function_exists('cocco_instagram_feed_text_domain')) {
    /**
     * Loads plugin text domain so it can be used in translation
     */
    function cocco_instagram_feed_text_domain() {
        load_plugin_textdomain('cocco-instagram-feed', false, COCCO_INSTAGRAM_REL_PATH.'/languages');
    }

    add_action('plugins_loaded', 'cocco_instagram_feed_text_domain');
}

