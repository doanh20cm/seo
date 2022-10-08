<?php
namespace CoccoCore\CPT\Shortcodes\WorkingHours;

use CoccoCore\Lib;

class WorkingHours implements Lib\ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'mkdf_working_hours';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
        if ( function_exists( 'vc_map' ) ) {
            vc_map(array(
                'name' => esc_html__('Mikado Working Hours', 'cocco-core'),
                'base' => $this->base,
                'category' => esc_html__('by COCCO', 'cocco-core'),
                'icon' => 'icon-wpb-working-hours extended-custom-icon',
                'show_settings_on_create' => true,
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Custom Class', 'cocco-core'),
                        'param_name' => 'custom_class'
                    ),

                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Title', 'cocco-core'),
                        'param_name' => 'title',
                        'admin_label' => true,
                        'value' => '',
                        'save_always' => true
                    ),

                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Text', 'cocco-core'),
                        'param_name' => 'text',
                        'value' => '',
                        'save_always' => true
                    ),

                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Monday Working Hours', 'cocco-core'),
                        'param_name' => 'wh_monday_from_to',
                        'value' => '',
                        'save_always' => true
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Tuesday Working Hours', 'cocco-core'),
                        'param_name' => 'wh_tuesday_from_to',
                        'value' => '',
                        'save_always' => true
                    ),

                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Wednesday Working Hours', 'cocco-core'),
                        'param_name' => 'wh_wednesday_from_to',
                        'value' => '',
                        'save_always' => true
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Thursday Working Hours', 'cocco-core'),
                        'param_name' => 'wh_thursday_from_to',
                        'value' => '',
                        'save_always' => true
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Friday Working Hours', 'cocco-core'),
                        'param_name' => 'wh_friday_from_to',
                        'value' => '',
                        'save_always' => true
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Saturday Working Hours', 'cocco-core'),
                        'param_name' => 'wh_saturday_from_to',
                        'value' => '',
                        'save_always' => true
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Sunday Working Hours', 'cocco-core'),
                        'param_name' => 'wh_sunday_from_to',
                        'value' => '',
                        'save_always' => true
                    ),
                    array(
                        'type'        => 'textfield',
                        'param_name'  => 'button_text',
                        'heading'     => esc_html__( 'Button Text', 'cocco-core' ),
                        'value'       => esc_html__( 'Contact Us', 'cocco-core' ),
                        'save_always' => true
                    ),
                    array(
                        'type'       => 'textfield',
                        'param_name' => 'link',
                        'heading'    => esc_html__( 'Button Link', 'cocco-core' ),
                        'dependency' => array( 'element' => 'button_text', 'not_empty' => true )
                    ),

                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'content_background_color',
                        'heading'    => esc_html__( 'Content Background Color', 'cocco-core' ),
                        'group'       => esc_html__( 'Design Options', 'cocco-core' )
                    ),

                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'content_border_color',
                        'heading'    => esc_html__( 'Content Border Color', 'cocco-core' ),
                        'group'       => esc_html__( 'Design Options', 'cocco-core' )
                    ),

                    array(
                        'type'        => 'dropdown',
                        'param_name'  => 'skin',
                        'heading'     => esc_html__( 'Working Hours Content Skin', 'cocco-core' ),
                        'value'       => array(
                            esc_html__( 'Default', 'cocco-core' ) => '',
                            esc_html__( 'Light', 'cocco-core' )   => 'light',
                        ),
                        'group'       => esc_html__( 'Design Options', 'cocco-core' ),
                        'save_always' => true
                    )
                )
            ));
        }
	}

	public function render($atts, $content = null) {
		$default_atts = array(
		    'custom_class'      => '',
			'title'             => '',
            'text'              => '',
            'wh_monday_from_to'    => '',
            'wh_tuesday_from_to'    => '',
            'wh_wednesday_from_to'    => '',
            'wh_thursday_from_to'    => '',
            'wh_friday_from_to'    => '',
            'wh_saturday_from_to'    => '',
            'wh_sunday_from_to'    => '',
            'button_text'              => '',
            'link'                     => '',
            'content_background_color'  => '',
            'content_border_color'      => '',
            'skin'                      => ''
		);

		$params = shortcode_atts($default_atts, $atts);

		$params['working_hours']  = $this->getWorkingHours($params);
		$params['content_style']  = $this->getContentStyles($params);
		$params['holder_classes'] = $this->getHolderClasses($params);

        $html = cocco_core_get_shortcode_module_template_part('templates/working-hours-template', 'working-hours', '', $params);

        return $html;
	}

	private function getWorkingHours($params) {
		$workingHours = array();

			if(!empty($params['wh_monday_from_to'])) {
				$workingHours['monday']['label'] = __('Monday', 'cocco-core');
				$workingHours['monday']['from_to']  = $params['wh_monday_from_to'];
			}

            if(!empty($params['wh_tuesday_from_to'])) {
                $workingHours['tuesday']['label'] = __('Tuesday', 'cocco-core');
                $workingHours['tuesday']['from_to']  = $params['wh_tuesday_from_to'];
            }

            if(!empty($params['wh_wednesday_from_to'])) {
                $workingHours['wednesday']['label'] = __('Wednesday', 'cocco-core');
                $workingHours['wednesday']['from_to']  = $params['wh_wednesday_from_to'];
            }

            if(!empty($params['wh_thursday_from_to'])) {
                $workingHours['thursday']['label'] = __('Thursday', 'cocco-core');
                $workingHours['thursday']['from_to']  = $params['wh_thursday_from_to'];
            }

            if(!empty($params['wh_friday_from_to'])) {
                $workingHours['friday']['label'] = __('Friday', 'cocco-core');
                $workingHours['friday']['from_to']  = $params['wh_friday_from_to'];
            }

            if(!empty($params['wh_saturday_from_to'])) {
                $workingHours['saturday']['label'] = __('Saturday', 'cocco-core');
                $workingHours['saturday']['from_to']  = $params['wh_saturday_from_to'];
            }
            if(!empty($params['wh_sunday_from_to'])) {
                $workingHours['sunday']['label'] = __('Sunday', 'cocco-core');
                $workingHours['sunday']['from_to']  = $params['wh_sunday_from_to'];
            }
		return $workingHours;
	}

	private function getContentStyles($params){
	    $styles = array();

	    if(!empty($params['content_background_color'])){
	        $styles[] = 'background-color: '.$params['content_background_color'];
        }
        if(!empty($params['content_border_color'])){
	        $styles[] = 'border-color: '.$params['content_border_color'];
        }

        return implode("; ", $styles);
    }

    private function getHolderClasses($params){
	    $holder_classes = array();

	    if(!empty($params['custom_class'])){
	        $holder_classes[] = $params['custom_class'];
        }

	    if($params['skin'] == 'light'){
	        $holder_classes[] = 'mkdf-working-hours-holder-' . $params['skin'];
        }

        return implode( ' ', $holder_classes );
    }

}
