<?php

if(!function_exists('cocco_mikado_is_yith_wishlist_installed')) {
	function cocco_mikado_is_yith_wishlist_installed() {
		return defined('YITH_WCWL');
	}
}

if(!function_exists('cocco_mikado_woocommerce_wishlist_shortcode')) {
	function cocco_mikado_woocommerce_wishlist_shortcode() {

		if(cocco_mikado_is_yith_wishlist_installed()) {
			echo do_shortcode('[yith_wcwl_add_to_wishlist]');
		}
	}
}

if(!function_exists('mkdf_product_ajax_wishlist')) {
	function mkdf_product_ajax_wishlist(){

		$data = array(
			'wishlist_count_products' => class_exists('YITH_WCWL') ? yith_wcwl_count_products() : 0
		);
		wp_send_json($data); exit;
	}

	add_action('wp_ajax_mkdf_product_ajax_wishlist', 'mkdf_product_ajax_wishlist');
	add_action('wp_ajax_nopriv_mkdf_product_ajax_wishlist', 'mkdf_product_ajax_wishlist');
}

if ( ! function_exists( 'cocco_mikado_register_wishlist_widget' ) ) {
	/**
	 * Function that register author info widget
	 */
	function cocco_mikado_register_wishlist_widget( $widgets ) {
		$widgets[] = 'CoccoMikadoYithWishlist';

		return $widgets;
	}

	add_filter( 'cocco_core_filter_register_widgets', 'cocco_mikado_register_wishlist_widget' );
}

