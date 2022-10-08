<?php

if ( ! function_exists( 'cocco_mikado_mobile_header_options_map' ) ) {
	function cocco_mikado_mobile_header_options_map() {
		
		$panel_mobile_header = cocco_mikado_add_admin_panel(
			array(
				'title' => esc_html__( 'Mobile Header', 'cocco' ),
				'name'  => 'panel_mobile_header',
				'page'  => '_header_page'
			)
		);
		
		$mobile_header_group = cocco_mikado_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name'   => 'mobile_header_group',
				'title'  => esc_html__( 'Mobile Header Styles', 'cocco' )
			)
		);
		
		$mobile_header_row1 = cocco_mikado_add_admin_row(
			array(
				'parent' => $mobile_header_group,
				'name'   => 'mobile_header_row1'
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'   => 'mobile_header_height',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Height', 'cocco' ),
				'parent' => $mobile_header_row1,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'   => 'mobile_header_background_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Background Color', 'cocco' ),
				'parent' => $mobile_header_row1
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'   => 'mobile_header_border_bottom_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Border Bottom Color', 'cocco' ),
				'parent' => $mobile_header_row1
			)
		);
		
		$mobile_menu_group = cocco_mikado_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name'   => 'mobile_menu_group',
				'title'  => esc_html__( 'Mobile Menu Styles', 'cocco' )
			)
		);
		
		$mobile_menu_row1 = cocco_mikado_add_admin_row(
			array(
				'parent' => $mobile_menu_group,
				'name'   => 'mobile_menu_row1'
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'   => 'mobile_menu_background_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Background Color', 'cocco' ),
				'parent' => $mobile_menu_row1
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'   => 'mobile_menu_border_bottom_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Border Bottom Color', 'cocco' ),
				'parent' => $mobile_menu_row1
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'   => 'mobile_menu_separator_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Menu Item Separator Color', 'cocco' ),
				'parent' => $mobile_menu_row1
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'        => 'mobile_logo_height',
				'type'        => 'text',
				'label'       => esc_html__( 'Logo Height For Mobile Header', 'cocco' ),
				'description' => esc_html__( 'Define logo height for screen size smaller than 1024px', 'cocco' ),
				'parent'      => $panel_mobile_header,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'        => 'mobile_logo_height_phones',
				'type'        => 'text',
				'label'       => esc_html__( 'Logo Height For Mobile Devices', 'cocco' ),
				'description' => esc_html__( 'Define logo height for screen size smaller than 480px', 'cocco' ),
				'parent'      => $panel_mobile_header,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		cocco_mikado_add_admin_section_title(
			array(
				'parent' => $panel_mobile_header,
				'name'   => 'mobile_header_fonts_title',
				'title'  => esc_html__( 'Typography', 'cocco' )
			)
		);
		
		$first_level_group = cocco_mikado_add_admin_group(
			array(
				'parent'      => $panel_mobile_header,
				'name'        => 'first_level_group',
				'title'       => esc_html__( '1st Level Menu', 'cocco' ),
				'description' => esc_html__( 'Define styles for 1st level in Mobile Menu Navigation', 'cocco' )
			)
		);
		
		$first_level_row1 = cocco_mikado_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row1'
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'   => 'mobile_text_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Text Color', 'cocco' ),
				'parent' => $first_level_row1
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'   => 'mobile_text_hover_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Hover/Active Text Color', 'cocco' ),
				'parent' => $first_level_row1
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'   => 'mobile_text_google_fonts',
				'type'   => 'fontsimple',
				'label'  => esc_html__( 'Font Family', 'cocco' ),
				'parent' => $first_level_row1
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'   => 'mobile_text_font_size',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Font Size', 'cocco' ),
				'parent' => $first_level_row1,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		$first_level_row2 = cocco_mikado_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row2'
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'   => 'mobile_text_line_height',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Line Height', 'cocco' ),
				'parent' => $first_level_row2,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'    => 'mobile_text_text_transform',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Text Transform', 'cocco' ),
				'parent'  => $first_level_row2,
				'options' => cocco_mikado_get_text_transform_array()
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'    => 'mobile_text_font_style',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Font Style', 'cocco' ),
				'parent'  => $first_level_row2,
				'options' => cocco_mikado_get_font_style_array()
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'    => 'mobile_text_font_weight',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Font Weight', 'cocco' ),
				'parent'  => $first_level_row2,
				'options' => cocco_mikado_get_font_weight_array()
			)
		);
		
		$first_level_row3 = cocco_mikado_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row3'
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'mobile_text_letter_spacing',
				'label'         => esc_html__( 'Letter Spacing', 'cocco' ),
				'default_value' => '',
				'parent'        => $first_level_row3,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$second_level_group = cocco_mikado_add_admin_group(
			array(
				'parent'      => $panel_mobile_header,
				'name'        => 'second_level_group',
				'title'       => esc_html__( 'Dropdown Menu', 'cocco' ),
				'description' => esc_html__( 'Define styles for drop down menu items in Mobile Menu Navigation', 'cocco' )
			)
		);
		
		$second_level_row1 = cocco_mikado_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row1'
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Text Color', 'cocco' ),
				'parent' => $second_level_row1
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_hover_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Hover/Active Text Color', 'cocco' ),
				'parent' => $second_level_row1
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_google_fonts',
				'type'   => 'fontsimple',
				'label'  => esc_html__( 'Font Family', 'cocco' ),
				'parent' => $second_level_row1
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_font_size',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Font Size', 'cocco' ),
				'parent' => $second_level_row1,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		$second_level_row2 = cocco_mikado_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row2'
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_line_height',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Line Height', 'cocco' ),
				'parent' => $second_level_row2,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'    => 'mobile_dropdown_text_text_transform',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Text Transform', 'cocco' ),
				'parent'  => $second_level_row2,
				'options' => cocco_mikado_get_text_transform_array()
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'    => 'mobile_dropdown_text_font_style',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Font Style', 'cocco' ),
				'parent'  => $second_level_row2,
				'options' => cocco_mikado_get_font_style_array()
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'    => 'mobile_dropdown_text_font_weight',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Font Weight', 'cocco' ),
				'parent'  => $second_level_row2,
				'options' => cocco_mikado_get_font_weight_array()
			)
		);
		
		$second_level_row3 = cocco_mikado_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row3'
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'mobile_dropdown_text_letter_spacing',
				'label'         => esc_html__( 'Letter Spacing', 'cocco' ),
				'default_value' => '',
				'parent'        => $second_level_row3,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		cocco_mikado_add_admin_section_title(
			array(
				'name'   => 'mobile_opener_panel',
				'parent' => $panel_mobile_header,
				'title'  => esc_html__( 'Mobile Menu Opener', 'cocco' )
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'        => 'mobile_menu_title',
				'type'        => 'text',
				'label'       => esc_html__( 'Mobile Navigation Title', 'cocco' ),
				'description' => esc_html__( 'Enter title for mobile menu navigation', 'cocco' ),
				'parent'      => $panel_mobile_header,
				'args'        => array(
					'col_width' => 3
				)
			)
		);

		cocco_mikado_add_admin_field(
			array(
				'parent'        => $panel_mobile_header,
				'type'          => 'select',
				'name'          => 'mobile_icon_icon_source',
				'default_value' => 'icon_pack',
				'label'         => esc_html__( 'Select Mobile Navigation Icon Source', 'cocco' ),
				'description'   => esc_html__( 'Choose whether you would like to use icons from an icon pack or SVG icons', 'cocco' ),
				'options'       => cocco_mikado_get_icon_sources_array()
			)
		);

		$mobile_icon_pack_container = cocco_mikado_add_admin_container(
			array(
				'parent'          => $panel_mobile_header,
				'name'            => 'mobile_icon_pack_container',
				'dependency' => array(
					'show' => array(
						'mobile_icon_icon_source' => 'icon_pack'
					)
				)
			)
		);

		cocco_mikado_add_admin_field(
			array(
				'parent'        => $mobile_icon_pack_container,
				'type'          => 'select',
				'name'          => 'mobile_icon_icon_pack',
				'default_value' => 'font_elegant',
				'label'         => esc_html__( 'Mobile Navigation Icon Pack', 'cocco' ),
				'description'   => esc_html__( 'Choose icon pack for mobile navigation icon', 'cocco' ),
				'options'       => cocco_mikado_icon_collections()->getIconCollectionsExclude( array( 'linea_icons', 'dripicons', 'simple_line_icons' ) )
			)
		);

		$mobile_icon_svg_path_container = cocco_mikado_add_admin_container(
			array(
				'parent'          => $panel_mobile_header,
				'name'            => 'mobile_icon_svg_path_container',
				'dependency' => array(
					'show' => array(
						'mobile_icon_icon_source' => 'svg_path'
					)
				)
			)
		);

		cocco_mikado_add_admin_field(
			array(
				'parent'      => $mobile_icon_svg_path_container,
				'type'        => 'textarea',
				'name'        => 'mobile_icon_svg_path',
				'label'       => esc_html__( 'Mobile Navigation Icon SVG Path', 'cocco' ),
				'description' => esc_html__( 'Enter your mobile navigation icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'cocco' ),
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'   => 'mobile_icon_color',
				'type'   => 'color',
				'label'  => esc_html__( 'Mobile Navigation Icon Color', 'cocco' ),
				'parent' => $panel_mobile_header
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'   => 'mobile_icon_hover_color',
				'type'   => 'color',
				'label'  => esc_html__( 'Mobile Navigation Icon Hover Color', 'cocco' ),
				'parent' => $panel_mobile_header
			)
		);
	}
	
	add_action( 'cocco_mikado_action_options_map', 'cocco_mikado_mobile_header_options_map', 5 );
}