<?php

if ( class_exists( 'CoccoMikadoWidget' ) ) {
	class CoccoMikadoVerticalSeparatorWidget extends CoccoMikadoWidget {
		public function __construct() {
			parent::__construct(
				'mkdf_vertical_separator_widget',
				esc_html__( 'Mikado Vertical Separator Widget', 'cocco' ),
				array( 'description' => esc_html__( 'Add a vertical separator element to your widget areas', 'cocco' ) )
			);

			$this->setParams();
		}

		protected function setParams() {
			$this->params = array(
				array(
					'type'    => 'dropdown',
					'name'    => 'type',
					'title'   => esc_html__( 'Holder Height', 'cocco' ),
					'options' => array(
						'full-height'   => esc_html__( 'Full Height', 'cocco' ),
						'custom-height' => esc_html__( 'Custom Height', 'cocco' ),
					)
				),
				array(
					'type'    => 'dropdown',
					'name'    => 'align',
					'title'   => esc_html__( 'Vertical Align', 'cocco' ),
					'options' => array(
						'middle' => esc_html__( 'Middle', 'cocco' ),
						'top'    => esc_html__( 'Top', 'cocco' ),
						'bottom' => esc_html__( 'Bottom', 'cocco' )
					)
				),
				array(
					'type'        => 'textfield',
					'name'        => 'height',
					'title'       => esc_html__( 'Height (px or %)', 'cocco' ),
					'description' => esc_html__( 'The percentage applies only if the \'Full Holder Height\' is selected', 'cocco' )
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
					'name'  => 'thickness',
					'title' => esc_html__( 'Thickness (px)', 'cocco' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'left_margin',
					'title' => esc_html__( 'Left Margin (px)', 'cocco' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'right_margin',
					'title' => esc_html__( 'Right Margin (px)', 'cocco' )
				)
			);
		}

		public function widget( $args, $instance ) {
			if ( ! is_array( $instance ) ) {
				$instance = array();
			}

			$holder_class = '';

			if ( $instance['type'] == 'full-height' ) {
				$holder_class = 'mkdf-vertical-separator-full-height';
			}

			$style = array();

			if ( $instance['align'] !== '' ) {
				$style[] = 'vertical-align:' . $instance['align'];
			}

			if ( $instance['height'] !== '' ) {
				if ( cocco_mikado_string_ends_with( $instance['height'], '%' ) ) {
					$height = $instance['height'];
				} else {
					$height = cocco_mikado_filter_px( $instance['height'] ) . 'px';
				}
				$style[] = 'height:' . $height;
			}

			if ( $instance['border_style'] !== '' ) {
				$style[] = 'border-left-style:' . $instance['border_style'];
			}

			if ( $instance['color'] !== '' ) {
				$style[] = 'border-color:' . $instance['color'];
			}

			if ( $instance['thickness'] !== '' ) {
				$style[] = 'border-width:' . cocco_mikado_filter_px( $instance['thickness'] ) . 'px';
			}

			if ( $instance['left_margin'] !== '' ) {
				$style[] = 'margin-left:' . cocco_mikado_filter_px( $instance['left_margin'] ) . 'px';
			}

			if ( $instance['right_margin'] !== '' ) {
				$style[] = 'margin-right:' . cocco_mikado_filter_px( $instance['right_margin'] ) . 'px';
			}

			$html = '';

			$html .= '<div class="widget mkdf-vertical-separator-widget ' . esc_attr( $holder_class ) . '">';
			$html .= '<span class="mkdf-vsw-height-holder"></span>';
			$html .= '<span class="mkdf-vsw" ' . cocco_mikado_get_inline_style( $style ) . '></span>';
			$html .= '</div>';

			echo wp_kses_post( $html );
		}
	}
}