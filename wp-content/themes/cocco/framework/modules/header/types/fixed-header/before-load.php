<?php

if ( ! function_exists( 'cocco_mikado_set_additional_hide_dep_options_for_sticky_header' ) ) {
	/**
	 * This function is used to set dependency values for sticky header panel in global option if fixed header behavior is set
	 */
	function cocco_mikado_set_additional_hide_dep_options_for_sticky_header( $hide_dep_options ) {
		$hide_dep_options[] = 'fixed-on-scroll';
		$hide_dep_options[] = 'no-behavior';
		
		return $hide_dep_options;
	}
	
	add_filter( 'cocco_mikado_filter_sticky_header_additional_hide_global_option', 'cocco_mikado_set_additional_hide_dep_options_for_sticky_header' );
}