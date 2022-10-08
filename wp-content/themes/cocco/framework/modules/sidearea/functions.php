<?php

if ( ! function_exists( 'cocco_mikado_register_side_area_sidebar' ) ) {
	/**
	 * Register side area sidebar
	 */
	function cocco_mikado_register_side_area_sidebar() {
		register_sidebar(
			array(
				'id'            => 'sidearea',
				'name'          => esc_html__( 'Side Area', 'cocco' ),
				'description'   => esc_html__( 'Side Area', 'cocco' ),
				'before_widget' => '<div id="%1$s" class="widget mkdf-sidearea %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="mkdf-widget-title-holder"><h5 class="mkdf-widget-title">',
				'after_title'   => '</h5></div>'
			)
		);
	}

	add_action( 'widgets_init', 'cocco_mikado_register_side_area_sidebar' );
}

if ( ! function_exists( 'cocco_mikado_side_menu_body_class' ) ) {
	/**
	 * Function that adds body classes for different side menu styles
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function cocco_mikado_side_menu_body_class( $classes ) {

		if ( is_active_widget( false, false, 'mkdf_side_area_opener' ) ) {

			if ( cocco_mikado_options()->getOptionValue( 'side_area_type' ) ) {
				$classes[] = 'mkdf-' . cocco_mikado_options()->getOptionValue( 'side_area_type' );
			}
		}

		return $classes;
	}

	add_filter( 'body_class', 'cocco_mikado_side_menu_body_class' );
}

if ( ! function_exists( 'cocco_mikado_get_side_area' ) ) {
	/**
	 * Loads side area HTML
	 */
	function cocco_mikado_get_side_area() {

		if ( is_active_widget( false, false, 'mkdf_side_area_opener' ) ) {
			$parameters = array(
				'close_icon_classes' => cocco_mikado_get_side_area_close_icon_class()
			);

			cocco_mikado_get_module_template_part( 'templates/sidearea', 'sidearea', '', $parameters );
		}
	}

	add_action( 'cocco_mikado_action_after_body_tag', 'cocco_mikado_get_side_area', 10 );
}

if ( ! function_exists( 'cocco_mikado_get_side_area_close_class' ) ) {
	/**
	 * Loads side area close icon class
	 */
	function cocco_mikado_get_side_area_close_icon_class() {
		$classes = array(
			'mkdf-close-side-menu'
		);

		$classes[] = cocco_mikado_get_icon_sources_class( 'side_area', 'mkdf-close-side-menu' );

		return $classes;
	}
}