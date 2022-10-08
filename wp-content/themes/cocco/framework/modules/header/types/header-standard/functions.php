<?php

if ( ! function_exists( 'cocco_mikado_register_header_standard_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function cocco_mikado_register_header_standard_type( $header_types ) {
		$header_type = array(
			'header-standard' => 'CoccoMikado\Modules\Header\Types\HeaderStandard'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'cocco_mikado_init_register_header_standard_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function cocco_mikado_init_register_header_standard_type() {
		add_filter( 'cocco_mikado_filter_register_header_type_class', 'cocco_mikado_register_header_standard_type' );
	}
	
	add_action( 'cocco_mikado_action_before_header_function_init', 'cocco_mikado_init_register_header_standard_type' );
}