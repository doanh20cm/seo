<?php

if ( ! function_exists( 'cocco_mikado_map_post_video_meta' ) ) {
	function cocco_mikado_map_post_video_meta() {
		$video_post_format_meta_box = cocco_mikado_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Video Post Format', 'cocco' ),
				'name'  => 'post_format_video_meta'
			)
		);
		
		cocco_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_video_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Video Type', 'cocco' ),
				'description'   => esc_html__( 'Choose video type', 'cocco' ),
				'parent'        => $video_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Video Service', 'cocco' ),
					'self'            => esc_html__( 'Self Hosted', 'cocco' )
				)
			)
		);
		
		$mkdf_video_embedded_container = cocco_mikado_add_admin_container(
			array(
				'parent' => $video_post_format_meta_box,
				'name'   => 'mkdf_video_embedded_container'
			)
		);
		
		cocco_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_video_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video URL', 'cocco' ),
				'description' => esc_html__( 'Enter Video URL', 'cocco' ),
				'parent'      => $mkdf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'mkdf_video_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		cocco_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_video_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video MP4', 'cocco' ),
				'description' => esc_html__( 'Enter video URL for MP4 format', 'cocco' ),
				'parent'      => $mkdf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'mkdf_video_type_meta' => 'self'
					)
				)
			)
		);
		
		cocco_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_video_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Video Image', 'cocco' ),
				'description' => esc_html__( 'Enter video image', 'cocco' ),
				'parent'      => $mkdf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'mkdf_video_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'cocco_mikado_action_meta_boxes_map', 'cocco_mikado_map_post_video_meta', 22 );
}