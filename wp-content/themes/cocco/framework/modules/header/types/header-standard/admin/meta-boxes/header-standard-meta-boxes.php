<?php

if ( ! function_exists( 'cocco_mikado_get_hide_dep_for_header_standard_meta_boxes' ) ) {
	function cocco_mikado_get_hide_dep_for_header_standard_meta_boxes() {
		$hide_dep_options = apply_filters( 'cocco_mikado_filter_header_standard_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'cocco_mikado_header_standard_meta_map' ) ) {
	function cocco_mikado_header_standard_meta_map( $parent ) {
		$hide_dep_options = cocco_mikado_get_hide_dep_for_header_standard_meta_boxes();
		
		cocco_mikado_create_meta_box_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'mkdf_set_menu_area_position_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Choose Menu Area Position', 'cocco' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'cocco' ),
				'options'         => array(
					''       => esc_html__( 'Default', 'cocco' ),
					'left'   => esc_html__( 'Left', 'cocco' ),
					'right'  => esc_html__( 'Right', 'cocco' ),
					'center' => esc_html__( 'Center', 'cocco' )
				),
				'dependency' => array(
					'hide' => array(
						'mkdf_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'cocco_mikado_action_additional_header_area_meta_boxes_map', 'cocco_mikado_header_standard_meta_map' );
}