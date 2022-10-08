<?php

if ( ! function_exists( 'cocco_mikado_map_general_meta' ) ) {
	function cocco_mikado_map_general_meta() {
		
		$general_meta_box = cocco_mikado_create_meta_box(
			array(
				'scope' => apply_filters( 'cocco_mikado_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'general_meta' ),
				'title' => esc_html__( 'General', 'cocco' ),
				'name'  => 'general_meta'
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		cocco_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_page_slider_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Slider Shortcode', 'cocco' ),
				'description' => esc_html__( 'Paste your slider shortcode here', 'cocco' ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		/***************** Content Layout - begin **********************/
		
		cocco_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_page_content_behind_header_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Always put content behind header', 'cocco' ),
				'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'cocco' ),
				'parent'        => $general_meta_box
			)
		);
		
		$mkdf_content_padding_group = cocco_mikado_add_admin_group(
			array(
				'name'        => 'content_padding_group',
				'title'       => esc_html__( 'Content Style', 'cocco' ),
				'description' => esc_html__( 'Define styles for Content area', 'cocco' ),
				'parent'      => $general_meta_box
			)
		);
		
			$mkdf_content_padding_row = cocco_mikado_add_admin_row(
				array(
					'name'   => 'mkdf_content_padding_row',
					'next'   => true,
					'parent' => $mkdf_content_padding_group
				)
			);

				cocco_mikado_create_meta_box_field(
					array(
						'name'   => 'mkdf_page_content_padding',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Content Padding (e.g. 10px 5px 10px 5px)', 'cocco' ),
						'parent' => $mkdf_content_padding_row,
					)
				);

				cocco_mikado_create_meta_box_field(
					array(
						'name'    => 'mkdf_page_content_padding_mobile',
						'type'    => 'textsimple',
						'label'   => esc_html__( 'Content Padding for mobile (e.g. 10px 5px 10px 5px)', 'cocco' ),
						'parent'  => $mkdf_content_padding_row,
					)
				);
		
		cocco_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_page_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Page Background Color', 'cocco' ),
				'description' => esc_html__( 'Choose background color for page content', 'cocco' ),
				'parent'      => $general_meta_box
			)
		);

		cocco_mikado_create_meta_box_field(
			array(
				'type'          => 'yesno',
				'name'          => 'mkdf_disable_content_background_image_meta',
				'default_value' => 'no',
				'label'         => esc_html__( 'Disable Content Background Image', 'cocco' ),
				'description'   => esc_html__( 'Disable content background image', 'cocco' ),
				'parent'        => $general_meta_box
			)
		);

		cocco_mikado_create_meta_box_field(
			array(
				'type'          => 'image',
				'name'          => 'mkdf_content_background_image_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Content Background Image', 'cocco' ),
				'description'   => esc_html__( 'Choose image to use as content background image', 'cocco' ),
				'parent'        => $general_meta_box,
				'dependency'	=> array(
					'show' => array(
						'mkdf_disable_content_background_image_meta' => 'no'
					)
				)
			)
		);

		cocco_mikado_create_meta_box_field(
			array(
				'type'          => 'select',
				'name'          => 'mkdf_content_background_image_behavior_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Content Background Image Behavior', 'cocco' ),
				'description'   => esc_html__( 'Choose background image behavior', 'cocco' ),
				'parent'        => $general_meta_box,
				'options'		=> array(
					'' => esc_html__('Default','cocco'),
					'theme-default' => esc_html__('Theme Default','cocco'),
					'full-image' => esc_html__('As Full Image','cocco'),
					'pattern' => esc_html__('As Pattern','cocco'),
				),
				'dependency'	=> array(
					'show' => array(
						'mkdf_disable_content_background_image_meta' => 'no'
					)
				)
			)
		);
		
		/***************** Content Layout - end **********************/
		
		/***************** Boxed Layout - begin **********************/
		
		cocco_mikado_create_meta_box_field(
			array(
				'name'    => 'mkdf_boxed_meta',
				'type'    => 'select',
				'label'   => esc_html__( 'Boxed Layout', 'cocco' ),
				'parent'  => $general_meta_box,
				'options' => cocco_mikado_get_yes_no_select_array()
			)
		);
		
			$boxed_container_meta = cocco_mikado_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'boxed_container_meta',
					'dependency' => array(
						'hide' => array(
							'mkdf_boxed_meta'  => array('','no')
						)
					)
				)
			);
		
				cocco_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_page_background_color_in_box_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'cocco' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'cocco' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				cocco_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_boxed_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'cocco' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'cocco' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				cocco_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_boxed_pattern_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'cocco' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'cocco' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				cocco_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_boxed_background_image_attachment_meta',
						'type'          => 'select',
						'default_value' => 'fixed',
						'label'         => esc_html__( 'Background Image Attachment', 'cocco' ),
						'description'   => esc_html__( 'Choose background image attachment', 'cocco' ),
						'parent'        => $boxed_container_meta,
						'options'       => array(
							''       => esc_html__( 'Default', 'cocco' ),
							'fixed'  => esc_html__( 'Fixed', 'cocco' ),
							'scroll' => esc_html__( 'Scroll', 'cocco' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		cocco_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_paspartu_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Passepartout', 'cocco' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'cocco' ),
				'parent'        => $general_meta_box,
				'options'       => cocco_mikado_get_yes_no_select_array(),
			)
		);
		
			$paspartu_container_meta = cocco_mikado_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'mkdf_paspartu_container_meta',
					'dependency' => array(
						'hide' => array(
							'mkdf_paspartu_meta'  => array('','no')
						)
					)
				)
			);
		
				cocco_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_paspartu_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'cocco' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'cocco' ),
						'parent'      => $paspartu_container_meta
					)
				);
				
				cocco_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_paspartu_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'cocco' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'cocco' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
		
				cocco_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_paspartu_responsive_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'cocco' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'cocco' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				cocco_mikado_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'mkdf_disable_top_paspartu_meta',
						'label'         => esc_html__( 'Disable Top Passepartout', 'cocco' ),
						'options'       => cocco_mikado_get_yes_no_select_array(),
					)
				);
		
				cocco_mikado_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'mkdf_enable_fixed_paspartu_meta',
						'label'         => esc_html__( 'Enable Fixed Passepartout', 'cocco' ),
						'description'   => esc_html__( 'Enabling this option will set fixed passepartout for your screens', 'cocco' ),
						'options'       => cocco_mikado_get_yes_no_select_array(),
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Content Width Layout - begin **********************/
		
		cocco_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_initial_content_width_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'cocco' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'cocco' ),
				'parent'        => $general_meta_box,
				'options'       => array(
					''                => esc_html__( 'Default', 'cocco' ),
					'mkdf-grid-1100' => esc_html__( '1100px', 'cocco' ),
					'mkdf-grid-1300' => esc_html__( '1300px', 'cocco' ),
					'mkdf-grid-1200' => esc_html__( '1200px', 'cocco' ),
					'mkdf-grid-1000' => esc_html__( '1000px', 'cocco' ),
					'mkdf-grid-800'  => esc_html__( '800px', 'cocco' )
				)
			)
		);
		
		/***************** Content Width Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		cocco_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_smooth_page_transitions_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Smooth Page Transitions', 'cocco' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'cocco' ),
				'parent'        => $general_meta_box,
				'options'       => cocco_mikado_get_yes_no_select_array()
			)
		);
		
			$page_transitions_container_meta = cocco_mikado_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'page_transitions_container_meta',
					'dependency' => array(
						'hide' => array(
							'mkdf_smooth_page_transitions_meta'  => array('','no')
						)
					)
				)
			);
		
				cocco_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_page_transition_preloader_meta',
						'type'        => 'select',
						'label'       => esc_html__( 'Enable Preloading Animation', 'cocco' ),
						'description' => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'cocco' ),
						'parent'      => $page_transitions_container_meta,
						'options'     => cocco_mikado_get_yes_no_select_array()
					)
				);
				
				$page_transition_preloader_container_meta = cocco_mikado_add_admin_container(
					array(
						'parent'          => $page_transitions_container_meta,
						'name'            => 'page_transition_preloader_container_meta',
						'dependency' => array(
							'hide' => array(
								'mkdf_page_transition_preloader_meta'  => array('','no')
							)
						)
					)
				);
				
					cocco_mikado_create_meta_box_field(
						array(
							'name'   => 'mkdf_smooth_pt_bgnd_color_meta',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'cocco' ),
							'parent' => $page_transition_preloader_container_meta
						)
					);
					
					$group_pt_spinner_animation_meta = cocco_mikado_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation_meta',
							'title'       => esc_html__( 'Loader Style', 'cocco' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'cocco' ),
							'parent'      => $page_transition_preloader_container_meta
						)
					);
					
					$row_pt_spinner_animation_meta = cocco_mikado_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation_meta',
							'parent' => $group_pt_spinner_animation_meta
						)
					);
					
					cocco_mikado_create_meta_box_field(
						array(
							'type'    => 'selectsimple',
							'name'    => 'mkdf_smooth_pt_spinner_type_meta',
							'label'   => esc_html__( 'Spinner Type', 'cocco' ),
							'parent'  => $row_pt_spinner_animation_meta,
							'options' => array(
								''                      => esc_html__( 'Default', 'cocco' ),
								'cocco_loader'        	=> esc_html__( 'Cocco Loader', 'cocco' ),
								'rotate_circles'        => esc_html__( 'Rotate Circles', 'cocco' ),
								'pulse'                 => esc_html__( 'Pulse', 'cocco' ),
								'double_pulse'          => esc_html__( 'Double Pulse', 'cocco' ),
								'cube'                  => esc_html__( 'Cube', 'cocco' ),
								'rotating_cubes'        => esc_html__( 'Rotating Cubes', 'cocco' ),
								'stripes'               => esc_html__( 'Stripes', 'cocco' ),
								'wave'                  => esc_html__( 'Wave', 'cocco' ),
								'two_rotating_circles'  => esc_html__( '2 Rotating Circles', 'cocco' ),
								'five_rotating_circles' => esc_html__( '5 Rotating Circles', 'cocco' ),
								'atom'                  => esc_html__( 'Atom', 'cocco' ),
								'clock'                 => esc_html__( 'Clock', 'cocco' ),
								'mitosis'               => esc_html__( 'Mitosis', 'cocco' ),
								'lines'                 => esc_html__( 'Lines', 'cocco' ),
								'fussion'               => esc_html__( 'Fussion', 'cocco' ),
								'wave_circles'          => esc_html__( 'Wave Circles', 'cocco' ),
								'pulse_circles'         => esc_html__( 'Pulse Circles', 'cocco' )
							)
						)
					);
					
					cocco_mikado_create_meta_box_field(
						array(
							'type'   => 'colorsimple',
							'name'   => 'mkdf_smooth_pt_spinner_color_meta',
							'label'  => esc_html__( 'Spinner Color', 'cocco' ),
							'parent' => $row_pt_spinner_animation_meta
						)
					);
					
					cocco_mikado_create_meta_box_field(
						array(
							'name'        => 'mkdf_page_transition_fadeout_meta',
							'type'        => 'select',
							'label'       => esc_html__( 'Enable Fade Out Animation', 'cocco' ),
							'description' => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'cocco' ),
							'options'     => cocco_mikado_get_yes_no_select_array(),
							'parent'      => $page_transitions_container_meta
						
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		/***************** Comments Layout - begin **********************/
		
		cocco_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_page_comments_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Show Comments', 'cocco' ),
				'description' => esc_html__( 'Enabling this option will show comments on your page', 'cocco' ),
				'parent'      => $general_meta_box,
				'options'     => cocco_mikado_get_yes_no_select_array()
			)
		);
		
		/***************** Comments Layout - end **********************/
	}
	
	add_action( 'cocco_mikado_action_meta_boxes_map', 'cocco_mikado_map_general_meta', 10 );
}