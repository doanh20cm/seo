<?php
namespace CoccoCore\CPT\Shortcodes\PricingTable;

use CoccoCore\Lib;

class PricingTableItem implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkdf_pricing_table_item';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Mikado Pricing Table Item', 'cocco-core' ),
					'base'                      => $this->base,
					'icon'                      => 'icon-wpb-pricing-table-item extended-custom-icon',
					'category'                  => esc_html__( 'by COCCO', 'cocco-core' ),
					'allowed_container_element' => 'vc_row',
					'as_child'                  => array( 'only' => 'mkdf_pricing_table' ),
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'cocco-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'cocco-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'set_active_item',
							'heading'     => esc_html__( 'Set Item As Active', 'cocco-core' ),
							'value'       => array_flip( cocco_mikado_get_yes_no_select_array( false ) ),
							'save_always' => true
						),
						array(
							'type'			=> 'dropdown',
							'param_name'	=> 'top_content',
							'heading'		=> esc_html__('Choose Top Area Content','cocco-core'),
							'value'			=> array(
								esc_html__('Title','cocco-core') => 'title',
								esc_html__('Price','cocco-core') => 'price',
							)
						),
						array(
                            'type'        => 'attach_image',
                            'param_name'  => 'background_image',
                            'heading'     => esc_html__( 'Top Area Background Image', 'cocco-core' ),
                            'description' => esc_html__( 'Select image from media library', 'cocco-core' ),
							'group'      => esc_html__( 'Design Options', 'cocco-core' )
                        ),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'top_area_border_color',
							'heading'    => esc_html__( 'Top Area Bottom Border Color', 'cocco-core' ),
							'group'      => esc_html__( 'Design Options', 'cocco-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'content_background_color',
							'heading'    => esc_html__( 'Content Background Color', 'cocco-core' ),
							'group'      => esc_html__( 'Design Options', 'cocco-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title',
							'heading'     => esc_html__( 'Title', 'cocco-core' ),
							'value'       => esc_html__( 'Basic Plan', 'cocco-core' ),
							'save_always' => true
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'title_color',
							'heading'    => esc_html__( 'Title Color', 'cocco-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true ),
							'group'      => esc_html__( 'Design Options', 'cocco-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'price',
							'heading'    => esc_html__( 'Price', 'cocco-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'price_color',
							'heading'    => esc_html__( 'Price Color', 'cocco-core' ),
							'dependency' => array( 'element' => 'price', 'not_empty' => true ),
							'group'      => esc_html__( 'Design Options', 'cocco-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'currency',
							'heading'     => esc_html__( 'Currency', 'cocco-core' ),
							'description' => esc_html__( 'Default mark is $', 'cocco-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'currency_color',
							'heading'    => esc_html__( 'Currency Color', 'cocco-core' ),
							'dependency' => array( 'element' => 'currency', 'not_empty' => true ),
							'group'      => esc_html__( 'Design Options', 'cocco-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'price_period',
							'heading'     => esc_html__( 'Price Period', 'cocco-core' ),
							'description' => esc_html__( 'Default label is monthly', 'cocco-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'price_period_color',
							'heading'    => esc_html__( 'Price Period Color', 'cocco-core' ),
							'dependency' => array( 'element' => 'price_period', 'not_empty' => true ),
							'group'      => esc_html__( 'Design Options', 'cocco-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'button_text',
							'heading'     => esc_html__( 'Button Text', 'cocco-core' ),
							'value'       => esc_html__( 'BUY NOW', 'cocco-core' ),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'link',
							'heading'    => esc_html__( 'Button Link', 'cocco-core' ),
							'dependency' => array( 'element' => 'button_text', 'not_empty' => true )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'button_type',
							'heading'     => esc_html__( 'Button Type', 'cocco-core' ),
							'value'       => array(
								esc_html__( 'Solid', 'cocco-core' )   => 'solid',
								esc_html__( 'Outline', 'cocco-core' ) => 'outline'
							),
							'save_always' => true,
							'dependency'  => array( 'element' => 'button_text', 'not_empty' => true )
						),
						array(
							'type'       => 'textarea_html',
							'param_name' => 'content',
							'heading'    => esc_html__( 'Content', 'cocco-core' ),
							'value'      => '<li>content content content</li><li>content content content</li><li>content content content</li>'
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'             => '',
			'set_active_item'          => 'no',
			'top_content'			   => 'title',
			'background_image'         => '',
			'top_area_border_color'    => '',
			'content_background_color' => '',
			'title'                    => '',
			'title_color'              => '',
			'price'                    => '100',
			'price_color'              => '',
			'currency'                 => '$',
			'currency_color'           => '',
			'price_period'             => 'monthly',
			'price_period_color'       => '',
			'button_text'              => '',
			'link'                     => '',
			'button_type'              => 'outline'
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['content']             = preg_replace( '#^<\/p>|<p>$#', '', $content ); // delete p tag before and after content
		$params['holder_classes']      = $this->getHolderClasses( $params );
		$params['holder_styles']       = $this->getHolderStyles( $params );
		$params['title_styles']        = $this->getTitleStyles( $params );
        $params['top_area_style']      = $this->getTopAreaStyle( $params );
		$params['price_styles']        = $this->getPriceStyles( $params );
		$params['currency_styles']     = $this->getCurrencyStyles( $params );
		$params['price_period_styles'] = $this->getPricePeriodStyles( $params );
		$params['button_type']         = ! empty( $params['button_type'] ) ? $params['button_type'] : $args['button_type'];
		
		$html = cocco_core_get_shortcode_module_template_part( 'templates/pricing-table-template', 'pricing-table', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = $params['set_active_item'] === 'yes' ? 'mkdf-pt-active-item' : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getHolderStyles( $params ) {
		$itemStyle = array();
		
		if ( ! empty( $params['content_background_color'] ) ) {
			$itemStyle[] = 'background-color: ' . $params['content_background_color'];
		}
		
		return implode( ';', $itemStyle );
	}
	
	private function getTitleStyles( $params ) {
		$itemStyle = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$itemStyle[] = 'color: ' . $params['title_color'];
		}
		
		return implode( ';', $itemStyle );
	}

    private function getTopAreaStyle( $params ) {
        $style = array();

        if ( ! empty( $params['background_image'] ) ) {
            $id = $params['background_image'];
            $image_original = wp_get_attachment_image_src( $id, 'full' );
            $style[] = "background-image: url('".$image_original[0]."')";
        }
		
		if ( ! empty( $params['top_area_border_color'] ) ) {
			$style[] = 'border-bottom: 1px solid ' . $params['top_area_border_color'];
		}

        return implode(';', $style);
    }

	private function getPriceStyles( $params ) {
		$itemStyle = array();
		
		if ( ! empty( $params['price_color'] ) ) {
			$itemStyle[] = 'color: ' . $params['price_color'];
		}
		
		return implode( ';', $itemStyle );
	}
	
	private function getCurrencyStyles( $params ) {
		$itemStyle = array();
		
		if ( ! empty( $params['currency_color'] ) ) {
			$itemStyle[] = 'color: ' . $params['currency_color'];
		}
		
		return implode( ';', $itemStyle );
	}
	
	private function getPricePeriodStyles( $params ) {
		$itemStyle = array();
		
		if ( ! empty( $params['price_period_color'] ) ) {
			$itemStyle[] = 'color: ' . $params['price_period_color'];
		}
		
		return implode( ';', $itemStyle );
	}
}