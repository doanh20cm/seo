<?php

if ( ! function_exists( 'cocco_mikado_page_options_map' ) ) {
	function cocco_mikado_page_options_map() {
		
		cocco_mikado_add_admin_page(
			array(
				'slug'  => '_page_page',
				'title' => esc_html__( 'Page', 'cocco' ),
				'icon'  => 'fa fa-file-text-o'
			)
		);
		
		/***************** Page Layout - begin **********************/
		
		$panel_sidebar = cocco_mikado_add_admin_panel(
			array(
				'page'  => '_page_page',
				'name'  => 'panel_sidebar',
				'title' => esc_html__( 'Page Style', 'cocco' )
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'          => 'page_show_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments', 'cocco' ),
				'description'   => esc_html__( 'Enabling this option will show comments on your page', 'cocco' ),
				'default_value' => 'yes',
				'parent'        => $panel_sidebar
			)
		);
		
		/***************** Page Layout - end **********************/
		
		/***************** Content Layout - begin **********************/
		
		$panel_content = cocco_mikado_add_admin_panel(
			array(
				'page'  => '_page_page',
				'name'  => 'panel_content',
				'title' => esc_html__( 'Content Style', 'cocco' )
			)
		);

		cocco_mikado_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'content_padding',
				'default_value' => '',
				'label'         => esc_html__( 'Content Padding for Template in Full Width', 'cocco' ),
				'description'   => esc_html__( 'Enter padding for content area for templates in full width. If you set this value then it\'s important to set also Content padding for mobile header value in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'cocco' ),
				'args'          => array(
					'col_width' => 3
				),
				'parent'        => $panel_content
			)
		);

		cocco_mikado_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'content_padding_in_grid',
				'default_value' => '',
				'label'         => esc_html__( 'Content Padding for Templates in Grid', 'cocco' ),
				'description'   => esc_html__( 'Enter padding for content area for Templates in grid. If you set this value then it\'s important to set also Content padding for mobile header value in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'cocco' ),
				'args'          => array(
					'col_width' => 3
				),
				'parent'        => $panel_content
			)
		);

		cocco_mikado_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'content_padding_mobile',
				'default_value' => '',
				'label'         => esc_html__( 'Content Padding for Mobile Header', 'cocco' ),
				'description'   => esc_html__( 'Enter padding for content area for Mobile Header in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'cocco' ),
				'args'          => array(
					'col_width' => 3
				),
				'parent'        => $panel_content
			)
		);

		cocco_mikado_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'content_background_image',
				'default_value' => '',
				'label'         => esc_html__( 'Content Background Image', 'cocco' ),
				'description'   => esc_html__( 'Choose image to use as content background image', 'cocco' ),
				'parent'        => $panel_content
			)
		);


		cocco_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'content_background_image_behavior',
				'default_value' => 'theme-default',
				'label'         => esc_html__( 'Content Background Image Behavior', 'cocco' ),
				'description'   => esc_html__( 'Choose background image behavior', 'cocco' ),
				'parent'        => $panel_content,
				'options'		=> array(
					'theme-default' => esc_html__('Theme Default','cocco'),
					'full-image' => esc_html__('As Full Image','cocco'),
					'pattern' => esc_html__('As Pattern','cocco'),
				)
			)
		);
		/***************** Content Layout - end **********************/
		
		/***************** Additional Page Layout - start *****************/
		
		do_action( 'cocco_mikado_action_additional_page_options_map' );
		
		/***************** Additional Page Layout - end *****************/
	}
	
	add_action( 'cocco_mikado_action_options_map', 'cocco_mikado_page_options_map', 8 );
}