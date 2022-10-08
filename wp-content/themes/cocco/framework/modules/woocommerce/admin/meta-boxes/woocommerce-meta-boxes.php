<?php

if ( ! function_exists( 'cocco_mikado_map_woocommerce_meta' ) ) {
	function cocco_mikado_map_woocommerce_meta() {
		
		$woocommerce_meta_box = cocco_mikado_create_meta_box(
			array(
				'scope' => array( 'product' ),
				'title' => esc_html__( 'Product Meta', 'cocco' ),
				'name'  => 'woo_product_meta'
			)
		);
		
		cocco_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_product_featured_image_size',
				'type'        => 'select',
				'label'       => esc_html__( 'Dimensions for Product List Shortcode', 'cocco' ),
				'description' => esc_html__( 'Choose image layout when it appears in Mikado Product List - Masonry layout shortcode', 'cocco' ),
				'options'     => array(
					''                   => esc_html__( 'Default', 'cocco' ),
					'small'              => esc_html__( 'Small', 'cocco' ),
					'large-width'        => esc_html__( 'Large Width', 'cocco' ),
					'large-height'       => esc_html__( 'Large Height', 'cocco' ),
					'large-width-height' => esc_html__( 'Large Width Height', 'cocco' )
				),
				'parent'      => $woocommerce_meta_box
			)
		);
		
		cocco_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_show_title_area_woo_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'cocco' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'cocco' ),
				'options'       => cocco_mikado_get_yes_no_select_array(),
				'parent'        => $woocommerce_meta_box
			)
		);
		
		cocco_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_show_new_sign_woo_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show New Sign', 'cocco' ),
				'description'   => esc_html__( 'Enabling this option will show new sign mark on product', 'cocco' ),
				'parent'        => $woocommerce_meta_box
			)
		);
	}
	
	add_action( 'cocco_mikado_action_meta_boxes_map', 'cocco_mikado_map_woocommerce_meta', 99 );
}