<?php

if ( ! function_exists( 'cocco_core_testimonials_meta_box_functions' ) ) {
	function cocco_core_testimonials_meta_box_functions( $post_types ) {
		$post_types[] = 'testimonials';
		
		return $post_types;
	}
	
	add_filter( 'cocco_mikado_filter_meta_box_post_types_save', 'cocco_core_testimonials_meta_box_functions' );
	add_filter( 'cocco_mikado_filter_meta_box_post_types_remove', 'cocco_core_testimonials_meta_box_functions' );
}

if ( ! function_exists( 'cocco_core_register_testimonials_cpt' ) ) {
	function cocco_core_register_testimonials_cpt( $cpt_class_name ) {
		$cpt_class = array(
			'CoccoCore\CPT\Testimonials\TestimonialsRegister'
		);
		
		$cpt_class_name = array_merge( $cpt_class_name, $cpt_class );
		
		return $cpt_class_name;
	}
	
	add_filter( 'cocco_core_filter_register_custom_post_types', 'cocco_core_register_testimonials_cpt' );
}

// Load testimonials shortcodes
if(!function_exists('cocco_core_include_testimonials_shortcodes_files')) {
    /**
     * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
     */
    function cocco_core_include_testimonials_shortcodes_files() {
        if( cocco_core_is_theme_registered() ) {
            foreach ( glob( COCCO_CORE_CPT_PATH . '/testimonials/shortcodes/*/load.php' ) as $shortcode_load )
            {
                include_once $shortcode_load;
            }
        }
    }

    add_action('cocco_core_action_include_shortcodes_file', 'cocco_core_include_testimonials_shortcodes_files');
}