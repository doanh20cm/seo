<?php

if ( ! function_exists( 'cocco_mikado_get_hide_dep_for_header_standard_options' ) ) {
	function cocco_mikado_get_hide_dep_for_header_standard_options() {
		$hide_dep_options = apply_filters( 'cocco_mikado_filter_header_standard_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'cocco_mikado_header_standard_map' ) ) {
	function cocco_mikado_header_standard_map( $parent ) {
		$hide_dep_options = cocco_mikado_get_hide_dep_for_header_standard_options();
		
		cocco_mikado_add_admin_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'set_menu_area_position',
				'default_value'   => 'right',
				'label'           => esc_html__( 'Choose Menu Area Position', 'cocco' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'cocco' ),
				'options'         => array(
					'right'  => esc_html__( 'Right', 'cocco' ),
					'left'   => esc_html__( 'Left', 'cocco' ),
					'center' => esc_html__( 'Center', 'cocco' )
				),
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'cocco_mikado_action_additional_header_menu_area_options_map', 'cocco_mikado_header_standard_map' );
}