<?php

if ( ! function_exists( 'cocco_mikado_register_woocommerce_dropdown_cart_widget' ) ) {
	/**
	 * Function that register dropdown cart widget
	 */
	function cocco_mikado_register_woocommerce_dropdown_cart_widget( $widgets ) {
		$widgets[] = 'CoccoMikadoWooCommerceDropdownCart';
		
		return $widgets;
	}
	
	add_filter( 'cocco_core_filter_register_widgets', 'cocco_mikado_register_woocommerce_dropdown_cart_widget' );
}

if ( ! function_exists( 'cocco_mikado_get_dropdown_cart_icon_class' ) ) {
	/**
	 * Returns dropdow cart icon class
	 */
	function cocco_mikado_get_dropdown_cart_icon_class() {
		$classes = array(
			'mkdf-header-cart'
		);

		$classes[] = cocco_mikado_get_icon_sources_class( 'dropdown_cart', 'mkdf-header-cart' );

		return $classes;
	}
}