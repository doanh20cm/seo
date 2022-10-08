<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Mkdf_Pricing_Plan extends WPBakeryShortCodesContainer {}
}

if ( ! function_exists( 'cocco_core_add_pricing_plans_shortcodes' ) ) {
	function cocco_core_add_pricing_plans_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'CoccoCore\CPT\Shortcodes\PricingPlan\PricingPlan',
			'CoccoCore\CPT\Shortcodes\PricingPlan\PricingPlanItem'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'cocco_core_filter_add_vc_shortcode', 'cocco_core_add_pricing_plans_shortcodes' );
}

if ( ! function_exists( 'cocco_core_set_pricing_plan_custom_style_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom css style for pricing table shortcode
	 */
	function cocco_core_set_pricing_plan_custom_style_for_vc_shortcodes( $style ) {
		$current_style = '.wpb_content_element.wpb_mkdf_pricing_plan_item > .wpb_element_wrapper { 
			background-color: #f4f4f4; 
		}';
		
		$style .= $current_style;
		
		return $style;
	}
	
	add_filter( 'cocco_core_filter_add_vc_shortcodes_custom_style', 'cocco_core_set_pricing_plan_custom_style_for_vc_shortcodes' );
}

if ( ! function_exists( 'cocco_core_set_pricing_plan_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for pricing plan shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function cocco_core_set_pricing_plan_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-pricing-plan';
		$shortcodes_icon_class_array[] = '.icon-wpb-pricing-plan-item';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'cocco_core_filter_add_vc_shortcodes_custom_icon_class', 'cocco_core_set_pricing_plan_icon_class_name_for_vc_shortcodes' );
}