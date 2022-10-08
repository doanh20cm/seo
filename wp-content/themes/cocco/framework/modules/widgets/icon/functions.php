<?php

if ( ! function_exists( 'cocco_mikado_register_icon_widget' ) ) {
	/**
	 * Function that register icon widget
	 */
	function cocco_mikado_register_icon_widget( $widgets ) {
		$widgets[] = 'CoccoMikadoIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'cocco_core_filter_register_widgets', 'cocco_mikado_register_icon_widget' );
}