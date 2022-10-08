<?php
namespace CoccoCore\CPT\Shortcodes\IconWithText;

use CoccoCore\Lib;

class IconWithText implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'mkdf_icon_with_text';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Mikado Icon With Text', 'cocco-core' ),
					'base'                      => $this->base,
					'icon'                      => 'icon-wpb-icon-with-text extended-custom-icon',
					'category'                  => esc_html__( 'by COCCO', 'cocco-core' ),
					'allowed_container_element' => 'vc_row',
					'params'                    => array_merge(
						array(
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
									esc_html__( 'Icon Left From Text', 'cocco-core' )  => 'icon-left',
									esc_html__( 'Icon Left From Title', 'cocco-core' ) => 'icon-left-from-title',
									esc_html__( 'Icon Top', 'cocco-core' )             => 'icon-top'
								),
								'save_always' => true
							)
						),
						cocco_mikado_icon_collections()->getVCParamsArray(),
						array(
							array(
								'type'       => 'attach_image',
								'param_name' => 'custom_icon',
								'heading'    => esc_html__( 'Custom Icon', 'cocco-core' )
							),
							array(
								'type'       => 'attach_image',
								'param_name' => 'custom_hover_icon',
								'heading'    => esc_html__( 'Custom Hover Icon', 'cocco-core' ),
								'dependency' => array('element' => 'custom_icon', 'not_empty' => true)
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'icon_type',
								'heading'    => esc_html__( 'Icon Type', 'cocco-core' ),
								'value'      => array(
									esc_html__( 'Normal', 'cocco-core' ) => 'mkdf-normal',
									esc_html__( 'Circle', 'cocco-core' ) => 'mkdf-circle',
									esc_html__( 'Square', 'cocco-core' ) => 'mkdf-square'
								),
								'group'      => esc_html__( 'Icon Settings', 'cocco-core' )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'icon_size',
								'heading'    => esc_html__( 'Icon Size', 'cocco-core' ),
								'value'      => array(
									esc_html__( 'Medium', 'cocco-core' )     => 'mkdf-icon-medium',
									esc_html__( 'Tiny', 'cocco-core' )       => 'mkdf-icon-tiny',
									esc_html__( 'Small', 'cocco-core' )      => 'mkdf-icon-small',
									esc_html__( 'Large', 'cocco-core' )      => 'mkdf-icon-large',
									esc_html__( 'Very Large', 'cocco-core' ) => 'mkdf-icon-huge'
								),
								'group'      => esc_html__( 'Icon Settings', 'cocco-core' ),
								'description'=> esc_html__('Refers only to icons from icon pack', 'cocco-core')
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'custom_icon_size',
								'heading'    => esc_html__( 'Custom Icon Size (px)', 'cocco-core' ),
								'group'      => esc_html__( 'Icon Settings', 'cocco-core' ),
								'description'=> esc_html__('Refers only to icons from icon pack', 'cocco-core')
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'shape_size',
								'heading'    => esc_html__( 'Shape Size (px)', 'cocco-core' ),
								'group'      => esc_html__( 'Icon Settings', 'cocco-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_color',
								'heading'    => esc_html__( 'Icon Color', 'cocco-core' ),
								'group'      => esc_html__( 'Icon Settings', 'cocco-core' ),
								'description'=> esc_html__('Refers only to icons from icon pack', 'cocco-core')
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_background_color',
								'heading'    => esc_html__( 'Icon Background Color', 'cocco-core' ),
								'dependency' => array(
									'element' => 'icon_type',
									'value'   => array( 'mkdf-square', 'mkdf-circle' )
								),
								'group'      => esc_html__( 'Icon Settings', 'cocco-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_border_color',
								'heading'    => esc_html__( 'Icon Border Color', 'cocco-core' ),
								'dependency' => array(
									'element' => 'icon_type',
									'value'   => array( 'mkdf-square', 'mkdf-circle' )
								),
								'group'      => esc_html__( 'Icon Settings', 'cocco-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'icon_border_width',
								'heading'    => esc_html__( 'Border Width (px)', 'cocco-core' ),
								'dependency' => array(
									'element' => 'icon_type',
									'value'   => array( 'mkdf-square', 'mkdf-circle' )
								),
								'group'      => esc_html__( 'Icon Settings', 'cocco-core' )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'icon_switch',
								'heading'    => esc_html__( 'Icon Switch', 'cocco-core' ),
								'value'      => array_flip( cocco_mikado_get_yes_no_select_array( false ) ),
								'group'      => esc_html__( 'Icon Settings', 'cocco-core' ),
								'description'=> esc_html__('Refers only to icons from icon pack', 'cocco-core')
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'icon_animation',
								'heading'    => esc_html__( 'Icon Animation', 'cocco-core' ),
								'value'      => array_flip( cocco_mikado_get_yes_no_select_array( false ) ),
								'group'      => esc_html__( 'Icon Settings', 'cocco-core' ),
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'icon_animation_delay',
								'heading'    => esc_html__( 'Icon Animation Delay (ms)', 'cocco-core' ),
								'dependency' => array( 'element' => 'icon_animation', 'value' => array( 'yes' ) ),
								'group'      => esc_html__( 'Icon Settings', 'cocco-core' )
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
								'value'       => array_flip( cocco_mikado_get_title_tag( true ) ),
								'save_always' => true,
								'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
								'group'       => esc_html__( 'Text Settings', 'cocco-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'title_color',
								'heading'    => esc_html__( 'Title Color', 'cocco-core' ),
								'dependency' => array( 'element' => 'title', 'not_empty' => true ),
								'group'      => esc_html__( 'Text Settings', 'cocco-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'title_top_margin',
								'heading'    => esc_html__( 'Title Top Margin (px)', 'cocco-core' ),
								'dependency' => array( 'element' => 'title', 'not_empty' => true ),
								'group'      => esc_html__( 'Text Settings', 'cocco-core' )
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
								'dependency' => array( 'element' => 'text', 'not_empty' => true ),
								'group'      => esc_html__( 'Text Settings', 'cocco-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'text_top_margin',
								'heading'    => esc_html__( 'Text Top Margin (px)', 'cocco-core' ),
								'dependency' => array( 'element' => 'text', 'not_empty' => true ),
								'group'      => esc_html__( 'Text Settings', 'cocco-core' )
							),
							array(
								'type'        => 'textfield',
								'param_name'  => 'link',
								'heading'     => esc_html__( 'Link', 'cocco-core' ),
								'description' => esc_html__( 'Set link around icon and title', 'cocco-core' )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'target',
								'heading'    => esc_html__( 'Target', 'cocco-core' ),
								'value'      => array_flip( cocco_mikado_get_link_target_array() ),
								'dependency' => array( 'element' => 'link', 'not_empty' => true ),
							),
							array(
								'type'        => 'textfield',
								'param_name'  => 'text_padding',
								'heading'     => esc_html__( 'Text Padding (px)', 'cocco-core' ),
								'description' => esc_html__( 'Set left or top padding dependence of type for your text holder. Default value is 13 for left type and 25 for top icon with text type', 'cocco-core' ),
								'dependency'  => array( 'element' => 'type', 'value'   => array( 'icon-left', 'icon-top' ) ),
								'group'       => esc_html__( 'Text Settings', 'cocco-core' )
							)
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'custom_class'                => '',
			'type'                        => 'icon-left',
			'custom_icon'                 => '',
			'custom_hover_icon'			  => '',
			'icon_type'                   => 'mkdf-normal',
			'icon_size'                   => 'mkdf-icon-medium',
			'custom_icon_size'            => '',
			'shape_size'                  => '',
			'icon_color'                  => '',
			'icon_background_color'       => '',
			'icon_border_color'           => '',
			'icon_border_width'           => '',
			'icon_switch'                 => '',
			'icon_animation'              => '',
			'icon_animation_delay'        => '',
			'title'                       => '',
			'title_tag'                   => 'h4',
			'title_color'                 => '',
			'title_top_margin'            => '',
			'text'                        => '',
			'text_color'                  => '',
			'text_top_margin'             => '',
			'link'                        => '',
			'target'                      => '_self',
			'text_padding'                => ''
		);
		$default_atts = array_merge( $default_atts, cocco_mikado_icon_collections()->getShortcodeParams() );
		$params       = shortcode_atts( $default_atts, $atts );
		
		$params['type'] = ! empty( $params['type'] ) ? $params['type'] : $default_atts['type'];
		
		$params['icon_parameters'] = $this->getIconParameters( $params );
		$params['custom_icon_style'] = $this->getCustomIconStyle( $params );
		$params['custom_icon_bckg_style'] = $this->getCustomIconBackgroundStyle( $params );
		$params['holder_classes']  = $this->getHolderClasses( $params );
		$params['content_styles']  = $this->getContentStyles( $params );
		$params['title_styles']    = $this->getTitleStyles( $params );
		$params['title_tag']       = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $default_atts['title_tag'];
		$params['text_styles']     = $this->getTextStyles( $params );
		$params['target']          = ! empty( $params['target'] ) ? $params['target'] : $default_atts['target'];

		return cocco_core_get_shortcode_module_template_part( 'templates/iwt', 'icon-with-text', $params['type'], $params );
	}
	
	private function getIconParameters( $params ) {
		$params_array = array();
		
		if ( empty( $params['custom_icon'] ) ) {
			$iconPackName = cocco_mikado_icon_collections()->getIconCollectionParamNameByKey( $params['icon_pack'] );
			
			$params_array['icon_pack']     = $params['icon_pack'];
			$params_array[ $iconPackName ] = $params[ $iconPackName ];
			
			if ( ! empty( $params['icon_size'] ) ) {
				$params_array['size'] = $params['icon_size'];
			}
			
			if ( ! empty( $params['custom_icon_size'] ) ) {
				$params_array['custom_size'] = cocco_mikado_filter_px( $params['custom_icon_size'] ) . 'px';
			}
			
			if ( ! empty( $params['icon_type'] ) ) {
				$params_array['type'] = $params['icon_type'];
			}
			
			if ( ! empty( $params['shape_size'] ) ) {
				$params_array['shape_size'] = cocco_mikado_filter_px( $params['shape_size'] ) . 'px';
			}
			
			if ( ! empty( $params['icon_border_color'] ) ) {
				$params_array['border_color'] = $params['icon_border_color'];
			}
			
			if ( $params['icon_border_width'] !== '' ) {
				$params_array['border_width'] = cocco_mikado_filter_px( $params['icon_border_width'] ) . 'px';
			}
			
			if ( ! empty( $params['icon_background_color'] ) ) {
				$params_array['background_color'] = $params['icon_background_color'];
			}
			
			$params_array['icon_color'] = $params['icon_color'];
			
			$params_array['icon_switch']          = $params['icon_switch'];
			$params_array['icon_animation']       = $params['icon_animation'];
			$params_array['icon_animation_delay'] = $params['icon_animation_delay'];
		}
		
		return $params_array;
	}

	private function getCustomIconStyle( $params ) {
		$style = array();

		if ( !empty( $params['custom_icon'] ) ) {
			if ((isset($params['icon_animation']) && $params['icon_animation'] == 'yes') && (isset($params['icon_animation_delay']) && $params['icon_animation_delay'] !== '')) {
				$style[] = '-webkit-transition-delay: ' . $params['icon_animation_delay'] . 'ms';
				$style[] = '-moz-transition-delay: ' . $params['icon_animation_delay'] . 'ms';
				$style[] = 'transition-delay: ' . $params['icon_animation_delay'] . 'ms';
			}
		}

		return implode(';', $style);
	}

	private function getCustomIconBackgroundStyle( $params ) {
		$style = array();

		if ( !empty( $params['custom_icon'] ) ) {

			if ( ! empty( $params['icon_type'] ) ) {

				if ( ! empty( $params['shape_size'] ) ) {
					$style[] = 'width:' .cocco_mikado_filter_px( $params['shape_size'] ) . 'px';
					$style[] = 'height:' .cocco_mikado_filter_px( $params['shape_size'] ) . 'px';
				}

				if ( ! empty( $params['icon_border_color'] ) ) {
					$style[] = 'border-color:'.$params['icon_border_color'];
					$style[] = 'border-style: solid';
				}

				if ( $params['icon_border_width'] !== '' ) {
					$style[] = 'border-width:'.cocco_mikado_filter_px( $params['icon_border_width'] ) . 'px';
				}

				if ( ! empty( $params['icon_background_color'] ) ) {
					$style[] = 'background-color:'.$params['icon_background_color'];
				}
			}
		}

		return implode(';', $style);
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array( 'mkdf-iwt', 'clearfix' );
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['type'] ) ? 'mkdf-iwt-' . $params['type'] : '';
		$holderClasses[] = ! empty( $params['icon_size'] ) ? 'mkdf-iwt-' . str_replace( 'mkdf-', '', $params['icon_size'] ) : '';
		$holderClasses[] = ! empty( $params['custom_hover_icon'] ) ? 'mkdf-iwt-has-hover-icon' : '';

		if ( ! empty($params['custom_icon']) ) {
			if ( ! empty($params['icon_type']) ) {
				$holderClasses[] = 'mkdf-custom-icon-' . esc_attr($params['icon_type']);
			}

			if ( ! empty($params['icon_animation']) ) {
				$holderClasses[] = 'mkdf-custom-icon-animated';
			}
		}
		
		return $holderClasses;
	}
	
	private function getContentStyles( $params ) {
		$styles = array();
		
		if ( $params['text_padding'] !== '' && $params['type'] === 'icon-left' ) {
			$styles[] = 'padding-left: ' . cocco_mikado_filter_px( $params['text_padding'] ) . 'px';
		}
		
		if ( $params['text_padding'] !== '' && $params['type'] === 'icon-top' ) {
			$styles[] = 'padding-top: ' . cocco_mikado_filter_px( $params['text_padding'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
	
	private function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}
		
		if ( $params['title_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . cocco_mikado_filter_px( $params['title_top_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
	
	private function getTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}
		
		if ( $params['text_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . cocco_mikado_filter_px( $params['text_top_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
}