<?php

if ( ! function_exists( 'cocco_mikado_map_post_gallery_meta' ) ) {
	
	function cocco_mikado_map_post_gallery_meta() {
		$gallery_post_format_meta_box = cocco_mikado_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Gallery Post Format', 'cocco' ),
				'name'  => 'post_format_gallery_meta'
			)
		);
		
		cocco_mikado_add_multiple_images_field(
			array(
				'name'        => 'mkdf_post_gallery_images_meta',
				'label'       => esc_html__( 'Gallery Images', 'cocco' ),
				'description' => esc_html__( 'Choose your gallery images', 'cocco' ),
				'parent'      => $gallery_post_format_meta_box,
			)
		);
	}
	
	add_action( 'cocco_mikado_action_meta_boxes_map', 'cocco_mikado_map_post_gallery_meta', 21 );
}
