<?php

if ( ! function_exists( 'cocco_mikado_reset_options_map' ) ) {
	/**
	 * Reset options panel
	 */
	function cocco_mikado_reset_options_map() {
		
		cocco_mikado_add_admin_page(
			array(
				'slug'  => '_reset_page',
				'title' => esc_html__( 'Reset', 'cocco' ),
				'icon'  => 'fa fa-retweet'
			)
		);
		
		$panel_reset = cocco_mikado_add_admin_panel(
			array(
				'page'  => '_reset_page',
				'name'  => 'panel_reset',
				'title' => esc_html__( 'Reset', 'cocco' )
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'reset_to_defaults',
				'default_value' => 'no',
				'label'         => esc_html__( 'Reset to Defaults', 'cocco' ),
				'description'   => esc_html__( 'This option will reset all Select Options values to defaults', 'cocco' ),
				'parent'        => $panel_reset
			)
		);
	}
	
	add_action( 'cocco_mikado_action_options_map', 'cocco_mikado_reset_options_map', 100 );
}