<?php

if ( ! function_exists( 'cocco_mikado_search_body_class' ) ) {
	/**
	 * Function that adds body classes for different search types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function cocco_mikado_search_body_class( $classes ) {
		$classes[] = 'mkdf-fullscreen-search';
		$classes[] = 'mkdf-search-fade';
		
		return $classes;
	}
	
	add_filter( 'body_class', 'cocco_mikado_search_body_class' );
}

if ( ! function_exists( 'cocco_mikado_get_search' ) ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function cocco_mikado_get_search() {
		cocco_mikado_load_search_template();
	}
	
	add_action( 'cocco_mikado_action_before_page_header', 'cocco_mikado_get_search' );
}

if ( ! function_exists( 'cocco_mikado_load_search_template' ) ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function cocco_mikado_load_search_template() {
		$parameters = array(
			'search_close_icon_class' 	=> cocco_mikado_get_search_close_icon_class(),
			'search_submit_icon_class' 	=> cocco_mikado_get_search_submit_icon_class()
		);

        cocco_mikado_get_module_template_part( 'types/fullscreen/templates/fullscreen', 'search', '', $parameters );
	}
}