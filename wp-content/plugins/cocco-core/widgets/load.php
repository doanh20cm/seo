<?php

if ( ! function_exists( 'cocco_core_load_widget_class' ) ) {
	/**
	 * Loades widget class file.
	 */
	function cocco_core_load_widget_class() {
		include_once 'widget-class.php';
	}
	
	add_action( 'cocco_mikado_before_options_map', 'cocco_core_load_widget_class' );
}

if ( ! function_exists( 'cocco_core_load_widgets' ) ) {
	/**
	 * Loades all widgets by going through all folders that are placed directly in widgets folder
	 * and loads load.php file in each. Hooks to cocco_mikado_action_after_options_map action
	 */
	function cocco_core_load_widgets() {
		
		if ( cocco_core_theme_installed() ) {
			foreach ( glob( MIKADO_FRAMEWORK_ROOT_DIR . '/modules/widgets/*/load.php' ) as $widget_load ) {
				include_once $widget_load;
			}
		}
		
		include_once 'widget-loader.php';
	}
	
	add_action( 'cocco_mikado_before_options_map', 'cocco_core_load_widgets' );
}