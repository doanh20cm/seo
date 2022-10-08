<?php
namespace CoccoCore\CPT\Shortcodes\ElementsHolder;

use CoccoCore\Lib;

class ElementsHolderItem implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkdf_elements_holder_item';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Mikado Elements Holder Item', 'cocco-core' ),
					'base'                    => $this->base,
					'as_child'                => array( 'only' => 'mkdf_elements_holder' ),
					'as_parent'               => array( 'except' => 'vc_row, vc_accordion' ),
					'content_element'         => true,
					'category'                => esc_html__( 'by COCCO', 'cocco-core' ),
					'icon'                    => 'icon-wpb-elements-holder-item extended-custom-icon',
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
							'type'        => 'dropdown',
							'heading'     => esc_html__('Width', 'cocco-core'),
							'param_name'  => 'item_width',
							'value'       => array(
								'' => '',
								'1/1' => '1-1',
								'1/2' => '1-2',
								'1/3' => '1-3',
								'2/3' => '2-3',
								'1/4' => '1-4',
								'3/4' => '3-4',
								'1/5' => '1-5',
								'2/5' => '2-5',
								'3/5' => '3-5',
								'4/5' => '4-5',
								'1/6' => '1-6',
								'5/6' => '5-6',
							)
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'background_color',
							'heading'    => esc_html__( 'Background Color', 'cocco-core' )
						),
						array(
							'type'       => 'attach_image',
							'param_name' => 'background_image',
							'heading'    => esc_html__( 'Background Image', 'cocco-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding',
							'heading'     => esc_html__( 'Padding', 'cocco-core' ),
							'description' => esc_html__( 'Please insert padding in format 0px 10px 0px 10px', 'cocco-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'horizontal_alignment',
							'heading'    => esc_html__( 'Horizontal Alignment', 'cocco-core' ),
							'value'      => array(
								esc_html__( 'Left', 'cocco-core' )   => 'left',
								esc_html__( 'Right', 'cocco-core' )  => 'right',
								esc_html__( 'Center', 'cocco-core' ) => 'center'
							)
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'vertical_alignment',
							'heading'    => esc_html__( 'Vertical Alignment', 'cocco-core' ),
							'value'      => array(
								esc_html__( 'Middle', 'cocco-core' ) => 'middle',
								esc_html__( 'Top', 'cocco-core' )    => 'top',
								esc_html__( 'Bottom', 'cocco-core' ) => 'bottom'
							)
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'border_color',
							'heading'    => esc_html__( 'Border Color', 'cocco-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'border_width',
							'dependency' => array( 'element' => 'border_color', 'not_empty' => true ),
							'heading'    => esc_html__( 'Border Width', 'cocco-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'border_style',
							'dependency' => array( 'element' => 'border_color', 'not_empty' => true ),
							'heading'    => esc_html__( 'Border Style', 'cocco-core' ),
							'value'      => array(
								esc_html__( 'Solid', 'cocco-core' ) => 'solid',
								esc_html__( 'Dashed', 'cocco-core' )    => 'dashed',
								esc_html__( 'Dotted', 'cocco-core' ) => 'dotted'
							)
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'border_radius',
							'heading'    => esc_html__( 'Border Radius', 'cocco-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'animation',
							'heading'    => esc_html__( 'Animation Type', 'cocco-core' ),
							'value'      => array(
								esc_html__( 'Default (No Animation)', 'cocco-core' )   => '',
								esc_html__( 'Element Grow In', 'cocco-core' )          => 'mkdf-grow-in',
								esc_html__( 'Element Fade In Down', 'cocco-core' )     => 'mkdf-fade-in-down',
								esc_html__( 'Element From Fade', 'cocco-core' )        => 'mkdf-element-from-fade',
								esc_html__( 'Element From Left', 'cocco-core' )        => 'mkdf-element-from-left',
								esc_html__( 'Element From Right', 'cocco-core' )       => 'mkdf-element-from-right',
								esc_html__( 'Element From Top', 'cocco-core' )         => 'mkdf-element-from-top',
								esc_html__( 'Element From Bottom', 'cocco-core' )      => 'mkdf-element-from-bottom',
								esc_html__( 'Element Flip In', 'cocco-core' )          => 'mkdf-flip-in',
								esc_html__( 'Element X Rotate', 'cocco-core' )         => 'mkdf-x-rotate',
								esc_html__( 'Element Z Rotate', 'cocco-core' )         => 'mkdf-z-rotate',
								esc_html__( 'Element Y Translate', 'cocco-core' )      => 'mkdf-y-translate',
								esc_html__( 'Element Fade In X Rotate', 'cocco-core' ) => 'mkdf-fade-in-left-x-rotate',
							)
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'animation_delay',
							'heading'    => esc_html__( 'Animation Delay (ms)', 'cocco-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_1367_1600',
							'heading'     => esc_html__( 'Padding on screen size between 1367px-1600px', 'cocco-core' ),
							'description' => esc_html__( 'Please insert padding in format top right bottom left. For example 10px 0 10px 0', 'cocco-core' ),
							'group'       => esc_html__( 'Width & Responsiveness', 'cocco-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_1025_1366',
							'heading'     => esc_html__( 'Padding on screen size between 1025px-1366px', 'cocco-core' ),
							'description' => esc_html__( 'Please insert padding in format top right bottom left. For example 10px 0 10px 0', 'cocco-core' ),
							'group'       => esc_html__( 'Width & Responsiveness', 'cocco-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_769_1024',
							'heading'     => esc_html__( 'Padding on screen size between 769px-1024px', 'cocco-core' ),
							'description' => esc_html__( 'Please insert padding in format 0px 10px 0px 10px', 'cocco-core' ),
							'group'       => esc_html__( 'Width & Responsiveness', 'cocco-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_681_768',
							'heading'     => esc_html__( 'Padding on screen size between 681px-768px', 'cocco-core' ),
							'description' => esc_html__( 'Please insert padding in format 0px 10px 0px 10px', 'cocco-core' ),
							'group'       => esc_html__( 'Width & Responsiveness', 'cocco-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_680',
							'heading'     => esc_html__( 'Padding on screen size bellow 680px', 'cocco-core' ),
							'description' => esc_html__( 'Please insert padding in format 0px 10px 0px 10px', 'cocco-core' ),
							'group'       => esc_html__( 'Width & Responsiveness', 'cocco-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'           => '',
			'item_width'             => '',
			'background_color'       => '',
			'background_image'       => '',
			'item_padding'           => '',
			'horizontal_alignment'   => '',
			'vertical_alignment'     => '',
			'border_color'     		 => '',
			'border_width'     		 => '1px',
			'border_style'     		 => 'solid',
			'border_radius'          => '',
			'animation'              => '',
			'animation_delay'        => '',
			'item_padding_1367_1600' => '',
			'item_padding_1025_1366' => '',
			'item_padding_769_1024'  => '',
			'item_padding_681_768'   => '',
			'item_padding_680'       => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['content']           = $content;
		$params['holder_classes']    = $this->getHolderClasses( $params );
		$params['holder_rand_class'] = 'mkdf-eh-custom-' . mt_rand( 1000, 10000 );
		$params['holder_styles']     = $this->getHolderStyles( $params );
		$params['content_styles']    = $this->getContentStyles( $params );
		$params['holder_data']       = $this->getHolderData( $params );
		
		$html = cocco_core_get_shortcode_module_template_part( 'templates/elements-holder-item-template', 'elements-holder', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['vertical_alignment'] ) ? 'mkdf-vertical-alignment-' . $params['vertical_alignment'] : '';
		$holderClasses[] = ! empty( $params['horizontal_alignment'] ) ? 'mkdf-horizontal-alignment-' . $params['horizontal_alignment'] : '';
		$holderClasses[] = ! empty( $params['animation'] ) ? $params['animation'] : '';
		$holderClasses[] = ! empty( $params['item_width'] ) ? 'mkdf-width-' .$params['item_width'] : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['background_color'] ) ) {
			$styles[] = 'background-color: ' . $params['background_color'];
		}
		
		if ( ! empty( $params['background_image'] ) ) {
			$styles[] = 'background-image: url(' . wp_get_attachment_url( $params['background_image'] ) . ')';
		}
		if ( ! empty( $params['border_color'] ) ) {
			$styles[] = 'border-color: ' . $params['border_color'];

			if ( ! empty( $params['border_width'] ) ) {
				$styles[] = 'border-width: ' . $params['border_width'];
			}
			if ( ! empty( $params['border_style'] ) ) {
				$styles[] = 'border-style: ' . $params['border_style'];
			}
		}

		if ( ! empty( $params['border_radius'] ) ) {
			$styles[] = 'border-radius: ' . $params['border_radius'];
		}
		
		return implode( ';', $styles );
	}

	
	private function getContentStyles( $params ) {
		$styles = array();
		
		if ( $params['item_padding'] !== '' ) {
			$styles[] = 'padding: ' . $params['item_padding'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getHolderData( $params ) {
		$data                    = array();
		$data['data-item-class'] = $params['holder_rand_class'];
		
		if ( ! empty( $params['animation'] ) ) {
			$data['data-animation'] = $params['animation'];
		}
		
		if ( $params['animation_delay'] !== '' ) {
			$data['data-animation-delay'] = esc_attr( $params['animation_delay'] );
		}
		
		if ( $params['item_padding_1367_1600'] !== '' ) {
			$data['data-1367-1600'] = $params['item_padding_1367_1600'];
		}
		
		if ( $params['item_padding_1025_1366'] !== '' ) {
			$data['data-1025-1366'] = $params['item_padding_1025_1366'];
		}
		
		if ( $params['item_padding_769_1024'] !== '' ) {
			$data['data-769-1024'] = $params['item_padding_769_1024'];
		}
		
		if ( $params['item_padding_681_768'] !== '' ) {
			$data['data-681-768'] = $params['item_padding_681_768'];
		}
		
		if ( $params['item_padding_680'] !== '' ) {
			$data['data-680'] = $params['item_padding_680'];
		}
		
		return $data;
	}
}
