<?php

if ( ! function_exists( 'cocco_mikado_theme_version_class' ) ) {
	/**
	 * Function that adds classes on body for version of theme
	 */
	function cocco_mikado_theme_version_class( $classes ) {
		$current_theme = wp_get_theme();
		
		//is child theme activated?
		if ( $current_theme->parent() ) {
			//add child theme version
			$classes[] = strtolower( $current_theme->get( 'Name' ) ) . '-child-ver-' . $current_theme->get( 'Version' );
			
			//get parent theme
			$current_theme = $current_theme->parent();
		}
		
		if ( $current_theme->exists() && $current_theme->get( 'Version' ) != '' ) {
			$classes[] = strtolower( $current_theme->get( 'Name' ) ) . '-ver-' . $current_theme->get( 'Version' );
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'cocco_mikado_theme_version_class' );
}

if ( ! function_exists( 'cocco_mikado_boxed_class' ) ) {
	/**
	 * Function that adds classes on body for boxed layout
	 */
	function cocco_mikado_boxed_class( $classes ) {
		$allow_boxed_layout = true;
		$allow_boxed_layout = apply_filters( 'cocco_mikado_filter_allow_content_boxed_layout', $allow_boxed_layout );
		
		if ( $allow_boxed_layout && cocco_mikado_get_meta_field_intersect( 'boxed' ) === 'yes' ) {
			$classes[] = 'mkdf-boxed';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'cocco_mikado_boxed_class' );
}

if ( ! function_exists( 'cocco_mikado_paspartu_class' ) ) {
	/**
	 * Function that adds classes on body for paspartu layout
	 */
	function cocco_mikado_paspartu_class( $classes ) {
		$id = cocco_mikado_get_page_id();
		
		//is paspartu layout turned on?
		if ( cocco_mikado_get_meta_field_intersect( 'paspartu', $id ) === 'yes' ) {
			$classes[] = 'mkdf-paspartu-enabled';
			
			if ( cocco_mikado_get_meta_field_intersect( 'disable_top_paspartu', $id ) === 'yes' ) {
				$classes[] = 'mkdf-top-paspartu-disabled';
			}
			
			if ( cocco_mikado_get_meta_field_intersect( 'enable_fixed_paspartu', $id ) === 'yes' ) {
				$classes[] = 'mkdf-fixed-paspartu-enabled';
			}
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'cocco_mikado_paspartu_class' );
}

if ( ! function_exists( 'cocco_mikado_page_smooth_scroll_class' ) ) {
	/**
	 * Function that adds classes on body for page smooth scroll
	 */
	function cocco_mikado_page_smooth_scroll_class( $classes ) {
		//is smooth scroll enabled enabled?
		if ( cocco_mikado_options()->getOptionValue( 'page_smooth_scroll' ) == 'yes' ) {
			$classes[] = 'mkdf-smooth-scroll';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'cocco_mikado_page_smooth_scroll_class' );
}

if ( ! function_exists( 'cocco_mikado_smooth_page_transitions_class' ) ) {
	/**
	 * Function that adds classes on body for smooth page transitions
	 */
	function cocco_mikado_smooth_page_transitions_class( $classes ) {
		$id = cocco_mikado_get_page_id();
		
		if ( cocco_mikado_get_meta_field_intersect( 'smooth_page_transitions', $id ) == 'yes' ) {
			$classes[] = 'mkdf-smooth-page-transitions';
			
			if ( cocco_mikado_get_meta_field_intersect( 'page_transition_preloader', $id ) == 'yes' ) {
				$classes[] = 'mkdf-smooth-page-transitions-preloader';
			}
			
			if ( cocco_mikado_get_meta_field_intersect( 'page_transition_fadeout', $id ) == 'yes' ) {
				$classes[] = 'mkdf-smooth-page-transitions-fadeout';
			}
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'cocco_mikado_smooth_page_transitions_class' );
}

if ( ! function_exists( 'cocco_mikado_content_initial_width_body_class' ) ) {
	/**
	 * Function that adds transparent content class to body.
	 *
	 * @param $classes array of body classes
	 *
	 * @return array with transparent content body class added
	 */
	function cocco_mikado_content_initial_width_body_class( $classes ) {
		$initial_content_width = cocco_mikado_get_meta_field_intersect( 'initial_content_width', cocco_mikado_get_page_id() );
		
		if ( ! empty( $initial_content_width ) ) {
			$classes[] = $initial_content_width;
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'cocco_mikado_content_initial_width_body_class' );
}

if ( ! function_exists( 'cocco_mikado_set_content_behind_header_class' ) ) {
	function cocco_mikado_set_content_behind_header_class( $classes ) {
		$id = cocco_mikado_get_page_id();
		
		if ( get_post_meta( $id, 'mkdf_page_content_behind_header_meta', true ) === 'yes' ) {
			$classes[] = 'mkdf-content-is-behind-header';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'cocco_mikado_set_content_behind_header_class' );
}

if ( ! function_exists( 'cocco_mikado_set_no_google_api_class' ) ) {
	function cocco_mikado_set_no_google_api_class( $classes ) {
		$google_map_api = cocco_mikado_options()->getOptionValue( 'google_maps_api_key' );

		if ( empty( $google_map_api ) ) {
			$classes[] = 'mkdf-empty-google-api';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'cocco_mikado_set_no_google_api_class' );
}


if ( ! function_exists( 'cocco_mikado_set_content_background_behavior_class' ) ) {
	function cocco_mikado_set_content_background_behavior_class( $classes ) {
		$background_behavior = cocco_mikado_get_meta_field_intersect( 'content_background_image_behavior', cocco_mikado_get_page_id() );

		if ( $background_behavior !== '') {
			$classes[] = 'mkdf-content-background-'.$background_behavior;
		}

		return $classes;
	}

	add_filter( 'body_class', 'cocco_mikado_set_content_background_behavior_class' );
}