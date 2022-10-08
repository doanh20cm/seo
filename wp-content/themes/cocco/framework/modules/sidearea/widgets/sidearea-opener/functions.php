<?php

if ( ! function_exists( 'cocco_mikado_register_sidearea_opener_widget' ) ) {
	/**
	 * Function that register sidearea opener widget
	 */
	function cocco_mikado_register_sidearea_opener_widget( $widgets ) {
		$widgets[] = 'CoccoMikadoSideAreaOpener';
		
		return $widgets;
	}
	
	add_filter( 'cocco_core_filter_register_widgets', 'cocco_mikado_register_sidearea_opener_widget' );
}