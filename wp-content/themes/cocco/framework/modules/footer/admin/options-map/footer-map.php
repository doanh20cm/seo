<?php

if ( ! function_exists( 'cocco_mikado_footer_options_map' ) ) {
	function cocco_mikado_footer_options_map() {

		cocco_mikado_add_admin_page(
			array(
				'slug'  => '_footer_page',
				'title' => esc_html__( 'Footer', 'cocco' ),
				'icon'  => 'fa fa-sort-amount-asc'
			)
		);

		$footer_panel = cocco_mikado_add_admin_panel(
			array(
				'title' => esc_html__( 'Footer', 'cocco' ),
				'name'  => 'footer',
				'page'  => '_footer_page'
			)
		);

		cocco_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'footer_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Footer in Grid', 'cocco' ),
				'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'cocco' ),
				'parent'        => $footer_panel
			)
		);

		cocco_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'uncovering_footer',
				'default_value' => 'no',
				'label'         => esc_html__( 'Uncovering Footer', 'cocco' ),
				'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'cocco' ),
				'parent'        => $footer_panel,
			)
		);

		cocco_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_top',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Top', 'cocco' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'cocco' ),
				'parent'        => $footer_panel,
			)
		);

		$show_footer_top_container = cocco_mikado_add_admin_container(
			array(
				'name'       => 'show_footer_top_container',
				'parent'     => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_top' => 'yes'
					)
				)
			)
		);

		cocco_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns',
				'parent'        => $show_footer_top_container,
				'default_value' => '3 3 3 3',
				'label'         => esc_html__( 'Footer Top Columns', 'cocco' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Top area', 'cocco' ),
				'options'       => array(
					'12' => '1',
					'6 6' => '2',
					'4 4 4' => '3',
					'3 3 6' => '3 (25% + 25% + 50%)',
					'3 3 3 3' => '4'
				)
			)
		);

		cocco_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns_alignment',
				'default_value' => 'left',
				'label'         => esc_html__( 'Footer Top Columns Alignment', 'cocco' ),
				'description'   => esc_html__( 'Text Alignment in Footer Columns', 'cocco' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'cocco' ),
					'left'   => esc_html__( 'Left', 'cocco' ),
					'center' => esc_html__( 'Center', 'cocco' ),
					'right'  => esc_html__( 'Right', 'cocco' )
				),
				'parent'        => $show_footer_top_container,
			)
		);

		cocco_mikado_add_admin_field(
			array(
				'name'        => 'footer_top_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'cocco' ),
				'description' => esc_html__( 'Set background color for top footer area', 'cocco' ),
				'parent'      => $show_footer_top_container
			)
		);

		cocco_mikado_add_admin_field(
			array(
				'name'          => 'footer_top_border',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Footer Top Border', 'cocco' ),
				'description'   => esc_html__( 'Enable Top Border For Footer Top', 'cocco' ),
				'parent'        => $show_footer_top_container
			)
		);

		cocco_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_bottom',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Bottom', 'cocco' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'cocco' ),
				'parent'        => $footer_panel,
			)
		);

		$show_footer_bottom_container = cocco_mikado_add_admin_container(
			array(
				'name'            => 'show_footer_bottom_container',
				'parent'          => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_bottom'  => 'yes'
					)
				)
			)
		);

		cocco_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_bottom_columns',
				'default_value' => '6 6',
				'label'         => esc_html__( 'Footer Bottom Columns', 'cocco' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Bottom area', 'cocco' ),
				'options'       => array(
					'12' => '1',
					'6 6' => '2',
					'4 4 4' => '3'
				),
				'parent'        => $show_footer_bottom_container,
			)
		);

		cocco_mikado_add_admin_field(
			array(
				'name'        => 'footer_bottom_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'cocco' ),
				'description' => esc_html__( 'Set background color for bottom footer area', 'cocco' ),
				'parent'      => $show_footer_bottom_container
			)
		);
	}

	add_action( 'cocco_mikado_action_options_map', 'cocco_mikado_footer_options_map', 11 );
}