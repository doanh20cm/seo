<?php

if ( ! function_exists( 'cocco_mikado_map_post_link_meta' ) ) {
	function cocco_mikado_map_post_link_meta() {
		$link_post_format_meta_box = cocco_mikado_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Link Post Format', 'cocco' ),
				'name'  => 'post_format_link_meta'
			)
		);
		
		cocco_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_link_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Link', 'cocco' ),
				'description' => esc_html__( 'Enter link', 'cocco' ),
				'parent'      => $link_post_format_meta_box
			)
		);
	}
	
	add_action( 'cocco_mikado_action_meta_boxes_map', 'cocco_mikado_map_post_link_meta', 24 );
}