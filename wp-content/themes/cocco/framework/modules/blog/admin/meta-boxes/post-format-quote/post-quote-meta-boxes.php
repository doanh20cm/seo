<?php

if ( ! function_exists( 'cocco_mikado_map_post_quote_meta' ) ) {
	function cocco_mikado_map_post_quote_meta() {
		$quote_post_format_meta_box = cocco_mikado_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Quote Post Format', 'cocco' ),
				'name'  => 'post_format_quote_meta'
			)
		);
		
		cocco_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_quote_text_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Text', 'cocco' ),
				'description' => esc_html__( 'Enter Quote text', 'cocco' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
		
		cocco_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_quote_author_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Author', 'cocco' ),
				'description' => esc_html__( 'Enter Quote author', 'cocco' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
	}
	
	add_action( 'cocco_mikado_action_meta_boxes_map', 'cocco_mikado_map_post_quote_meta', 25 );
}