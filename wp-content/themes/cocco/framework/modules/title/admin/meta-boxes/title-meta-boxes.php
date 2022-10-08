<?php

if ( ! function_exists( 'cocco_mikado_get_title_types_meta_boxes' ) ) {
	function cocco_mikado_get_title_types_meta_boxes() {
		$title_type_options = apply_filters( 'cocco_mikado_filter_title_type_meta_boxes', $title_type_options = array( '' => esc_html__( 'Default', 'cocco' ) ) );
		
		return $title_type_options;
	}
}

foreach ( glob( MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'cocco_mikado_map_title_meta' ) ) {
	function cocco_mikado_map_title_meta() {
		$title_type_meta_boxes = cocco_mikado_get_title_types_meta_boxes();
		
		$title_meta_box = cocco_mikado_create_meta_box(
			array(
				'scope' => apply_filters( 'cocco_mikado_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'title_meta' ),
				'title' => esc_html__( 'Title', 'cocco' ),
				'name'  => 'title_meta'
			)
		);
		
		cocco_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_show_title_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'cocco' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'cocco' ),
				'parent'        => $title_meta_box,
				'options'       => cocco_mikado_get_yes_no_select_array()
			)
		);
		
			$show_title_area_meta_container = cocco_mikado_add_admin_container(
				array(
					'parent'          => $title_meta_box,
					'name'            => 'mkdf_show_title_area_meta_container',
					'dependency' => array(
						'hide' => array(
							'mkdf_show_title_area_meta' => 'no'
						)
					)
				)
			);
		
				cocco_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_type_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area Type', 'cocco' ),
						'description'   => esc_html__( 'Choose title type', 'cocco' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => $title_type_meta_boxes
					)
				);
		
				cocco_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_in_grid_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area In Grid', 'cocco' ),
						'description'   => esc_html__( 'Set title area content to be in grid', 'cocco' ),
						'options'       => cocco_mikado_get_yes_no_select_array(),
						'parent'        => $show_title_area_meta_container
					)
				);
		
				cocco_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_title_area_height_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Height', 'cocco' ),
						'description' => esc_html__( 'Set a height for Title Area', 'cocco' ),
						'parent'      => $show_title_area_meta_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px'
						)
					)
				);
				
				cocco_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_title_area_background_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Background Color', 'cocco' ),
						'description' => esc_html__( 'Choose a background color for title area', 'cocco' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				cocco_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_title_area_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'cocco' ),
						'description' => esc_html__( 'Choose an Image for title area', 'cocco' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				cocco_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_background_image_behavior_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Behavior', 'cocco' ),
						'description'   => esc_html__( 'Choose title area background image behavior', 'cocco' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''                    => esc_html__( 'Default', 'cocco' ),
							'hide'                => esc_html__( 'Hide Image', 'cocco' ),
							'responsive'          => esc_html__( 'Enable Responsive Image', 'cocco' ),
							'responsive-disabled' => esc_html__( 'Disable Responsive Image', 'cocco' ),
							'parallax'            => esc_html__( 'Enable Parallax Image', 'cocco' ),
							'parallax-zoom-out'   => esc_html__( 'Enable Parallax With Zoom Out Image', 'cocco' ),
							'parallax-disabled'   => esc_html__( 'Disable Parallax Image', 'cocco' )
						)
					)
				);
				
				cocco_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_vertical_alignment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Vertical Alignment', 'cocco' ),
						'description'   => esc_html__( 'Specify title area content vertical alignment', 'cocco' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''              => esc_html__( 'Default', 'cocco' ),
							'header-bottom' => esc_html__( 'From Bottom of Header', 'cocco' ),
							'window-top'    => esc_html__( 'From Window Top', 'cocco' )
						)
					)
				);

		cocco_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_content_vertical_alignment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Content Vertical Alignment', 'cocco' ),
						'description'   => esc_html__( 'Set title content vertical alignment', 'cocco' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							'' => esc_html__( 'Default', 'cocco' ),
							'top' => esc_html__( 'Top', 'cocco' ),
							'middle'    => esc_html__( 'Middle', 'cocco' ),
							'bottom'    => esc_html__( 'Bottom', 'cocco' )
						)
					)
				);
					
				cocco_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_vertical_offset_meta',
						'type'          => 'text',
						'default_value' => '',
						'label'         => esc_html__( 'Title Vertical Offset', 'cocco' ),
						'description'   => esc_html__( 'Set title vertical offset relative to its current position', 'cocco' ),
						'parent'        => $show_title_area_meta_container,
						'args' 			=> array(
							'col_width' => '3',
							'suffix' => 'px'
						)
					)
				);
				
				cocco_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_title_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Tag', 'cocco' ),
						'options'       => cocco_mikado_get_title_tag( true ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				cocco_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_title_text_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Title Color', 'cocco' ),
						'description' => esc_html__( 'Choose a color for title text', 'cocco' ),
						'parent'      => $show_title_area_meta_container
					)
				);
				
				cocco_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_subtitle_meta',
						'type'          => 'text',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Text', 'cocco' ),
						'description'   => esc_html__( 'Enter your subtitle text', 'cocco' ),
						'parent'        => $show_title_area_meta_container,
						'args'          => array(
							'col_width' => 6
						)
					)
				);
		
				cocco_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_subtitle_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Tag', 'cocco' ),
						'options'       => cocco_mikado_get_title_tag( true, array( 'p' => 'p' ) ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				cocco_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_subtitle_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Subtitle Color', 'cocco' ),
						'description' => esc_html__( 'Choose a color for subtitle text', 'cocco' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
		/***************** Additional Title Area Layout - start *****************/
		
		do_action( 'cocco_mikado_action_additional_title_area_meta_boxes', $show_title_area_meta_container );
		
		/***************** Additional Title Area Layout - end *****************/
		
	}
	
	add_action( 'cocco_mikado_action_meta_boxes_map', 'cocco_mikado_map_title_meta', 60 );
}