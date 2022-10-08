<?php

if ( ! function_exists( 'cocco_mikado_register_social_icon_widget' ) ) {
	/**
	 * Function that register social icon widget
	 */
	function cocco_mikado_register_social_icon_widget( $widgets ) {
		$widgets[] = 'CoccoMikadoSocialIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'cocco_core_filter_register_widgets', 'cocco_mikado_register_social_icon_widget' );
}