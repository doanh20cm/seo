<?php

if ( ! function_exists( 'cocco_mikado_set_title_centered_type_for_options' ) ) {
	/**
	 * This function set centered title type value for title options map and meta boxes
	 */
	function cocco_mikado_set_title_centered_type_for_options( $type ) {
		$type['centered'] = esc_html__( 'Centered', 'cocco' );
		
		return $type;
	}
	
	add_filter( 'cocco_mikado_filter_title_type_global_option', 'cocco_mikado_set_title_centered_type_for_options' );
	add_filter( 'cocco_mikado_filter_title_type_meta_boxes', 'cocco_mikado_set_title_centered_type_for_options' );
}