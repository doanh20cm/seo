<?php

if ( ! function_exists( 'cocco_mikado_get_popup' ) ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function cocco_mikado_get_popup() {
		
		if ( cocco_mikado_options()->getOptionValue( 'enable_popup' ) == 'yes' && ( cocco_mikado_options()->getOptionValue( 'popup_contact_form' ) !== '' || cocco_mikado_options()->getOptionValue( 'popup_title' ) !== '' ) ) {
            cocco_mikado_load_popup_template();
		}
	}
}

if ( ! function_exists( 'cocco_mikado_load_popup_template' ) ) {
	/**
	 * Loads HTML template with parameters
	 */
	function cocco_mikado_load_popup_template() {
		$parameters                           = array();
		$parameters['title']                  = cocco_mikado_options()->getOptionValue( 'popup_title' );
		$parameters['subtitle']               = cocco_mikado_options()->getOptionValue( 'popup_subtitle' );
		$parameters['popup_background_image'] = cocco_mikado_options()->getOptionValue( 'popup_background_image' );
		$parameters['contact_form']           = cocco_mikado_options()->getOptionValue( 'popup_contact_form' );
		$parameters['contact_form_style']     = cocco_mikado_options()->getOptionValue( 'popup_contact_form_style' );
		$parameters['enable_popup_prevent']   = cocco_mikado_options()->getOptionValue( 'enable_popup_prevent' );
		$parameters['popup_prevent_behavior'] = cocco_mikado_options()->getOptionValue( 'popup_prevent_behavior' );
		
		$holder_classes   = array();
		$holder_classes[] = $parameters['enable_popup_prevent'] === 'yes' ? 'mkdf-popup-prevent-enable' : 'mkdf-popup-prevent-disable';
		$holder_classes[] = ! empty( $parameters['popup_prevent_behavior'] ) ? 'mkdf-popup-prevent-' . $parameters['popup_prevent_behavior'] : 'mkdf-popup-prevent-session';
		
		$parameters['holder_classes'] = implode( ' ', $holder_classes );
		
		cocco_mikado_get_module_template_part( 'templates/popup', 'popup', '', $parameters );
	}
}