<?php

if ( class_exists( 'CoccoMikadoWidget' ) ) {
	class CoccoMikadoSocialIconWidget extends CoccoMikadoWidget {

		public function __construct() {
			parent::__construct(
				'mkdf_social_icon_widget',
				esc_html__( 'Mikado Social Icon Widget', 'cocco' ),
				array( 'description' => esc_html__( 'Add social network icons to widget areas', 'cocco' ) )
			);

			$this->setParams();
		}

		protected function setParams() {
			$this->params = array_merge(
				cocco_mikado_icon_collections()->getSocialIconWidgetParamsArray(),
				array(
					array(
						'type'  => 'textfield',
						'name'  => 'link',
						'title' => esc_html__( 'Link', 'cocco' )
					),
					array(
						'type'    => 'dropdown',
						'name'    => 'target',
						'title'   => esc_html__( 'Target', 'cocco' ),
						'options' => cocco_mikado_get_link_target_array()
					),
					array(
						'type'  => 'textfield',
						'name'  => 'icon_size',
						'title' => esc_html__( 'Icon Size (px)', 'cocco' )
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
						'type'    => 'dropdown',
						'name'    => 'type',
						'title'   => esc_html__( 'Icon Type', 'cocco' ),
						'options' => array(
							''       => esc_html__( 'Default', 'cocco' ),
							'circle' => esc_html__( 'Circle', 'cocco' ),
							'square' => esc_html__( 'Square', 'cocco' )
						)
					),
					array(
						'type'        => 'colorpicker',
						'name'        => 'background_color',
						'title'       => esc_html__( 'Background Color', 'cocco' ),
						'description' => esc_html__( 'This option works with circle or square icon type', 'cocco' )
					),
					array(
						'type'        => 'textfield',
						'name'        => 'margin',
						'title'       => esc_html__( 'Margin', 'cocco' ),
						'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'cocco' )
					)
				)
			);
		}

		public function widget( $args, $instance ) {
			$icon_styles = array();

			if ( ! empty( $instance['color'] ) ) {
				$icon_styles[] = 'color: ' . $instance['color'] . ';';
			}

			if ( ! empty( $instance['type'] ) && $instance['type'] !== '' && ! empty( $instance['background_color'] ) ) {
				$icon_styles[] = 'background-color: ' . $instance['background_color'] . ';';
			}

			if ( ! empty( $instance['icon_size'] ) ) {
				$icon_styles[] = 'font-size: ' . cocco_mikado_filter_px( $instance['icon_size'] ) . 'px';
			}

			if ( ! empty( $instance['margin'] ) ) {
				$icon_styles[] = 'margin: ' . $instance['margin'] . ';';
			}

			$link        = ! empty( $instance['link'] ) ? $instance['link'] : '#';
			$target      = ! empty( $instance['target'] ) ? $instance['target'] : '_self';
			$hover_color = ! empty( $instance['hover_color'] ) ? $instance['hover_color'] : '';
			$outer_class = ! empty( $instance['type'] ) ? 'mkdf-social-icon-' . $instance['type'] : '';

			$icon_holder_html = '';
			if ( ! empty( $instance['icon_pack'] ) ) {
				$icon_class   = array( 'mkdf-social-icon-widget' );
				$icon_class[] = ! empty( $instance['fa_icon'] ) && $instance['icon_pack'] === 'font_awesome' ? $instance['fa_icon'] : '';
				$icon_class[] = ! empty( $instance['fe_icon'] ) && $instance['icon_pack'] === 'font_elegant' ? $instance['fe_icon'] : '';
				$icon_class[] = ! empty( $instance['ion_icon'] ) && $instance['icon_pack'] === 'ion_icons' ? $instance['ion_icon'] : '';
				$icon_class[] = ! empty( $instance['linea_icon'] ) && $instance['icon_pack'] === 'linea_icons' ? $instance['linea_icon'] : '';
				$icon_class[] = ! empty( $instance['linear_icon'] ) && $instance['icon_pack'] === 'linear_icons' ? 'lnr ' . $instance['linear_icon'] : '';
				$icon_class[] = ! empty( $instance['simple_line_icon'] ) && $instance['icon_pack'] === 'simple_line_icons' ? $instance['simple_line_icon'] : '';

				$icon_class = implode( ' ', $icon_class );

				$icon_holder_html = '<span class="' . $icon_class . ' mkdf-social-icon-widget-initial"></span><span class="' . $icon_class . 'mkdf-social-icon-widget-hover"></span>';
			}
			?>

            <a class="mkdf-social-icon-widget-holder mkdf-icon-has-hover <?php echo esc_attr( $outer_class ); ?>" <?php echo cocco_mikado_get_inline_attr( $hover_color, 'data-hover-color' ); ?> <?php cocco_mikado_inline_style( $icon_styles ) ?>
               href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
				<?php echo wp_kses_post( $icon_holder_html ); ?>
            </a>
			<?php
		}
	}
}