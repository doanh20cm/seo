<?php

if ( ! function_exists( 'cocco_mikado_register_image_gallery_widget' ) ) {
	/**
	 * Function that register image gallery widget
	 */
	function cocco_mikado_register_image_gallery_widget( $widgets ) {
		$widgets[] = 'CoccoMikadoImageGalleryWidget';
		
		return $widgets;
	}
	
	add_filter( 'cocco_core_filter_register_widgets', 'cocco_mikado_register_image_gallery_widget' );
}