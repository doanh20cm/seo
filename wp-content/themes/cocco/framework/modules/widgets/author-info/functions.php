<?php

if ( ! function_exists( 'cocco_mikado_register_author_info_widget' ) ) {
	/**
	 * Function that register author info widget
	 */
	function cocco_mikado_register_author_info_widget( $widgets ) {
		$widgets[] = 'CoccoMikadoAuthorInfoWidget';
		
		return $widgets;
	}
	
	add_filter( 'cocco_core_filter_register_widgets', 'cocco_mikado_register_author_info_widget' );
}