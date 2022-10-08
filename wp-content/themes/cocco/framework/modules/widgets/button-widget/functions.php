<?php

if ( ! function_exists( 'cocco_mikado_register_button_widget' ) ) {
	/**
	 * Function that register button widget
	 */
	function cocco_mikado_register_button_widget( $widgets ) {
		$widgets[] = 'CoccoMikadoButtonWidget';
		
		return $widgets;
	}
	
	add_filter( 'cocco_core_filter_register_widgets', 'cocco_mikado_register_button_widget' );
}