<?php

if ( ! function_exists( 'cocco_mikado_register_custom_font_widget' ) ) {
	/**
	 * Function that register custom font widget
	 */
	function cocco_mikado_register_custom_font_widget( $widgets ) {
		$widgets[] = 'CoccoMikadoCustomFontWidget';
		
		return $widgets;
	}
	
	add_filter( 'cocco_core_filter_register_widgets', 'cocco_mikado_register_custom_font_widget' );
}