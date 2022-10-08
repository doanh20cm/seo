<?php

if ( ! function_exists( 'cocco_mikado_breadcrumbs_title_type_options_meta_boxes' ) ) {
	function cocco_mikado_breadcrumbs_title_type_options_meta_boxes( $show_title_area_meta_container ) {
		
		cocco_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_breadcrumbs_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Breadcrumbs Color', 'cocco' ),
				'description' => esc_html__( 'Choose a color for breadcrumbs text', 'cocco' ),
				'parent'      => $show_title_area_meta_container
			)
		);
	}
	
	add_action( 'cocco_mikado_action_additional_title_area_meta_boxes', 'cocco_mikado_breadcrumbs_title_type_options_meta_boxes' );
}