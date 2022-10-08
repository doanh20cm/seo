<?php
namespace CoccoCore\CPT\Shortcodes\PricingPlan;

use CoccoCore\Lib;

class PricingPlanItem implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkdf_pricing_plan_item';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Mikado Pricing Plan Item', 'cocco-core' ),
					'base'                      => $this->base,
					'icon'                      => 'icon-wpb-pricing-plan-item extended-custom-icon',
					'category'                  => esc_html__( 'by COCCO', 'cocco-core' ),
					'allowed_container_element' => 'vc_row',
					'as_child'                  => array( 'only' => 'mkdf_pricing_plan' ),
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'cocco-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'cocco-core' )
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
                            'type'       => 'textfield',
                            'param_name' => 'pricing_plan_text',
                            'heading'    => esc_html__( 'Pricing plan text', 'cocco-core' ),
                            'value'      => ''
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'pricing_plan_text_color',
                            'heading'    => esc_html__( 'Pricing Plan Text Color', 'cocco-core' ),
                            'dependency' => array( 'element' => 'pricing_plan_text', 'not_empty' => true ),
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
                            'param_name'  => 'button_text',
                            'heading'     => esc_html__( 'Button Text', 'cocco-core' ),
                            'value'       => esc_html__( 'BUY NOW', 'cocco-core' ),
                            'save_always' => true
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'button_text_color',
                            'heading'    => esc_html__( 'Button Text Color', 'cocco-core' ),
                            'dependency' => array( 'element' => 'button_text', 'not_empty' => true ),
                            'group'      => esc_html__( 'Design Options', 'cocco-core' )
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'button_text_hover_color',
                            'heading'    => esc_html__( 'Button Text Hover Color', 'cocco-core' ),
                            'dependency' => array( 'element' => 'button_text', 'not_empty' => true ),
                            'group'      => esc_html__( 'Design Options', 'cocco-core' )
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'link',
                            'heading'    => esc_html__( 'Button Link', 'cocco-core' ),
                            'dependency' => array( 'element' => 'button_text', 'not_empty' => true )
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
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'             => '',
			'content_background_color' => '',
			'price'                    => '100',
			'price_color'              => '',
			'currency'                 => '$',
			'currency_color'           => '',
			'price_period'             => 'monthly',
			'price_period_color'       => '',
			'pricing_plan_text'        => '',
			'pricing_plan_text_color'  => '',
			'button_text'              => '',
			'button_text_color'        => '',
            'button_text_hover_color'  => '',
			'link'                     => ''
		);
		$params = shortcode_atts( $args, $atts );

		$params['holder_classes']      = $this->getHolderClasses( $params );
		$params['holder_styles']       = $this->getHolderStyles( $params );
		$params['price_styles']        = $this->getPriceStyles( $params );
		$params['currency_styles']     = $this->getCurrencyStyles( $params );
		$params['text_styles']         = $this->getTextStyles( $params );
		$params['price_period_styles'] = $this->getPricePeriodStyles( $params );
        $params['button_text_styles'] = $this->getButtonTextStyles( $params );
		
		$html = cocco_core_get_shortcode_module_template_part( 'templates/pricing-plan-template', 'pricing-plan', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getHolderStyles( $params ) {
		$itemStyle = array();
		
		if ( ! empty( $params['content_background_color'] ) ) {
			$itemStyle[] = 'background-color: ' . $params['content_background_color'];
		}
		
		return implode( ';', $itemStyle );
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

    private function getTextStyles( $params ) {
        $itemStyle = array();

        if ( ! empty( $params['pricing_plan_text_color'] ) ) {
            $itemStyle[] = 'color: ' . $params['pricing_plan_text_color'];
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

    private function getButtonTextStyles( $params ) {
        $itemStyle = array();

        if ( ! empty( $params['button_text_color'] ) ) {
            $itemStyle[] = 'color: ' . $params['button_text_color'];
        }

        if ( ! empty( $params['button_text_hover_color'] ) ) {
            $itemStyle[] = 'color: ' . $params['button_text_hover_color'];
        }

        return implode( ';', $itemStyle );
    }
}
