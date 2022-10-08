<?php

if ( ! function_exists( 'cocco_mikado_like' ) ) {
	/**
	 * Returns CoccoMikadoLike instance
	 *
	 * @return CoccoMikadoLike
	 */
	function cocco_mikado_like() {
		return CoccoMikadoLike::get_instance();
	}
}

function cocco_mikado_get_like() {
	
	echo wp_kses( cocco_mikado_like()->add_like(), array(
		'span' => array(
			'class'       => true,
			'aria-hidden' => true,
			'style'       => true,
			'id'          => true
		),
		'i'    => array(
			'class' => true,
			'style' => true,
			'id'    => true
		),
		'a'    => array(
			'href'  => true,
			'class' => true,
			'id'    => true,
			'title' => true,
			'style' => true
		)
	) );
}