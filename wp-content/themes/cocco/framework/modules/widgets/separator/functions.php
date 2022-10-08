<?php

if ( ! function_exists( 'cocco_mikado_register_separator_widget' ) ) {
	/**
	 * Function that register separator widget
	 */
	function cocco_mikado_register_separator_widget( $widgets ) {
		$widgets[] = 'CoccoMikadoSeparatorWidget';
		
		return $widgets;
	}
	
	add_filter( 'cocco_core_filter_register_widgets', 'cocco_mikado_register_separator_widget' );
}