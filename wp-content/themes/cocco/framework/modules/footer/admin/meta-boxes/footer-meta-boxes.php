<?php

if ( ! function_exists( 'cocco_mikado_map_footer_meta' ) ) {
	function cocco_mikado_map_footer_meta() {

		$footer_meta_box = cocco_mikado_create_meta_box(
			array(
				'scope' => apply_filters( 'cocco_mikado_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'footer_meta' ),
				'title' => esc_html__( 'Footer', 'cocco' ),
				'name'  => 'footer_meta'
			)
		);

		cocco_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_disable_footer_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Disable Footer for this Page', 'cocco' ),
				'description'   => esc_html__( 'Enabling this option will hide footer on this page', 'cocco' ),
				'options'       => cocco_mikado_get_yes_no_select_array(),
				'parent'        => $footer_meta_box
			)
		);

		$show_footer_meta_container = cocco_mikado_add_admin_container(
			array(
				'name'       => 'mkdf_show_footer_meta_container',
				'parent'     => $footer_meta_box,
				'dependency' => array(
					'hide' => array(
						'mkdf_disable_footer_meta' => 'yes'
					)
				)
			)
		);

		cocco_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_footer_in_grid_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Footer in Grid', 'cocco' ),
				'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'cocco' ),
				'options'       => cocco_mikado_get_yes_no_select_array(),
				'parent'        => $show_footer_meta_container
			)
		);

		cocco_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_uncovering_footer_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Uncovering Footer', 'cocco' ),
				'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'cocco' ),
				'options'       => cocco_mikado_get_yes_no_select_array(),
				'parent'        => $show_footer_meta_container
			)
		);

		cocco_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_show_footer_top_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Footer Top', 'cocco' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'cocco' ),
				'options'       => cocco_mikado_get_yes_no_select_array(),
				'parent'        => $show_footer_meta_container
			)
		);

		cocco_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_footer_top_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Footer Top Background Color', 'cocco' ),
				'description' => esc_html__( 'Set background color for top footer area', 'cocco' ),
				'parent'      => $show_footer_meta_container,
				'dependency' => array(
					'show' => array(
						'mkdf_show_footer_top_meta' => array( '', 'yes' )
					)
				)
			)
		);

		cocco_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_footer_top_border_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Footer Top Border', 'cocco' ),
				'description'   => esc_html__( 'Enable Top Border For Footer Top', 'cocco' ),
				'options'       => cocco_mikado_get_yes_no_select_array(),
				'parent'        => $show_footer_meta_container
			)
		);
		

		cocco_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_show_footer_bottom_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Footer Bottom', 'cocco' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'cocco' ),
				'options'       => cocco_mikado_get_yes_no_select_array(),
				'parent'        => $show_footer_meta_container
			)
		);

		cocco_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_footer_bottom_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Footer Bottom Background Color', 'cocco' ),
				'description' => esc_html__( 'Set background color for bottom footer area', 'cocco' ),
				'parent'      => $show_footer_meta_container,
				'dependency' => array(
					'show' => array(
						'mkdf_show_footer_bottom_meta' => array( '', 'yes' )
					)
				)
			)
		);
	}

	add_action( 'cocco_mikado_action_meta_boxes_map', 'cocco_mikado_map_footer_meta', 70 );
}