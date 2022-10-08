<?php

if ( ! function_exists( 'cocco_mikado_disable_wpml_css' ) ) {
	function cocco_mikado_disable_wpml_css() {
		define( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true );
	}
	
	add_action( 'after_setup_theme', 'cocco_mikado_disable_wpml_css' );
}