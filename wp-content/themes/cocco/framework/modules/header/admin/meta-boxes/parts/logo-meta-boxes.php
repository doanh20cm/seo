<?php

if ( ! function_exists( 'cocco_mikado_logo_meta_box_map' ) ) {
	function cocco_mikado_logo_meta_box_map() {
		
		$logo_meta_box = cocco_mikado_create_meta_box(
			array(
				'scope' => apply_filters( 'cocco_mikado_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'logo_meta' ),
				'title' => esc_html__( 'Logo', 'cocco' ),
				'name'  => 'logo_meta'
			)
		);
		
		cocco_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Default', 'cocco' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'cocco' ),
				'parent'      => $logo_meta_box
			)
		);
		
		cocco_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_dark_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Dark', 'cocco' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'cocco' ),
				'parent'      => $logo_meta_box
			)
		);
		
		cocco_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_light_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Light', 'cocco' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'cocco' ),
				'parent'      => $logo_meta_box
			)
		);
		
		cocco_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_sticky_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Sticky', 'cocco' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'cocco' ),
				'parent'      => $logo_meta_box
			)
		);
		
		cocco_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_mobile_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Mobile', 'cocco' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'cocco' ),
				'parent'      => $logo_meta_box
			)
		);
	}
	
	add_action( 'cocco_mikado_action_meta_boxes_map', 'cocco_mikado_logo_meta_box_map', 47 );
}