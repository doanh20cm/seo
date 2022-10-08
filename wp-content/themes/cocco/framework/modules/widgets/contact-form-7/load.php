<?php

if ( cocco_mikado_contact_form_7_installed() ) {
	include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/widgets/contact-form-7/contact-form-7.php';
	
	add_filter( 'cocco_core_filter_register_widgets', 'cocco_mikado_register_cf7_widget' );
}

if ( ! function_exists( 'cocco_mikado_register_cf7_widget' ) ) {
	/**
	 * Function that register cf7 widget
	 */
	function cocco_mikado_register_cf7_widget( $widgets ) {
		$widgets[] = 'CoccoMikadoContactForm7Widget';
		
		return $widgets;
	}
}