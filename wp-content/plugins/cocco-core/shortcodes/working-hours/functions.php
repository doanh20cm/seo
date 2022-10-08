<?php
if(!function_exists('cocco_core_add_working_hours_shortcodes')) {
	function cocco_core_add_working_hours_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
            'CoccoCore\CPT\Shortcodes\WorkingHours\WorkingHours'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('cocco_core_filter_add_vc_shortcode', 'cocco_core_add_working_hours_shortcodes');
}

if ( ! function_exists( 'cocco_core_set_working_hours_custom_style_for_vc_shortcodes' ) ) {
    /**
     * Function that set custom css style for item showcase shortcode
     */
    function cocco_core_set_working_hours_custom_style_for_vc_shortcodes( $style ) {
        $current_style = '.wpb_content_element.wpb_mkdf_working_hours > .wpb_element_wrapper { 
			background-color: #f4f4f4; 
		}';

        $style .= $current_style;

        return $style;
    }

    add_filter( 'cocco_core_filter_add_vc_shortcodes_custom_style', 'cocco_core_set_working_hours_custom_style_for_vc_shortcodes' );
}

if( !function_exists('cocco_core_set_working_hours_icon_class_name_for_vc_shortcodes') ) {
    /**
     * Function that set custom icon class name for property list shortcode to set our icon for Visual Composer shortcodes panel
     */
    function cocco_core_set_working_hours_icon_class_name_for_vc_shortcodes($shortcodes_icon_class_array) {
        $shortcodes_icon_class_array[] = '.icon-wpb-working-hours';

        return $shortcodes_icon_class_array;
    }

    add_filter('cocco_core_filter_add_vc_shortcodes_custom_icon_class', 'cocco_core_set_working_hours_icon_class_name_for_vc_shortcodes');
}
