<?php

if(!function_exists('cocco_mikado_woocommerce_quickview_link')) {
	/**
	 * Function that returns quick view link
	 */
	function cocco_mikado_woocommerce_quickview_link(){
		global $product;

		if ( version_compare( WOOCOMMERCE_VERSION, '3.0' ) >= 0 ) {
			$product_id = $product->get_id();
		} else {
			$product_id = $product->id;
		}

		print '<div class="mkdf-yith-wcqv-holder"><a href="#" class="yith-wcqv-button" data-product_id="'.$product_id.'"><span class="icon dripicons-preview"></span></a></div>';

	}
}

if(!function_exists('cocco_mikado_woocommerce_disable_yith_pretty_photo')) {
	/**
	 * Function that disable YITH Quick View pretty photo style
	 */
	function cocco_mikado_woocommerce_disable_yith_pretty_photo() {
		//is woocommerce installed?
		if(cocco_mikado_is_woocommerce_installed() && cocco_mikado_is_yith_wcqv_install()) {

			wp_deregister_style('woocommerce_prettyPhoto_css');
		}
	}

	add_action('wp_footer', 'cocco_mikado_woocommerce_disable_yith_pretty_photo');
}

if(!function_exists('cocco_mikado_woocommerce_quickview_shortcode')) {
	function cocco_mikado_woocommerce_quickview_shortcode() {

		if(cocco_mikado_is_yith_wishlist_installed()) {
			echo do_shortcode('[yith_wcwl_add_to_wishlist]');
		}
	}
}

