<?php

if ( ! function_exists( 'cocco_mikado_set_search_fullscreen_global_option' ) ) {
    /**
     * This function set search type value for search options map
     */
    function cocco_mikado_set_search_fullscreen_global_option( $search_type_options ) {
        $search_type_options['fullscreen'] = esc_html__( 'Fullscreen', 'cocco' );

        return $search_type_options;
    }

    add_filter( 'cocco_mikado_filter_search_type_global_option', 'cocco_mikado_set_search_fullscreen_global_option' );
}