<?php
namespace CoccoCore\CPT\Shortcodes\SectionTitle;

use CoccoCore\Lib;

class SectionTitle implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkdf_section_title';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Mikado Section Title', 'cocco-core' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by COCCO', 'cocco-core' ),
					'icon'                      => 'icon-wpb-section-title extended-custom-icon',
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
                            'heading'     => esc_html__( 'Section Title Type', 'lilo-core' ),
                            'value'       => array(
                                esc_html__( 'Default', 'lilo-core' ) => '',
                                esc_html__( 'Boxed', 'lilo-core' )    => 'mkdf-section-title-boxed'
                            ),
                            'save_always' => true
                        ),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'position',
							'heading'     => esc_html__( 'Horizontal Position', 'cocco-core' ),
							'value'       => array(
								esc_html__( 'Default', 'cocco-core' ) => '',
								esc_html__( 'Left', 'cocco-core' )    => 'left',
								esc_html__( 'Center', 'cocco-core' )  => 'center',
								esc_html__( 'Right', 'cocco-core' )   => 'right'
							),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'holder_padding',
							'heading'    => esc_html__( 'Holder Side Padding (px or %)', 'cocco-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title',
							'heading'     => esc_html__( 'Title', 'cocco-core' ),
							'admin_label' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'title_tag',
							'heading'     => esc_html__( 'Title Tag', 'cocco-core' ),
							'value'       => array_flip( cocco_mikado_get_title_tag( true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
							'group'       => esc_html__( 'Title Style', 'cocco-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'title_color',
							'heading'    => esc_html__( 'Title Color', 'cocco-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true ),
							'group'      => esc_html__( 'Title Style', 'cocco-core' )
						),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'title_background_color',
                            'heading'    => esc_html__( 'Title Background Color', 'cocco-core' ),
                            'dependency' => array( 'element' => 'title', 'not_empty' => true ),
                            'group'      => esc_html__( 'Title Style', 'cocco-core' )
                        ),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title_colored_words',
							'heading'     => esc_html__( 'Main Color Words', 'cocco-core' ),
							'description' => esc_html__( 'Enter the positions of the words you would like to display in main color. Separate the positions with commas (e.g. if you would like the first, second, and third word to be in main color, you would enter "1,2,3")', 'cocco-core' ),
							'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
							'group'       => esc_html__( 'Title Style', 'cocco-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title_break_words',
							'heading'     => esc_html__( 'Position of Line Break', 'cocco-core' ),
							'description' => esc_html__( 'Enter the position of the word after which you would like to create a line break (e.g. if you would like the line break after the 3rd word, you would enter "3")', 'cocco-core' ),
							'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
							'group'       => esc_html__( 'Title Style', 'cocco-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'disable_break_words',
							'heading'     => esc_html__( 'Disable Line Break for Smaller Screens', 'cocco-core' ),
							'value'       => array_flip( cocco_mikado_get_yes_no_select_array( false ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
							'group'       => esc_html__( 'Title Style', 'cocco-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'subtitle',
							'heading'    => esc_html__( 'Subtitle', 'cocco-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'subtitle_tag',
							'heading'     => esc_html__( 'Subtitle Tag', 'cocco-core' ),
							'value'       => array_flip( cocco_mikado_get_title_tag( true, array('span' => 'span') ) ),
							'dependency'  => array( 'element' => 'subtitle', 'not_empty' => true ),
							'group'       => esc_html__( 'Subtitle Style', 'cocco-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'subtitle_color',
							'heading'    => esc_html__( 'Subtitle Color', 'cocco-core' ),
							'dependency' => array( 'element' => 'subtitle', 'not_empty' => true ),
							'description'=> esc_html__('Default color is #fff', 'cocco-core'),
							'group'      => esc_html__( 'Subtitle Style', 'cocco-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'subtitle_background_color',
							'heading'    => esc_html__( 'Subtitle Background Color', 'cocco-core' ),
							'dependency' => array( 'element' => 'subtitle', 'not_empty' => true ),
							'description'=> esc_html__('Default color is main color', 'cocco-core'),
							'group'      => esc_html__( 'Subtitle Style', 'cocco-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'subtitle_border_radius',
							'heading'    => esc_html__( 'Subtitle Border Radius', 'cocco-core' ),
							'dependency' => array( 'element' => 'subtitle', 'not_empty' => true ),
							'description'=> esc_html__('Default value is 10px', 'cocco-core'),
							'group'      => esc_html__( 'Subtitle Style', 'cocco-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'subtitle_position',
							'heading'    => esc_html__( 'Subtitle Position', 'cocco-core' ),
							'dependency' => array( 'element' => 'subtitle', 'not_empty' => true ),
							'value'		 => array(
								esc_html__('Under Title','cocco-core') => 'under',
								esc_html__('Above Title','cocco-core') => 'above',
							),
							'group'      => esc_html__( 'Subtitle Style', 'cocco-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'subtitle_padding',
							'heading'    => esc_html__( 'Subtitle Padding', 'cocco-core' ),
							'dependency' => array( 'element' => 'subtitle', 'not_empty' => true ),
							'description'=> esc_html__('Enter padding in format (20px 10px 0px 10px). Default value is 0 15px','cocco-core'),
							'group'      => esc_html__( 'Subtitle Style', 'cocco-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'subtitle_margin',
							'heading'    => esc_html__( 'Subtitle Margin', 'cocco-core' ),
							'dependency' => array( 'element' => 'subtitle', 'not_empty' => true ),
							'description'=> esc_html__('Enter margin in format (20px 10px 0px 10px)','cocco-core'),
							'group'      => esc_html__( 'Subtitle Style', 'cocco-core' )
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
							'group'      => esc_html__( 'Text Style', 'cocco-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'text_font_size',
							'heading'    => esc_html__( 'Text Font Size (px)', 'cocco-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'group'      => esc_html__( 'Text Style', 'cocco-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'text_line_height',
							'heading'    => esc_html__( 'Text Line Height (px)', 'cocco-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'group'      => esc_html__( 'Text Style', 'cocco-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'text_font_weight',
							'heading'     => esc_html__( 'Text Font Weight', 'cocco-core' ),
							'value'       => array_flip( cocco_mikado_get_font_weight_array( true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'text', 'not_empty' => true ),
							'group'       => esc_html__( 'Text Style', 'cocco-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'text_margin',
							'heading'    => esc_html__( 'Text Top Margin (px)', 'cocco-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'group'      => esc_html__( 'Text Style', 'cocco-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'        => '',
			'type'                => '',
			'position'            => '',
			'holder_padding'      => '',
			'title'               => '',
			'title_tag'           => 'h1',
			'title_color'         => '',
            'title_background_color' => '',
			'title_colored_words'    => '',
			'title_break_words'   => '',
			'disable_break_words' => '',
			'subtitle'            => '',
			'subtitle_tag'        => 'h1',
			'subtitle_color'      => '',
			'subtitle_background_color' => '',
			'subtitle_border_radius'	=> '',
			'subtitle_position'   => 'under',
			'subtitle_padding'    => '',
			'subtitle_margin'     => '',
			'text'                => '',
			'text_color'          => '',
			'text_font_size'      => '',
			'text_line_height'    => '',
			'text_font_weight'    => '',
			'text_margin'         => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params, $args );
		$params['holder_styles']  = $this->getHolderStyles( $params );
		$params['title']          = $this->getModifiedTitle( $params );
		$params['title_tag']      = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		$params['title_styles']   = $this->getTitleStyles( $params );
		$params['subtitle_tag']   = ! empty( $params['subtitle_tag'] ) ? $params['subtitle_tag'] : $args['subtitle_tag'];
		$params['subtitle_styles']= $this->getSubtitleStyles( $params );
		$params['text_styles']    = $this->getTextStyles( $params );

		$html = cocco_core_get_shortcode_module_template_part( 'templates/section-title', 'section-title', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
        $holderClasses[] = ! empty( $params['type'] ) ? esc_attr( $params['type'] ) : '';
		$holderClasses[] = $params['disable_break_words'] === 'yes' ? 'mkdf-st-disable-title-break' : '';
		$holderClasses[] = $params['subtitle_position'] !== '' ? 'mkdf-st-subtitle-pos-'.$params['subtitle_position'] : 'mkdf-st-subtitle-pos-under';

		return implode( ' ', $holderClasses );
	}
	
	private function getHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['holder_padding'] ) ) {
			$styles[] = 'padding: 0 ' . $params['holder_padding'];
		}
		
		if ( ! empty( $params['position'] ) ) {
			$styles[] = 'text-align: ' . $params['position'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getModifiedTitle( $params ) {
		$title             = $params['title'];
		$title_colored_words  = str_replace( ' ', '', $params['title_colored_words'] );
		$title_break_words = str_replace( ' ', '', $params['title_break_words'] );
		
		if ( ! empty( $title ) ) {
			$colored_words  = explode( ',', $title_colored_words );
			$split_title = explode( ' ', $title );
			
			if ( ! empty( $title_colored_words ) ) {
				foreach ( $colored_words as $value ) {
					if ( ! empty( $split_title[ $value - 1 ] ) ) {
						$split_title[ $value - 1 ] = '<span class="mkdf-st-title-colored">' . $split_title[ $value - 1 ] . '</span>';
					}
				}
			}
			
			if ( ! empty( $title_break_words ) ) {
				$title_break_words = intval( $title_break_words );
				if ( ! empty( $split_title[ $title_break_words - 1 ] ) ) {
					$split_title[ $title_break_words - 1 ] = $split_title[ $title_break_words - 1 ] . '<br />';
				}
			}
			
			$title = implode( ' ', $split_title );
		}
		
		return $title;
	}
	
	private function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}

        if ( ! empty( $params['title_background_color'] ) ) {
            $styles[] = 'background-color: ' . $params['title_background_color'];
        }
		
		return implode( ';', $styles );
	}

	private function getSubtitleStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['subtitle_color'] ) ) {
			$styles[] = 'color: ' . $params['subtitle_color'];
		}

		if ( ! empty( $params['subtitle_background_color'] ) ) {
			$styles[] = 'background-color: ' . $params['subtitle_background_color'];
		}

		if ( ! empty( $params['subtitle_border_radius'] ) ) {
			$styles[] = 'border-radius: ' . $params['subtitle_border_radius'];
		}

		if ( ! empty( $params['subtitle_padding'] ) ) {
			$styles[] = 'padding: ' . $params['subtitle_padding'];
		}

		if ( ! empty( $params['subtitle_margin'] ) ) {
			$styles[] = 'margin: ' . $params['subtitle_margin'];
		}

		return implode( ';', $styles );
	}
	
	private function getTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}
		
		if ( ! empty( $params['text_font_size'] ) ) {
			$styles[] = 'font-size: ' . cocco_mikado_filter_px( $params['text_font_size'] ) . 'px';
		}
		
		if ( ! empty( $params['text_line_height'] ) ) {
			$styles[] = 'line-height: ' . cocco_mikado_filter_px( $params['text_line_height'] ) . 'px';
		}
		
		if ( ! empty( $params['text_font_weight'] ) ) {
			$styles[] = 'font-weight: ' . $params['text_font_weight'];
		}
		
		if ( $params['text_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . cocco_mikado_filter_px( $params['text_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
}