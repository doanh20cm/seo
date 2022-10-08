<?php

if ( ! function_exists( 'cocco_mikado_register_widgets' ) ) {
	function cocco_mikado_register_widgets() {
		$widgets = apply_filters( 'cocco_core_filter_register_widgets', $widgets = array() );
		
		foreach ( $widgets as $widget ) {
			register_widget( $widget );
		}
	}
	
	add_action( 'widgets_init', 'cocco_mikado_register_widgets' );
}