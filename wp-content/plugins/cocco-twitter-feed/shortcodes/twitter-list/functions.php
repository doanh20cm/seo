<?php

if ( ! function_exists( 'cocco_twitter_add_twitter_list_shortcodes' ) ) {
	function cocco_twitter_add_twitter_list_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'CoccoTwitter\Shortcodes\TwitterList\TwitterList'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
    if(function_exists('cocco_core_is_theme_registered') && cocco_core_is_theme_registered()){
        add_filter( 'cocco_twitter_filter_add_vc_shortcode', 'cocco_twitter_add_twitter_list_shortcodes' );
    }
}

if ( ! function_exists( 'cocco_twitter_set_twitter_list_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for twitter list shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function cocco_twitter_set_twitter_list_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-twitter-list';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'cocco_core_filter_add_vc_shortcodes_custom_icon_class', 'cocco_twitter_set_twitter_list_icon_class_name_for_vc_shortcodes' );
}