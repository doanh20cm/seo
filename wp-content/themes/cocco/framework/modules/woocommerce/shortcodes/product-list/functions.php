<?php

if ( ! function_exists( 'cocco_mikado_add_product_list_shortcode' ) ) {
	function cocco_mikado_add_product_list_shortcode( $shortcodes_class_name ) {
		$shortcodes = array(
			'CoccoCore\CPT\Shortcodes\ProductList\ProductList',
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	if ( cocco_mikado_core_plugin_installed() ) {
		add_filter( 'cocco_core_filter_add_vc_shortcode', 'cocco_mikado_add_product_list_shortcode' );
	}
}

if ( ! function_exists( 'cocco_mikado_add_product_list_into_shortcodes_list' ) ) {
	function cocco_mikado_add_product_list_into_shortcodes_list( $woocommerce_shortcodes ) {
		$woocommerce_shortcodes[] = 'mkdf_product_list';
		
		return $woocommerce_shortcodes;
	}
	
	add_filter( 'cocco_mikado_filter_woocommerce_shortcodes_list', 'cocco_mikado_add_product_list_into_shortcodes_list' );
}