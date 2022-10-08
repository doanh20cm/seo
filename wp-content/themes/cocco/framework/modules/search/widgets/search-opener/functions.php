<?php

if ( ! function_exists( 'cocco_mikado_register_search_opener_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function cocco_mikado_register_search_opener_widget( $widgets ) {
		$widgets[] = 'CoccoMikadoSearchOpener';
		
		return $widgets;
	}
	
	add_filter( 'cocco_core_filter_register_widgets', 'cocco_mikado_register_search_opener_widget' );
}