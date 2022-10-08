<?php

if ( ! function_exists( 'cocco_mikado_register_blog_list_widget' ) ) {
	/**
	 * Function that register blog list widget
	 */
	function cocco_mikado_register_blog_list_widget( $widgets ) {
		$widgets[] = 'CoccoMikadoBlogListWidget';
		
		return $widgets;
	}
	
	add_filter( 'cocco_core_filter_register_widgets', 'cocco_mikado_register_blog_list_widget' );
}