<?php

if ( ! function_exists( 'cocco_core_map_testimonials_meta' ) ) {
	function cocco_core_map_testimonials_meta() {
		$testimonial_meta_box = cocco_mikado_create_meta_box(
			array(
				'scope' => array( 'testimonials' ),
				'title' => esc_html__( 'Testimonial', 'cocco-core' ),
				'name'  => 'testimonial_meta'
			)
		);
		
		cocco_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_title',
				'type'        => 'text',
				'label'       => esc_html__( 'Title', 'cocco-core' ),
				'description' => esc_html__( 'Enter testimonial title', 'cocco-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		cocco_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_text',
				'type'        => 'text',
				'label'       => esc_html__( 'Text', 'cocco-core' ),
				'description' => esc_html__( 'Enter testimonial text', 'cocco-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		cocco_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_author',
				'type'        => 'text',
				'label'       => esc_html__( 'Author', 'cocco-core' ),
				'description' => esc_html__( 'Enter author name', 'cocco-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		cocco_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_author_position',
				'type'        => 'text',
				'label'       => esc_html__( 'Author Position', 'cocco-core' ),
				'description' => esc_html__( 'Enter author job position', 'cocco-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
	}
	
	add_action( 'cocco_mikado_action_meta_boxes_map', 'cocco_core_map_testimonials_meta', 95 );
}