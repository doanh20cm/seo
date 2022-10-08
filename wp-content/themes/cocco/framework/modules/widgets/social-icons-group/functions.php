<?php

if ( ! function_exists( 'cocco_mikado_register_social_icons_widget' ) ) {
	/**
	 * Function that register social icon widget
	 */
	function cocco_mikado_register_social_icons_widget( $widgets ) {
		$widgets[] = 'CoccoMikadoClassIconsGroupWidget';
		
		return $widgets;
	}
	
	add_filter( 'cocco_core_filter_register_widgets', 'cocco_mikado_register_social_icons_widget' );
}