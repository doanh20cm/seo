<?php

if ( ! function_exists( 'cocco_mikado_general_options_map' ) ) {
	/**
	 * General options page
	 */
	function cocco_mikado_general_options_map() {
		
		cocco_mikado_add_admin_page(
			array(
				'slug'  => '',
				'title' => esc_html__( 'General', 'cocco' ),
				'icon'  => 'fa fa-institution'
			)
		);

        do_action('cocco_mikado_add_general_options_map_first');
		
		$panel_design_style = cocco_mikado_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_design_style',
				'title' => esc_html__( 'Appearance', 'cocco' )
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'          => 'google_fonts',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Google Font Family', 'cocco' ),
				'description'   => esc_html__( 'Choose a default Google font for your site', 'cocco' ),
				'parent'        => $panel_design_style
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'          => 'additional_google_fonts',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Additional Google Fonts', 'cocco' ),
				'parent'        => $panel_design_style
			)
		);
		
		$additional_google_fonts_container = cocco_mikado_add_admin_container(
			array(
				'parent'          => $panel_design_style,
				'name'            => 'additional_google_fonts_container',
				'dependency' => array(
					'show' => array(
						'additional_google_fonts'  => 'yes'
					)
				)
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'          => 'additional_google_font1',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'cocco' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'cocco' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'          => 'additional_google_font2',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'cocco' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'cocco' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'          => 'additional_google_font3',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'cocco' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'cocco' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'          => 'additional_google_font4',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'cocco' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'cocco' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'          => 'additional_google_font5',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'cocco' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'cocco' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'          => 'google_font_weight',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__( 'Google Fonts Style & Weight', 'cocco' ),
				'description'   => esc_html__( 'Choose a default Google font weights for your site. Impact on page load time', 'cocco' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'100'  => esc_html__( '100 Thin', 'cocco' ),
					'100i' => esc_html__( '100 Thin Italic', 'cocco' ),
					'200'  => esc_html__( '200 Extra-Light', 'cocco' ),
					'200i' => esc_html__( '200 Extra-Light Italic', 'cocco' ),
					'300'  => esc_html__( '300 Light', 'cocco' ),
					'300i' => esc_html__( '300 Light Italic', 'cocco' ),
					'400'  => esc_html__( '400 Regular', 'cocco' ),
					'400i' => esc_html__( '400 Regular Italic', 'cocco' ),
					'500'  => esc_html__( '500 Medium', 'cocco' ),
					'500i' => esc_html__( '500 Medium Italic', 'cocco' ),
					'600'  => esc_html__( '600 Semi-Bold', 'cocco' ),
					'600i' => esc_html__( '600 Semi-Bold Italic', 'cocco' ),
					'700'  => esc_html__( '700 Bold', 'cocco' ),
					'700i' => esc_html__( '700 Bold Italic', 'cocco' ),
					'800'  => esc_html__( '800 Extra-Bold', 'cocco' ),
					'800i' => esc_html__( '800 Extra-Bold Italic', 'cocco' ),
					'900'  => esc_html__( '900 Ultra-Bold', 'cocco' ),
					'900i' => esc_html__( '900 Ultra-Bold Italic', 'cocco' )
				)
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'          => 'google_font_subset',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__( 'Google Fonts Subset', 'cocco' ),
				'description'   => esc_html__( 'Choose a default Google font subsets for your site', 'cocco' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'latin'        => esc_html__( 'Latin', 'cocco' ),
					'latin-ext'    => esc_html__( 'Latin Extended', 'cocco' ),
					'cyrillic'     => esc_html__( 'Cyrillic', 'cocco' ),
					'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'cocco' ),
					'greek'        => esc_html__( 'Greek', 'cocco' ),
					'greek-ext'    => esc_html__( 'Greek Extended', 'cocco' ),
					'vietnamese'   => esc_html__( 'Vietnamese', 'cocco' )
				)
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'        => 'first_color',
				'type'        => 'color',
				'label'       => esc_html__( 'First Main Color', 'cocco' ),
				'description' => esc_html__( 'Choose the most dominant theme color. Default color is #ff6f96', 'cocco' ),
				'parent'      => $panel_design_style
			)
		);


		cocco_mikado_add_admin_field(
			array(
				'name'        => 'second_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Second Color', 'cocco' ),
				'description' => esc_html__( 'Choose the second dominant theme color. Default color is #9ad8d3', 'cocco' ),
				'parent'      => $panel_design_style
			)
		);

		cocco_mikado_add_admin_field(
			array(
				'name'        => 'third_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Third Color', 'cocco' ),
				'description' => esc_html__( 'Choose the third dominant theme color. Default color is #dce086', 'cocco' ),
				'parent'      => $panel_design_style
			)
		);

		cocco_mikado_add_admin_field(
			array(
				'name'        => 'fourth_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Fourth Color', 'cocco' ),
				'description' => esc_html__( 'Choose the fourth dominant theme color. Default color is #d7f5fa', 'cocco' ),
				'parent'      => $panel_design_style
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'        => 'page_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Page Background Color', 'cocco' ),
				'description' => esc_html__( 'Choose the background color for page content. Default color is #ffffff', 'cocco' ),
				'parent'      => $panel_design_style
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'        => 'selection_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Text Selection Color', 'cocco' ),
				'description' => esc_html__( 'Choose the color users see when selecting text', 'cocco' ),
				'parent'      => $panel_design_style
			)
		);
		
		/***************** Boxed Layout - begin **********************/
		
		cocco_mikado_add_admin_field(
			array(
				'name'          => 'boxed',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Boxed Layout', 'cocco' ),
				'parent'        => $panel_design_style
			)
		);
		
			$boxed_container = cocco_mikado_add_admin_container(
				array(
					'parent'          => $panel_design_style,
					'name'            => 'boxed_container',
					'dependency' => array(
						'show' => array(
							'boxed'  => 'yes'
						)
					)
				)
			);
		
				cocco_mikado_add_admin_field(
					array(
						'name'        => 'page_background_color_in_box',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'cocco' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'cocco' ),
						'parent'      => $boxed_container
					)
				);
				
				cocco_mikado_add_admin_field(
					array(
						'name'        => 'boxed_background_image',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'cocco' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'cocco' ),
						'parent'      => $boxed_container
					)
				);
				
				cocco_mikado_add_admin_field(
					array(
						'name'        => 'boxed_pattern_background_image',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'cocco' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'cocco' ),
						'parent'      => $boxed_container
					)
				);
				
				cocco_mikado_add_admin_field(
					array(
						'name'          => 'boxed_background_image_attachment',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Attachment', 'cocco' ),
						'description'   => esc_html__( 'Choose background image attachment', 'cocco' ),
						'parent'        => $boxed_container,
						'options'       => array(
							''       => esc_html__( 'Default', 'cocco' ),
							'fixed'  => esc_html__( 'Fixed', 'cocco' ),
							'scroll' => esc_html__( 'Scroll', 'cocco' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		cocco_mikado_add_admin_field(
			array(
				'name'          => 'paspartu',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Passepartout', 'cocco' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'cocco' ),
				'parent'        => $panel_design_style
			)
		);
		
			$paspartu_container = cocco_mikado_add_admin_container(
				array(
					'parent'          => $panel_design_style,
					'name'            => 'paspartu_container',
					'dependency' => array(
						'show' => array(
							'paspartu'  => 'yes'
						)
					)
				)
			);
		
				cocco_mikado_add_admin_field(
					array(
						'name'        => 'paspartu_color',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'cocco' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'cocco' ),
						'parent'      => $paspartu_container
					)
				);
				
				cocco_mikado_add_admin_field(
					array(
						'name'        => 'paspartu_width',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'cocco' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'cocco' ),
						'parent'      => $paspartu_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
		
				cocco_mikado_add_admin_field(
					array(
						'name'        => 'paspartu_responsive_width',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'cocco' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'cocco' ),
						'parent'      => $paspartu_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				cocco_mikado_add_admin_field(
					array(
						'parent'        => $paspartu_container,
						'type'          => 'yesno',
						'default_value' => 'no',
						'name'          => 'disable_top_paspartu',
						'label'         => esc_html__( 'Disable Top Passepartout', 'cocco' )
					)
				);
		
				cocco_mikado_add_admin_field(
					array(
						'parent'        => $paspartu_container,
						'type'          => 'yesno',
						'default_value' => 'no',
						'name'          => 'enable_fixed_paspartu',
						'label'         => esc_html__( 'Enable Fixed Passepartout', 'cocco' ),
						'description' => esc_html__( 'Enabling this option will set fixed passepartout for your screens', 'cocco' )
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Content Layout - begin **********************/
		
		cocco_mikado_add_admin_field(
			array(
				'name'          => 'initial_content_width',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'cocco' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'cocco' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'mkdf-grid-1100' => esc_html__( '1100px - default', 'cocco' ),
					'mkdf-grid-1300' => esc_html__( '1300px', 'cocco' ),
					'mkdf-grid-1200' => esc_html__( '1200px', 'cocco' ),
					'mkdf-grid-1000' => esc_html__( '1000px', 'cocco' ),
					'mkdf-grid-800'  => esc_html__( '800px', 'cocco' )
				)
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'          => 'preload_pattern_image',
				'type'          => 'image',
				'label'         => esc_html__( 'Preload Pattern Image', 'cocco' ),
				'description'   => esc_html__( 'Choose preload pattern image to be displayed until images are loaded', 'cocco' ),
				'parent'        => $panel_design_style
			)
		);
		
		/***************** Content Layout - end **********************/
		
		$panel_settings = cocco_mikado_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_settings',
				'title' => esc_html__( 'Behavior', 'cocco' )
			)
		);
		
		/***************** Smooth Scroll Layout - begin **********************/
		
		cocco_mikado_add_admin_field(
			array(
				'name'          => 'page_smooth_scroll',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Scroll', 'cocco' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth scrolling effect on every page (except on Mac and touch devices)', 'cocco' ),
				'parent'        => $panel_settings
			)
		);
		
		/***************** Smooth Scroll Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		cocco_mikado_add_admin_field(
			array(
				'name'          => 'smooth_page_transitions',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Page Transitions', 'cocco' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'cocco' ),
				'parent'        => $panel_settings
			)
		);
		
			$page_transitions_container = cocco_mikado_add_admin_container(
				array(
					'parent'          => $panel_settings,
					'name'            => 'page_transitions_container',
					'dependency' => array(
						'show' => array(
							'smooth_page_transitions'  => 'yes'
						)
					)
				)
			);
		
				cocco_mikado_add_admin_field(
					array(
						'name'          => 'page_transition_preloader',
						'type'          => 'yesno',
						'default_value' => 'no',
						'label'         => esc_html__( 'Enable Preloading Animation', 'cocco' ),
						'description'   => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'cocco' ),
						'parent'        => $page_transitions_container
					)
				);
				
				$page_transition_preloader_container = cocco_mikado_add_admin_container(
					array(
						'parent'          => $page_transitions_container,
						'name'            => 'page_transition_preloader_container',
						'dependency' => array(
							'show' => array(
								'page_transition_preloader'  => 'yes'
							)
						)
					)
				);
		
		
					cocco_mikado_add_admin_field(
						array(
							'name'   => 'smooth_pt_bgnd_color',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'cocco' ),
							'parent' => $page_transition_preloader_container
						)
					);
					
					$group_pt_spinner_animation = cocco_mikado_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation',
							'title'       => esc_html__( 'Loader Style', 'cocco' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'cocco' ),
							'parent'      => $page_transition_preloader_container
						)
					);
					
					$row_pt_spinner_animation = cocco_mikado_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation',
							'parent' => $group_pt_spinner_animation
						)
					);
					
					cocco_mikado_add_admin_field(
						array(
							'type'          => 'selectsimple',
							'name'          => 'smooth_pt_spinner_type',
							'default_value' => '',
							'label'         => esc_html__( 'Spinner Type', 'cocco' ),
							'parent'        => $row_pt_spinner_animation,
							'options'       => array(
								'cocco_loader'			=> esc_html__( 'Cocco Loader', 'cocco' ),
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
					
					cocco_mikado_add_admin_field(
						array(
							'type'          => 'colorsimple',
							'name'          => 'smooth_pt_spinner_color',
							'default_value' => '',
							'label'         => esc_html__( 'Spinner Color', 'cocco' ),
							'parent'        => $row_pt_spinner_animation
						)
					);
					
					cocco_mikado_add_admin_field(
						array(
							'name'          => 'page_transition_fadeout',
							'type'          => 'yesno',
							'default_value' => 'no',
							'label'         => esc_html__( 'Enable Fade Out Animation', 'cocco' ),
							'description'   => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'cocco' ),
							'parent'        => $page_transitions_container
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		cocco_mikado_add_admin_field(
			array(
				'name'          => 'show_back_button',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show "Back To Top Button"', 'cocco' ),
				'description'   => esc_html__( 'Enabling this option will display a Back to Top button on every page', 'cocco' ),
				'parent'        => $panel_settings
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'          => 'responsiveness',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Responsiveness', 'cocco' ),
				'description'   => esc_html__( 'Enabling this option will make all pages responsive', 'cocco' ),
				'parent'        => $panel_settings
			)
		);
		
		$panel_custom_code = cocco_mikado_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_custom_code',
				'title' => esc_html__( 'Custom Code', 'cocco' )
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'        => 'custom_js',
				'type'        => 'textarea',
				'label'       => esc_html__( 'Custom JS', 'cocco' ),
				'description' => esc_html__( 'Enter your custom Javascript here', 'cocco' ),
				'parent'      => $panel_custom_code
			)
		);
		
		$panel_google_api = cocco_mikado_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_google_api',
				'title' => esc_html__( 'Google API', 'cocco' )
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'        => 'google_maps_api_key',
				'type'        => 'text',
				'label'       => esc_html__( 'Google Maps Api Key', 'cocco' ),
				'description' => esc_html__( 'Insert your Google Maps API key here. For instructions on how to create a Google Maps API key, please refer to our to our documentation.', 'cocco' ),
				'parent'      => $panel_google_api
			)
		);
	}
	
	add_action( 'cocco_mikado_action_options_map', 'cocco_mikado_general_options_map', 1 );
}

if ( ! function_exists( 'cocco_mikado_page_general_style' ) ) {
	/**
	 * Function that prints page general inline styles
	 */
	function cocco_mikado_page_general_style( $style ) {
		$current_style = '';
		$page_id       = cocco_mikado_get_page_id();
		$class_prefix  = cocco_mikado_get_unique_page_class( $page_id );
		
		$boxed_background_style = array();
		
		$boxed_page_background_color = cocco_mikado_get_meta_field_intersect( 'page_background_color_in_box', $page_id );
		if ( ! empty( $boxed_page_background_color ) ) {
			$boxed_background_style['background-color'] = $boxed_page_background_color;
		}
		
		$boxed_page_background_image = cocco_mikado_get_meta_field_intersect( 'boxed_background_image', $page_id );
		if ( ! empty( $boxed_page_background_image ) ) {
			$boxed_background_style['background-image']    = 'url(' . esc_url( $boxed_page_background_image ) . ')';
			$boxed_background_style['background-position'] = 'center 0px';
			$boxed_background_style['background-repeat']   = 'no-repeat';
		}
		
		$boxed_page_background_pattern_image = cocco_mikado_get_meta_field_intersect( 'boxed_pattern_background_image', $page_id );
		if ( ! empty( $boxed_page_background_pattern_image ) ) {
			$boxed_background_style['background-image']    = 'url(' . esc_url( $boxed_page_background_pattern_image ) . ')';
			$boxed_background_style['background-position'] = '0px 0px';
			$boxed_background_style['background-repeat']   = 'repeat';
		}
		
		$boxed_page_background_attachment = cocco_mikado_get_meta_field_intersect( 'boxed_background_image_attachment', $page_id );
		if ( ! empty( $boxed_page_background_attachment ) ) {
			$boxed_background_style['background-attachment'] = $boxed_page_background_attachment;
		}
		
		$boxed_background_selector = $class_prefix . '.mkdf-boxed .mkdf-wrapper';
		
		if ( ! empty( $boxed_background_style ) ) {
			$current_style .= cocco_mikado_dynamic_css( $boxed_background_selector, $boxed_background_style );
		}
		
		$paspartu_style     = array();
		$paspartu_res_style = array();
		$paspartu_res_start = '@media only screen and (max-width: 1024px) {';
		$paspartu_res_end   = '}';
		
		$paspartu_header_selector                = array(
			'.mkdf-paspartu-enabled .mkdf-page-header .mkdf-fixed-wrapper.fixed',
			'.mkdf-paspartu-enabled .mkdf-sticky-header',
			'.mkdf-paspartu-enabled .mkdf-mobile-header.mobile-header-appear .mkdf-mobile-header-inner'
		);
		$paspartu_header_appear_selector         = array(
			'.mkdf-paspartu-enabled.mkdf-fixed-paspartu-enabled .mkdf-page-header .mkdf-fixed-wrapper.fixed',
			'.mkdf-paspartu-enabled.mkdf-fixed-paspartu-enabled .mkdf-sticky-header.header-appear',
			'.mkdf-paspartu-enabled.mkdf-fixed-paspartu-enabled .mkdf-mobile-header.mobile-header-appear .mkdf-mobile-header-inner'
		);
		
		$paspartu_header_style                   = array();
		$paspartu_header_appear_style            = array();
		$paspartu_header_responsive_style        = array();
		$paspartu_header_appear_responsive_style = array();
		
		$paspartu_color = cocco_mikado_get_meta_field_intersect( 'paspartu_color', $page_id );
		if ( ! empty( $paspartu_color ) ) {
			$paspartu_style['background-color'] = $paspartu_color;
		}
		
		$paspartu_width = cocco_mikado_get_meta_field_intersect( 'paspartu_width', $page_id );
		if ( $paspartu_width !== '' ) {
			if ( cocco_mikado_string_ends_with( $paspartu_width, '%' ) || cocco_mikado_string_ends_with( $paspartu_width, 'px' ) ) {
				$paspartu_style['padding'] = $paspartu_width;
				
				$paspartu_clean_width      = cocco_mikado_string_ends_with( $paspartu_width, '%' ) ? cocco_mikado_filter_suffix( $paspartu_width, '%' ) : cocco_mikado_filter_suffix( $paspartu_width, 'px' );
				$paspartu_clean_width_mark = cocco_mikado_string_ends_with( $paspartu_width, '%' ) ? '%' : 'px';
				
				$paspartu_header_style['left']              = $paspartu_width;
				$paspartu_header_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_clean_width ) . $paspartu_clean_width_mark . ')';
				$paspartu_header_appear_style['margin-top'] = $paspartu_width;
			} else {
				$paspartu_style['padding'] = $paspartu_width . 'px';
				
				$paspartu_header_style['left']              = $paspartu_width . 'px';
				$paspartu_header_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_width ) . 'px)';
				$paspartu_header_appear_style['margin-top'] = $paspartu_width . 'px';
			}
		}
		
		$paspartu_selector = $class_prefix . '.mkdf-paspartu-enabled .mkdf-wrapper';
		
		if ( ! empty( $paspartu_style ) ) {
			$current_style .= cocco_mikado_dynamic_css( $paspartu_selector, $paspartu_style );
		}
		
		if ( ! empty( $paspartu_header_style ) ) {
			$current_style .= cocco_mikado_dynamic_css( $paspartu_header_selector, $paspartu_header_style );
			$current_style .= cocco_mikado_dynamic_css( $paspartu_header_appear_selector, $paspartu_header_appear_style );
		}
		
		$paspartu_responsive_width = cocco_mikado_get_meta_field_intersect( 'paspartu_responsive_width', $page_id );
		if ( $paspartu_responsive_width !== '' ) {
			if ( cocco_mikado_string_ends_with( $paspartu_responsive_width, '%' ) || cocco_mikado_string_ends_with( $paspartu_responsive_width, 'px' ) ) {
				$paspartu_res_style['padding'] = $paspartu_responsive_width;
				
				$paspartu_clean_width      = cocco_mikado_string_ends_with( $paspartu_responsive_width, '%' ) ? cocco_mikado_filter_suffix( $paspartu_responsive_width, '%' ) : cocco_mikado_filter_suffix( $paspartu_responsive_width, 'px' );
				$paspartu_clean_width_mark = cocco_mikado_string_ends_with( $paspartu_responsive_width, '%' ) ? '%' : 'px';
				
				$paspartu_header_responsive_style['left']              = $paspartu_responsive_width;
				$paspartu_header_responsive_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_clean_width ) . $paspartu_clean_width_mark . ')';
				$paspartu_header_appear_responsive_style['margin-top'] = $paspartu_responsive_width;
			} else {
				$paspartu_res_style['padding'] = $paspartu_responsive_width . 'px';
				
				$paspartu_header_responsive_style['left']              = $paspartu_responsive_width . 'px';
				$paspartu_header_responsive_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_responsive_width ) . 'px)';
				$paspartu_header_appear_responsive_style['margin-top'] = $paspartu_responsive_width . 'px';
			}
		}
		
		if ( ! empty( $paspartu_res_style ) ) {
			$current_style .= $paspartu_res_start . cocco_mikado_dynamic_css( $paspartu_selector, $paspartu_res_style ) . $paspartu_res_end;
		}
		
		if ( ! empty( $paspartu_header_responsive_style ) ) {
			$current_style .= $paspartu_res_start . cocco_mikado_dynamic_css( $paspartu_header_selector, $paspartu_header_responsive_style ) . $paspartu_res_end;
			$current_style .= $paspartu_res_start . cocco_mikado_dynamic_css( $paspartu_header_appear_selector, $paspartu_header_appear_responsive_style ) . $paspartu_res_end;
		}
		
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'cocco_mikado_filter_add_page_custom_style', 'cocco_mikado_page_general_style' );
}