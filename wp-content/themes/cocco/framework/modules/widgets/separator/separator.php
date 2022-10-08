<?php

if ( class_exists( 'CoccoMikadoWidget' ) ) {
	class CoccoMikadoSeparatorWidget extends CoccoMikadoWidget {
		public function __construct() {
			parent::__construct(
				'mkdf_separator_widget',
				esc_html__( 'Mikado Separator Widget', 'cocco' ),
				array( 'description' => esc_html__( 'Add a separator element to your widget areas', 'cocco' ) )
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
						'normal'     => esc_html__( 'Normal', 'cocco' ),
						'full-width' => esc_html__( 'Full Width', 'cocco' )
					)
				),
				array(
					'type'    => 'dropdown',
					'name'    => 'position',
					'title'   => esc_html__( 'Position', 'cocco' ),
					'options' => array(
						'center' => esc_html__( 'Center', 'cocco' ),
						'left'   => esc_html__( 'Left', 'cocco' ),
						'right'  => esc_html__( 'Right', 'cocco' )
					)
				),
				array(
					'type'    => 'dropdown',
					'name'    => 'border_style',
					'title'   => esc_html__( 'Style', 'cocco' ),
					'options' => array(
						'solid'  => esc_html__( 'Solid', 'cocco' ),
						'dashed' => esc_html__( 'Dashed', 'cocco' ),
						'dotted' => esc_html__( 'Dotted', 'cocco' )
					)
				),
				array(
					'type'  => 'colorpicker',
					'name'  => 'color',
					'title' => esc_html__( 'Color', 'cocco' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'width',
					'title' => esc_html__( 'Width (px or %)', 'cocco' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'thickness',
					'title' => esc_html__( 'Thickness (px)', 'cocco' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'top_margin',
					'title' => esc_html__( 'Top Margin (px or %)', 'cocco' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'bottom_margin',
					'title' => esc_html__( 'Bottom Margin (px or %)', 'cocco' )
				)
			);
		}

		public function widget( $args, $instance ) {
			if ( ! is_array( $instance ) ) {
				$instance = array();
			}

			//prepare variables
			$params = '';

			//is instance empty?
			if ( is_array( $instance ) && count( $instance ) ) {
				//generate shortcode params
				foreach ( $instance as $key => $value ) {
					$params .= " $key='$value' ";
				}
			}

			echo '<div class="widget mkdf-separator-widget">';
			echo do_shortcode( "[mkdf_separator $params]" ); // XSS OK
			echo '</div>';
		}
	}
}