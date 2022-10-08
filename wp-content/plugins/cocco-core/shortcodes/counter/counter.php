<?php
namespace CoccoCore\CPT\Shortcodes\Counter;

use CoccoCore\Lib;

class Counter implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'mkdf_counter';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Mikado Counter', 'cocco-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by COCCO', 'cocco-core' ),
					'icon'                      => 'icon-wpb-counter extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'cocco-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'cocco-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'type',
							'heading'     => esc_html__( 'Type', 'cocco-core' ),
							'value'       => array(
								esc_html__( 'Zero Counter', 'cocco-core' )   => 'mkdf-zero-counter',
								esc_html__( 'Random Counter', 'cocco-core' ) => 'mkdf-random-counter'
							),
							'save_always' => true,
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'digit',
							'heading'    => esc_html__( 'Digit', 'cocco-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'digit_font_size',
							'heading'    => esc_html__( 'Digit Font Size (px)', 'cocco-core' ),
							'dependency' => array( 'element' => 'digit', 'not_empty' => true )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'digit_color',
							'heading'    => esc_html__( 'Digit Color', 'cocco-core' ),
							'dependency' => array( 'element' => 'digit', 'not_empty' => true )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'title',
							'heading'    => esc_html__( 'Title', 'cocco-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'title_tag',
							'heading'     => esc_html__( 'Title Tag', 'cocco-core' ),
							'value'       => array_flip( cocco_mikado_get_title_tag( true, array('span' => 'span'))),
							'save_always' => true,
							'dependency'  => array( 'element' => 'title', 'not_empty' => true )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'title_color',
							'heading'    => esc_html__( 'Title Color', 'cocco-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'title_font_weight',
							'heading'     => esc_html__( 'Title Font Weight', 'cocco-core' ),
							'value'       => array_flip( cocco_mikado_get_font_weight_array( true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'title', 'not_empty' => true )
						),
						array(
							'type'       => 'textarea',
							'param_name' => 'text',
							'heading'    => esc_html__( 'Text', 'cocco-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'text_color',
							'heading'    => esc_html__( 'Text Color', 'cocco-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'      => '',
			'type'              => 'mkdf-zero-counter',
			'digit'             => '123',
			'digit_font_size'   => '',
			'digit_color'       => '',
			'title'             => '',
			'title_tag'         => 'h5',
			'title_color'       => '',
			'title_font_weight' => '',
			'text'              => '',
			'text_color'        => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes']       = $this->getHolderClasses( $params );
		$params['counter_styles']       = $this->getCounterStyles( $params );
		$params['counter_title_styles'] = $this->getCounterTitleStyles( $params );
		$params['counter_text_styles']  = $this->getCounterTextStyles( $params );
		
		$params['title_tag'] = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		
		$html = cocco_core_get_shortcode_module_template_part( 'templates/counter', 'counter', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getCounterStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['digit_font_size'] ) ) {
			$styles[] = 'font-size: ' . cocco_mikado_filter_px( $params['digit_font_size'] ) . 'px';
		}
		
		if ( ! empty( $params['digit_color'] ) ) {
			$styles[] = 'color: ' . $params['digit_color'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getCounterTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}
		
		if ( ! empty( $params['title_font_weight'] ) ) {
			$styles[] = 'font-weight: ' . $params['title_font_weight'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getCounterTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}
		
		return implode( ';', $styles );
	}
}