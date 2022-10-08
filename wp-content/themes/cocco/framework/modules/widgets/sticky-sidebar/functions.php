<?php

if(!function_exists('cocco_mikado_register_sticky_sidebar_widget')) {
	/**
	 * Function that register sticky sidebar widget
	 */
	function cocco_mikado_register_sticky_sidebar_widget($widgets) {
		$widgets[] = 'CoccoMikadoStickySidebar';
		
		return $widgets;
	}
	
	add_filter('cocco_core_filter_register_widgets', 'cocco_mikado_register_sticky_sidebar_widget');
}