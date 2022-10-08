<?php

if ( class_exists( 'CoccoMikadoWidget' ) ) {
	class CoccoMikadoButtonWidget extends CoccoMikadoWidget {
		public function __construct() {
			parent::__construct(
				'mkdf_button_widget',
				esc_html__( 'Mikado Button Widget', 'cocco' ),
				array( 'description' => esc_html__( 'Add button element to widget areas', 'cocco' ) )
			);

			$this->setParams();
		}

		protected function setParams() {
			$this->params = array(
				array(
					'type'    => 'dropdown',
					'name'    => 'type',
					'title'   => esc_html__( 'Type', 'cocco' ),
					'options' => array(
						'solid'   => esc_html__( 'Solid', 'cocco' ),
						'outline' => esc_html__( 'Outline', 'cocco' ),
						'simple'  => esc_html__( 'Simple', 'cocco' )
					)
				),
				array(
					'type'        => 'dropdown',
					'name'        => 'size',
					'title'       => esc_html__( 'Size', 'cocco' ),
					'options'     => array(
						'small'  => esc_html__( 'Small', 'cocco' ),
						'medium' => esc_html__( 'Medium', 'cocco' ),
						'large'  => esc_html__( 'Large', 'cocco' ),
						'huge'   => esc_html__( 'Huge', 'cocco' )
					),
					'description' => esc_html__( 'This option is only available for solid and outline button type', 'cocco' )
				),
				array(
					'type'    => 'textfield',
					'name'    => 'text',
					'title'   => esc_html__( 'Text', 'cocco' ),
					'default' => esc_html__( 'Button Text', 'cocco' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'link',
					'title' => esc_html__( 'Link', 'cocco' )
				),
				array(
					'type'    => 'dropdown',
					'name'    => 'target',
					'title'   => esc_html__( 'Link Target', 'cocco' ),
					'options' => cocco_mikado_get_link_target_array()
				),
				array(
					'type'  => 'colorpicker',
					'name'  => 'color',
					'title' => esc_html__( 'Color', 'cocco' )
				),
				array(
					'type'  => 'colorpicker',
					'name'  => 'hover_color',
					'title' => esc_html__( 'Hover Color', 'cocco' )
				),
				array(
					'type'        => 'colorpicker',
					'name'        => 'background_color',
					'title'       => esc_html__( 'Background Color', 'cocco' ),
					'description' => esc_html__( 'This option is only available for solid button type', 'cocco' )
				),
				array(
					'type'        => 'colorpicker',
					'name'        => 'hover_background_color',
					'title'       => esc_html__( 'Hover Background Color', 'cocco' ),
					'description' => esc_html__( 'This option is only available for solid button type', 'cocco' )
				),
				array(
					'type'        => 'colorpicker',
					'name'        => 'border_color',
					'title'       => esc_html__( 'Border Color', 'cocco' ),
					'description' => esc_html__( 'This option is only available for solid and outline button type', 'cocco' )
				),
				array(
					'type'        => 'colorpicker',
					'name'        => 'hover_border_color',
					'title'       => esc_html__( 'Hover Border Color', 'cocco' ),
					'description' => esc_html__( 'This option is only available for solid and outline button type', 'cocco' )
				),
				array(
					'type'        => 'textfield',
					'name'        => 'margin',
					'title'       => esc_html__( 'Margin', 'cocco' ),
					'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'cocco' )
				)
			);
		}

		public function widget( $args, $instance ) {
			$params = '';

			if ( ! is_array( $instance ) ) {
				$instance = array();
			}

			// Filter out all empty params
			$instance = array_filter( $instance, function ( $array_value ) {
				return trim( $array_value ) != '';
			} );

			// Default values
			if ( ! isset( $instance['text'] ) ) {
				$instance['text'] = 'Button Text';
			}

			// Generate shortcode params
			foreach ( $instance as $key => $value ) {
				$params .= " $key='$value' ";
			}

			echo '<div class="widget mkdf-button-widget">';
			echo do_shortcode( "[mkdf_button $params]" ); // XSS OK
			echo '</div>';
		}
	}
}