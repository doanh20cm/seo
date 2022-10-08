<?php
namespace CoccoCore\CPT\Shortcodes\Separator;

use CoccoCore\Lib;

class Separator implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkdf_separator';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Mikado Separator', 'cocco-core' ),
					'base'                    => $this->base,
					'category'                => esc_html__( 'by COCCO', 'cocco-core' ),
					'icon'                    => 'icon-wpb-separator extended-custom-icon',
					'show_settings_on_create' => true,
					'class'                   => 'wpb_vc_separator',
					'custom_markup'           => '<div></div>',
					'params'                  => array_merge(
						array(
							array(
								'type'        => 'textfield',
								'param_name'  => 'custom_class',
								'heading'     => esc_html__( 'Custom CSS Class', 'cocco-core' ),
								'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'cocco-core' )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'type',
								'heading'    => esc_html__( 'Type', 'cocco-core' ),
								'value'      => array(
									esc_html__( 'Normal', 'cocco-core' )     => 'normal',
									esc_html__( 'Full Width', 'cocco-core' ) => 'full-width'
								)
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'position',
								'heading'    => esc_html__( 'Position', 'cocco-core' ),
								'value'      => array(
									esc_html__( 'Center', 'cocco-core' ) => 'center',
									esc_html__( 'Left', 'cocco-core' )   => 'left',
									esc_html__( 'Right', 'cocco-core' )  => 'right'
								),
								'dependency' => array( 'element' => 'type', 'value' => array( 'normal' ) )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'enable_icon',
								'heading'    => esc_html__( 'Enable Icon', 'cocco-core' ),
								'value'      => array(
									esc_html__( 'None', 'cocco-core' )     => 'no',
									esc_html__( 'Icon from Icon Pack', 'cocco-core' ) => 'icon-pack',
									esc_html__( 'Custom Icon', 'cocco-core' ) => 'custom-icon',
								),
								'dependency' => array( 'element' => 'type', 'value' => array( 'normal' ) )
							),
						),
						cocco_mikado_icon_collections()->getVCParamsArray(array('element' => 'enable_icon', 'value' => 'icon-pack'), '', true),
						array(
							array(
								'type'       => 'textfield',
								'param_name' => 'icon_size',
								'heading'    => esc_html__( 'Icon Size (px)', 'cocco-core' ),
								'dependency' => array( 'element' => 'enable_icon', 'value' => array( 'icon-pack' ) )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_color',
								'heading'    => esc_html__( 'Icon Color', 'cocco-core' ),
								'dependency' => array( 'element' => 'enable_icon', 'value' => array( 'icon-pack' ) )
							),
							array(
								'type'       => 'attach_image',
								'param_name' => 'custom_icon',
								'heading'    => esc_html__( 'Icon', 'cocco-core' ),
								'dependency' => array( 'element' => 'enable_icon', 'value' => array( 'custom-icon' ) )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'icon_position',
								'heading'    => esc_html__( 'Icon Position', 'cocco-core' ),
								'value'      => array(
									esc_html__( 'Center', 'cocco-core' ) => 'center',
									esc_html__( 'Left', 'cocco-core' )   => 'left',
									esc_html__( 'Right', 'cocco-core' )  => 'right'
								),
								'dependency' => array( 'element' => 'enable_icon', 'value' => array( 'icon-pack','custom-icon' ) )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'icon_margin',
								'heading'    => esc_html__( 'Icon Left/Right Margin (px)', 'cocco-core' ),
								'dependency' => array( 'element' => 'enable_icon', 'value' => array( 'icon-pack', 'custom-icon' ) )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'color',
								'heading'    => esc_html__( 'Color', 'cocco-core' )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'border_style',
								'heading'     => esc_html__( 'Style', 'cocco-core' ),
								'value'       => array(
									esc_html__( 'Default', 'cocco-core' ) => '',
									esc_html__( 'Dashed', 'cocco-core' )  => 'dashed',
									esc_html__( 'Solid', 'cocco-core' )   => 'solid',
									esc_html__( 'Dotted', 'cocco-core' )  => 'dotted'
								),
								'save_always' => true
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'width',
								'heading'    => esc_html__( 'Width (px or %)', 'cocco-core' ),
								'dependency' => array( 'element' => 'type', 'value' => array( 'normal' ) )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'thickness',
								'heading'    => esc_html__( 'Thickness (px)', 'cocco-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'top_margin',
								'heading'    => esc_html__( 'Top Margin (px or %)', 'cocco-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'bottom_margin',
								'heading'    => esc_html__( 'Bottom Margin (px or %)', 'cocco-core' )
							)
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'  => '',
			'type'          => '',
			'position'      => 'center',
			'enable_icon'	=> 'none',
			'custom_icon'	=> '',
			'icon_size'		=> '',
			'icon_color'	=> '',
			'icon_position' => 'center',
			'icon_margin'	=> '',
			'color'         => '',
			'border_style'  => '',
			'width'         => '',
			'thickness'     => '',
			'top_margin'    => '',
			'bottom_margin' => ''
		);
		$args = array_merge( $args, cocco_mikado_icon_collections()->getShortcodeParams() );
		$params       = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['holder_styles']  = $this->getHolderStyles( $params );
		$params['separator_styles']  = $this->getSeparatorStyles( $params );
		$params['icon_holder_style']  = $this->getIconHolderStyle( $params );
		$params['icon_html']  = $this->getIconHTML( $params );

		$html = cocco_core_get_shortcode_module_template_part( 'templates/separator-template', 'separator', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['position'] ) ? 'mkdf-separator-' . $params['position'] : '';
		$holderClasses[] = ! empty( $params['type'] ) ? 'mkdf-separator-' . $params['type'] : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getHolderStyles( $params ) {
		$styles = array();
		
		if ( $params['top_margin'] !== '' ) {
			if ( cocco_mikado_string_ends_with( $params['top_margin'], '%' ) || cocco_mikado_string_ends_with( $params['top_margin'], 'px' ) ) {
				$styles[] = 'margin-top: ' . $params['top_margin'];
			} else {
				$styles[] = 'margin-top: ' . cocco_mikado_filter_px( $params['top_margin'] ) . 'px';
			}
		}
		
		if ( $params['bottom_margin'] !== '' ) {
			if ( cocco_mikado_string_ends_with( $params['bottom_margin'], '%' ) || cocco_mikado_string_ends_with( $params['bottom_margin'], 'px' ) ) {
				$styles[] = 'margin-bottom: ' . $params['bottom_margin'];
			} else {
				$styles[] = 'margin-bottom: ' . cocco_mikado_filter_px( $params['bottom_margin'] ) . 'px';
			}
		}
		
		return implode( ';', $styles );
	}

	private function getSeparatorStyles( $params ) {
		$styles = array();
		
		if ( $params['color'] !== '' ) {
			$styles[] = 'border-color: ' . $params['color'];
		}
		
		if ( $params['border_style'] !== '' ) {
			$styles[] = 'border-style: ' . $params['border_style'];
		}
		
		if ( $params['width'] !== '' ) {
			$width_suffix = 'px';

			if ( cocco_mikado_string_ends_with( $params['width'], '%' ) ) {
				$width_suffix = '%';
			}

			if ( $params['enable_icon'] !== 'none' && $params['icon_position'] == 'center') {
				$width = intval($params['width'])/2;
			} else {
				$width = intval($params['width']);
			}

			$styles[] = 'width: ' . $width . $width_suffix;
		}
		
		if ( $params['thickness'] !== '' ) {
			$styles[] = 'border-bottom-width: ' . cocco_mikado_filter_px( $params['thickness'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}

	private function getIconHolderStyle( $params ) {
		$holder_style = array();

		if ($params['icon_margin'] !== '') {
			if ($params['icon_position'] == 'center') {
				$holder_style[] = 'margin: 0 '.cocco_mikado_filter_px($params['icon_margin']).'px';
			} elseif ($params['icon_position'] == 'left') {
				$holder_style[] = 'margin-right: '.cocco_mikado_filter_px($params['icon_margin']).'px';
			} else {
				$holder_style[] = 'margin-left: '.cocco_mikado_filter_px($params['icon_margin']).'px';
			}
		}

		return implode('; ', $holder_style);
	}

	private function getIconHTML( $params ) {
		$icon = '';

		if ( $params['enable_icon'] == 'custom-icon' && $params['custom_icon'] !== '' ) {

			$icon = wp_get_attachment_image($params['custom_icon'],'full');

		} elseif ( $params['enable_icon'] == 'icon-pack' ) {

			$iconPackName = cocco_mikado_icon_collections()->getIconCollectionParamNameByKey( $params['icon_pack'] );
			
			$icon_parameters['icon_pack']     = $params['icon_pack'];
			$icon_parameters[ $iconPackName ] = $params[ $iconPackName ];
			
			if ( $params['icon_size'] !== '' ) {
				$icon_parameters['custom_size'] = cocco_mikado_filter_px( $params['icon_size'] ) . 'px';
			}

			if ( $params['icon_color'] !== '' ) {
				$icon_parameters['icon_color'] = $params['icon_color'];
			}
			
			$icon = cocco_mikado_execute_shortcode('mkdf_icon', $icon_parameters);
		}
		
		return $icon;
	}
}
