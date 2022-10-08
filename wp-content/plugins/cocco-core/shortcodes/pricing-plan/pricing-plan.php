<?php
namespace CoccoCore\CPT\Shortcodes\PricingPlan;

use CoccoCore\Lib;

class PricingPlan implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkdf_pricing_plan';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Mikado Pricing Plan', 'cocco-core' ),
					'base'                    => $this->base,
					'as_parent'               => array( 'only' => 'mkdf_pricing_plan_item' ),
					'content_element'         => true,
					'category'                => esc_html__( 'by COCCO', 'cocco-core' ),
					'icon'                    => 'icon-wpb-pricing-plan extended-custom-icon',
					'show_settings_on_create' => true,
					'js_view'                 => 'VcColumnView',
					'params'                  => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'columns',
							'heading'     => esc_html__( 'Number of Columns', 'cocco-core' ),
							'value'       => array(
								esc_html__( 'One', 'cocco-core' )   => 'mkdf-one-column',
								esc_html__( 'Two', 'cocco-core' )   => 'mkdf-two-columns',
								esc_html__( 'Three', 'cocco-core' ) => 'mkdf-three-columns',
								esc_html__( 'Four', 'cocco-core' )  => 'mkdf-four-columns',
								esc_html__( 'Five', 'cocco-core' )  => 'mkdf-five-columns',
							),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'space_between_items',
							'heading'     => esc_html__( 'Space Between Items', 'cocco-core' ),
							'value'       => array_flip( cocco_mikado_get_space_between_items_array() ),
							'save_always' => true
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'columns'             => 'mkdf-two-columns',
			'space_between_items' => 'normal'
		);
		$params = shortcode_atts( $args, $atts );
		
		$holder_class = $this->getHolderClasses( $params, $args );
		
		$html = '<div class="mkdf-pricing-plans clearfix ' . esc_attr( $holder_class ) . '">';
			$html .= '<div class="mkdf-pp-wrapper mkdf-outer-space">';
				$html .= do_shortcode( $content );
			$html .= '</div>';
		$html .= '</div>';
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['columns'] ) ? $params['columns'] : $args['columns'];
		$holderClasses[] = ! empty( $params['space_between_items'] ) ? 'mkdf-' . $params['space_between_items'] . '-space' : 'mkdf-' . $args['space_between_items'] . '-space';
		
		return implode( ' ', $holderClasses );
	}
}