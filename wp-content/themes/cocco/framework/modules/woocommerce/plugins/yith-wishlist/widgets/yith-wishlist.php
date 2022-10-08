<?php

if ( class_exists( 'CoccoMikadoWidget' ) ) {
	class CoccoMikadoYithWishlist extends CoccoMikadoWidget {
		public function __construct() {
			parent::__construct(
				'mkdf_woocommerce_yith_wishlist',
				esc_html__( 'Mikado WooCommerce Wishlist', 'cocco' ),
				array( 'description' => esc_html__( 'Display a wishlist icon with number of products that are in the wishlist', 'cocco' ) )
			);
			$this->setParams();
		}

		protected function setParams() {

			$this->params = array(
				array(
					'type'        => 'textfield',
					'name'        => 'mkdf_woocommerce_yith_wishlist_margin',
					'title'       => esc_html__( 'Icon Margin', 'cocco' ),
					'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'cocco' )
				)
			);
		}

		/**
		 * @param array $new_instance
		 * @param array $old_instance
		 *
		 * @return array
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			foreach ( $this->params as $param ) {
				$param_name = $param['name'];

				$instance[ $param_name ] = sanitize_text_field( $new_instance[ $param_name ] );
			}


			return $instance;
		}

		public function widget( $args, $instance ) {
			extract( $args );

			global $yith_wcwl;

			$icon_styles = array();

			if ( $instance['mkdf_woocommerce_yith_wishlist_margin'] !== '' ) {
				$icon_styles[] = 'padding: ' . $instance['mkdf_woocommerce_yith_wishlist_margin'];
			}
			?>
            <div class="mkdf-wishlist-widget-holder" <?php cocco_mikado_inline_style( $icon_styles ) ?>>
                <a href="<?php echo esc_url( $yith_wcwl->get_wishlist_url() ); ?>" class="mkdf-wishlist-widget-link">
                    <span class="mkdf-wishlist-widget-icon"><i class="dripicons-heart"></i><span
                                class="mkdf-wishlist-title"><?php esc_html_e( 'Wishlist', 'cocco' ); ?></span></span>

                </a>
            </div>
			<?php
		}
	}
}

?>