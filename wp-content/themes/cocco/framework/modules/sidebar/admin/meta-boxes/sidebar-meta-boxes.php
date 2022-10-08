<?php

if ( ! function_exists( 'cocco_mikado_map_sidebar_meta' ) ) {
	function cocco_mikado_map_sidebar_meta() {
		$mkdf_sidebar_meta_box = cocco_mikado_create_meta_box(
			array(
				'scope' => apply_filters( 'cocco_mikado_filter_set_scope_for_meta_boxes', array( 'page' ), 'sidebar_meta' ),
				'title' => esc_html__( 'Sidebar', 'cocco' ),
				'name'  => 'sidebar_meta'
			)
		);
		
		cocco_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_sidebar_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Sidebar Layout', 'cocco' ),
				'description' => esc_html__( 'Choose the sidebar layout', 'cocco' ),
				'parent'      => $mkdf_sidebar_meta_box,
                'options'       => cocco_mikado_get_custom_sidebars_options( true )
			)
		);
		
		$mkdf_custom_sidebars = cocco_mikado_get_custom_sidebars();
		if ( count( $mkdf_custom_sidebars ) > 0 ) {
			cocco_mikado_create_meta_box_field(
				array(
					'name'        => 'mkdf_custom_sidebar_area_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Widget Area in Sidebar', 'cocco' ),
					'description' => esc_html__( 'Choose Custom Widget area to display in Sidebar"', 'cocco' ),
					'parent'      => $mkdf_sidebar_meta_box,
					'options'     => $mkdf_custom_sidebars,
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
        cocco_mikado_create_meta_box_field(
            array(
                'name'        => 'mkdf_sidebar_type_meta',
                'type'        => 'select',
                'label'       => esc_html__( 'Sidebar Type', 'cocco' ),
                'description' => esc_html__( 'Choose a sidebar type', 'cocco' ),
                'parent'      => $mkdf_sidebar_meta_box,
                'options'		=> array(
                    'standard' => esc_html__('Standard','cocco'),
                    'boxed' => esc_html__('Boxed','cocco'),
                ),
                'dependency' => array(
                    'hide' => array(
                        'mkdf_sidebar_layout_meta'  => array('no-sidebar', '')
                    )
                )
            )
        );

	}
	
	add_action( 'cocco_mikado_action_meta_boxes_map', 'cocco_mikado_map_sidebar_meta', 31 );
}