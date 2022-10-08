<?php

if ( ! function_exists( 'cocco_mikado_sidebar_options_map' ) ) {
	function cocco_mikado_sidebar_options_map() {
		
		$sidebar_panel = cocco_mikado_add_admin_panel(
			array(
				'title' => esc_html__( 'Sidebar Area', 'cocco' ),
				'name'  => 'sidebar',
				'page'  => '_page_page'
			)
		);
		
		cocco_mikado_add_admin_field( array(
			'name'          => 'sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__( 'Sidebar Layout', 'cocco' ),
			'description'   => esc_html__( 'Choose a sidebar layout for pages', 'cocco' ),
			'parent'        => $sidebar_panel,
			'default_value' => 'no-sidebar',
            'options'       => cocco_mikado_get_custom_sidebars_options()
		) );
		
		$cocco_custom_sidebars = cocco_mikado_get_custom_sidebars();
		if ( count( $cocco_custom_sidebars ) > 0 ) {
			cocco_mikado_add_admin_field( array(
				'name'        => 'custom_sidebar_area',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'cocco' ),
				'description' => esc_html__( 'Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'cocco' ),
				'parent'      => $sidebar_panel,
				'options'     => $cocco_custom_sidebars,
				'args'        => array(
					'select2' => true
				)
			) );
		}

        cocco_mikado_add_admin_field( array(
            'name'          => 'sidebar_type',
            'type'          => 'select',
            'label'         => esc_html__( 'Sidebar Type', 'cocco' ),
            'description'   => esc_html__( 'Choose a sidebar type for pages', 'cocco' ),
            'parent'        => $sidebar_panel,
            'default_value' => 'standard',
            'options'		=> array(
                'standard' => esc_html__('Standard','cocco'),
                'boxed' => esc_html__('Boxed','cocco'),
            ),
            'dependency' => array(
                'hide' => array(
                    'sidebar_layout'  => 'no-sidebar'
                )
            )
        ) );

	}
	
	add_action( 'cocco_mikado_action_options_map', 'cocco_mikado_sidebar_options_map', 9 );
}