<?php
namespace CoccoCore\CPT\Shortcodes\Button;

use CoccoCore\Lib;

class Button implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'mkdf_button';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Mikado Button', 'cocco-core' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by COCCO', 'cocco-core' ),
					'icon'                      => 'icon-wpb-button extended-custom-icon',
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
									esc_html__( 'Solid', 'cocco-core' )   => 'solid',
									esc_html__( 'Simple', 'cocco-core' )  => 'simple'
								),
								'admin_label' => true
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'size',
								'heading'    => esc_html__( 'Size', 'cocco-core' ),
								'value'      => array(
									esc_html__( 'Default', 'cocco-core' ) => '',
									esc_html__( 'Small', 'cocco-core' )   => 'small',
									esc_html__( 'Medium', 'cocco-core' )  => 'medium',
									esc_html__( 'Large', 'cocco-core' )   => 'large',
									esc_html__( 'Huge', 'cocco-core' )    => 'huge'
								),
								'dependency' => array( 'element' => 'type', 'value' => array( 'solid' ) )
							),
							array(
								'type'        => 'textfield',
								'param_name'  => 'text',
								'heading'     => esc_html__( 'Text', 'cocco-core' ),
								'value'       => esc_html__( 'Button Text', 'cocco-core' ),
								'save_always' => true,
								'admin_label' => true
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'link',
								'heading'    => esc_html__( 'Link', 'cocco-core' )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'target',
								'heading'     => esc_html__( 'Link Target', 'cocco-core' ),
								'value'       => array_flip( cocco_mikado_get_link_target_array() ),
								'save_always' => true
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'enable_icon',
								'heading'     => esc_html__( 'Enable Icon', 'cocco-core' ),
								'value'       => array(
									esc_html__('None','cocco-core') => 'none',
									esc_html__('Icon from Icon Pack','cocco-core') => 'icon_pack'
								),
                                'dependency' => array( 'element' => 'type', 'value' => array( 'solid' ) )
							)
						),
						cocco_mikado_icon_collections()->getVCParamsArray( array('element' => 'enable_icon', 'value' => 'icon_pack'), '', true ),
						array(
							array(
								'type'        => 'dropdown',
								'param_name'  => 'animate_icon',
								'heading'     => esc_html__( 'Animate Icon', 'cocco-core' ),
								'value'       => array(
									esc_html__('Default','cocco-core') => '',
									esc_html__('No','cocco-core') => 'no',
									esc_html__('Yes','cocco-core') => 'yes'
								),
								'dependency'  => array('element' => 'enable_icon', 'value' => 'icon_pack')
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'enable_underline',
								'heading'     => esc_html__( 'Enable Underline', 'cocco-core' ),
								'value'       => array(
									esc_html__('No','cocco-core') => 'no',
									esc_html__('Yes','cocco-core') => 'yes'
								),
								'dependency'  => array('element' => 'type', 'value' => 'simple')
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'color',
								'heading'    => esc_html__( 'Color', 'cocco-core' ),
								'group'      => esc_html__( 'Design Options', 'cocco-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'hover_color',
								'heading'    => esc_html__( 'Hover Color', 'cocco-core' ),
								'group'      => esc_html__( 'Design Options', 'cocco-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'background_color',
								'heading'    => esc_html__( 'Background Color', 'cocco-core' ),
								'dependency' => array( 'element' => 'type', 'value' => array( 'solid' ) ),
								'group'      => esc_html__( 'Design Options', 'cocco-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'hover_background_color',
								'heading'    => esc_html__( 'Hover Background Color', 'cocco-core' ),
								'dependency' => array( 'element' => 'type', 'value' => array( 'solid' ) ),
								'group'      => esc_html__( 'Design Options', 'cocco-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'border_color',
								'heading'    => esc_html__( 'Border Color', 'cocco-core' ),
								'dependency' => array( 'element' => 'type', 'value' => array( 'solid' ) ),
								'group'      => esc_html__( 'Design Options', 'cocco-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'hover_border_color',
								'heading'    => esc_html__( 'Hover Border Color', 'cocco-core' ),
								'dependency' => array( 'element' => 'type', 'value' => array( 'solid' ) ),
								'group'      => esc_html__( 'Design Options', 'cocco-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'font_size',
								'heading'    => esc_html__( 'Font Size (px)', 'cocco-core' ),
								'group'      => esc_html__( 'Design Options', 'cocco-core' )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'font_weight',
								'heading'     => esc_html__( 'Font Weight', 'cocco-core' ),
								'value'       => array_flip( cocco_mikado_get_font_weight_array( true ) ),
								'save_always' => true,
								'group'       => esc_html__( 'Design Options', 'cocco-core' )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'text_transform',
								'heading'     => esc_html__( 'Text Transform', 'cocco-core' ),
								'value'       => array_flip( cocco_mikado_get_text_transform_array( true ) ),
								'save_always' => true
							),
							array(
								'type'        => 'textfield',
								'param_name'  => 'margin',
								'heading'     => esc_html__( 'Margin', 'cocco-core' ),
								'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'cocco-core' ),
								'group'       => esc_html__( 'Design Options', 'cocco-core' )
							),
							array(
								'type'        => 'textfield',
								'param_name'  => 'padding',
								'heading'     => esc_html__( 'Button Padding', 'cocco-core' ),
								'description' => esc_html__( 'Insert padding in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'cocco-core' ),
								'dependency'  => array( 'element' => 'type', 'value' => array( 'solid' ) ),
								'group'       => esc_html__( 'Design Options', 'cocco-core' )
							)
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'size'                   => '',
			'type'                   => 'solid',
			'text'                   => '',
			'link'                   => '',
			'target'                 => '_self',
			'enable_icon'            => 'none',
			'animate_icon'			 => '',
			'enable_underline'		 => 'no',
			'color'                  => '',
			'hover_color'            => '',
			'background_color'       => '',
			'hover_background_color' => '',
			'border_color'           => '',
			'hover_border_color'     => '',
			'font_size'              => '',
			'font_weight'            => '',
			'text_transform'         => '',
			'margin'                 => '',
			'padding'                => '',
			'custom_class'           => '',
			'html_type'              => 'anchor',
			'input_name'             => '',
			'custom_attrs'           => array()
		);
		$default_atts = array_merge( $default_atts, cocco_mikado_icon_collections()->getShortcodeParams() );
		$params       = shortcode_atts( $default_atts, $atts );
		
		if ( $params['html_type'] !== 'input' ) {
			$iconPackName   = cocco_mikado_icon_collections()->getIconCollectionParamNameByKey( $params['icon_pack'] );
			$params['icon'] = $iconPackName ? $params[ $iconPackName ] : '';
		}

		if ( $params['animate_icon'] == '' && $params['icon'] !== ''){
			$params['animate_icon'] = 'yes';
		}
		
		$params['size'] = ! empty( $params['size'] ) ? $params['size'] : 'medium';
		$params['type'] = ! empty( $params['type'] ) ? $params['type'] : 'solid';
		
		$params['link']   = ! empty( $params['link'] ) ? $params['link'] : '#';
		$params['target'] = ! empty( $params['target'] ) ? $params['target'] : $default_atts['target'];
		
		$params['button_classes']      = $this->getButtonClasses( $params );
		$params['button_custom_attrs'] = ! empty( $params['custom_attrs'] ) ? $params['custom_attrs'] : array();
		$params['button_styles']       = $this->getButtonStyles( $params );
		$params['button_data']         = $this->getButtonDataAttr( $params );
		
		return cocco_core_get_shortcode_module_template_part( 'templates/' . $params['html_type'], 'button', '', $params );
	}
	
	private function getButtonStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['color'] ) ) {
			$styles[] = 'color: ' . $params['color'];
		}
		
		if ( ! empty( $params['background_color'] ) ) {
			$styles[] = 'background-color: ' . $params['background_color'];
		}
		
		if ( ! empty( $params['border_color'] ) ) {
			$styles[] = 'border-color: ' . $params['border_color'];
		}
		
		if ( ! empty( $params['font_size'] ) ) {
			$styles[] = 'font-size: ' . cocco_mikado_filter_px( $params['font_size'] ) . 'px';
		}
		
		if ( ! empty( $params['font_weight'] ) && $params['font_weight'] !== '' ) {
			$styles[] = 'font-weight: ' . $params['font_weight'];
		}
		
		if ( ! empty( $params['text_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['text_transform'];
		}
		
		if ( $params['margin'] !== '' ) {
			$styles[] = 'margin: ' . $params['margin'];
		}
		
		if ( $params['padding'] !== '' ) {
			$styles[] = 'padding: ' . $params['padding'];
		}
		
		return $styles;
	}
	
	private function getButtonDataAttr( $params ) {
		$data = array();
		
		if ( ! empty( $params['hover_color'] ) ) {
			$data['data-hover-color'] = $params['hover_color'];
		}
		
		if ( ! empty( $params['hover_background_color'] ) ) {
			$data['data-hover-bg-color'] = $params['hover_background_color'];
		}
		
		if ( ! empty( $params['hover_border_color'] ) ) {
			$data['data-hover-border-color'] = $params['hover_border_color'];
		}
		
		return $data;
	}
	
	private function getButtonClasses( $params ) {
		$buttonClasses = array(
			'mkdf-btn',
			'mkdf-btn-' . $params['size'],
			'mkdf-btn-' . $params['type']
		);
		
		if ( ! empty( $params['hover_background_color'] ) ) {
			$buttonClasses[] = 'mkdf-btn-custom-hover-bg';
		}
		
		if ( ! empty( $params['hover_border_color'] ) ) {
			$buttonClasses[] = 'mkdf-btn-custom-border-hover';
		}
		
		if ( ! empty( $params['hover_color'] ) ) {
			$buttonClasses[] = 'mkdf-btn-custom-hover-color';
		}
		
		if ( $params['enable_icon'] !== 'none' ) {
			$buttonClasses[] = 'mkdf-btn-icon';
		}

		if ( $params['animate_icon'] == 'yes' ) {
			$buttonClasses[] = 'mkdf-btn-icon-animate';
		}

		if ( $params['enable_underline'] == 'yes') {
			$buttonClasses[] = 'mkdf-btn-underline';
		}
		
		if ( ! empty( $params['custom_class'] ) ) {
			$buttonClasses[] = esc_attr( $params['custom_class'] );
		}
		
		return $buttonClasses;
	}
}