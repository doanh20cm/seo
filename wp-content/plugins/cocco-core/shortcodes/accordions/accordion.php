<?php
namespace CoccoCore\CPT\Shortcodes\Accordion;

use CoccoCore\Lib;

class Accordion implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkdf_accordion';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Mikado Accordion', 'cocco-core' ),
					'base'                    => $this->base,
					'as_parent'               => array( 'only' => 'mkdf_accordion_tab' ),
					'content_element'         => true,
					'category'                => esc_html__( 'by COCCO', 'cocco-core' ),
					'icon'                    => 'icon-wpb-accordion extended-custom-icon',
					'show_settings_on_create' => true,
					'js_view'                 => 'VcColumnView',
					'params'                  => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'cocco-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'cocco-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'style',
							'heading'    => esc_html__( 'Style', 'cocco-core' ),
							'value'      => array(
								esc_html__( 'Accordion', 'cocco-core' ) => 'accordion',
								esc_html__( 'Toggle', 'cocco-core' )    => 'toggle'
							)
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'layout',
							'heading'    => esc_html__( 'Layout', 'cocco-core' ),
							'value'      => array(
								esc_html__( 'Boxed', 'cocco-core' )  => 'boxed',
								esc_html__( 'Simple', 'cocco-core' ) => 'simple'
							)
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'background_skin',
							'heading'    => esc_html__( 'Background Skin', 'cocco-core' ),
							'value'      => array(
								esc_html__( 'Default', 'cocco-core' ) => '',
								esc_html__( 'White', 'cocco-core' )   => 'white'
							),
							'dependency' => array( 'element' => 'layout', 'value' => array( 'boxed' ) )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'custom_class'    => '',
			'title'           => '',
			'style'           => 'accordion',
			'layout'          => 'boxed',
			'background_skin' => ''
		);
		$params       = shortcode_atts( $default_atts, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['content']        = $content;
		
		$output = cocco_core_get_shortcode_module_template_part( 'templates/accordion-holder-template', 'accordions', '', $params );
		
		return $output;
	}
	
	private function getHolderClasses( $params ) {
		$holder_classes = array( 'mkdf-ac-default' );
		
		$holder_classes[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holder_classes[] = $params['style'] == 'toggle' ? 'mkdf-toggle' : 'mkdf-accordion';
		$holder_classes[] = ! empty( $params['layout'] ) ? 'mkdf-ac-' . esc_attr( $params['layout'] ) : '';
		$holder_classes[] = ! empty( $params['background_skin'] ) ? 'mkdf-' . esc_attr( $params['background_skin'] ) . '-skin' : '';
		
		return implode( ' ', $holder_classes );
	}
}
