<?php

if ( class_exists( 'CoccoMikadoWidget' ) ) {
	class CoccoMikadoAuthorInfoWidget extends CoccoMikadoWidget {
		public function __construct() {
			parent::__construct(
				'mkdf_author_info_widget',
				esc_html__( 'Mikado Author Info Widget', 'cocco' ),
				array( 'description' => esc_html__( 'Add author info element to widget areas', 'cocco' ) )
			);

			$this->setParams();
		}

		protected function setParams() {
			$this->params = array(
				array(
					'type'  => 'textfield',
					'name'  => 'extra_class',
					'title' => esc_html__( 'Custom CSS Class', 'cocco' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'author_username',
					'title' => esc_html__( 'Author Username', 'cocco' )
				)
			);
		}

		public function widget( $args, $instance ) {
			extract( $args );

			$extra_class = '';
			if ( ! empty( $instance['extra_class'] ) ) {
				$extra_class = $instance['extra_class'];
			}

			$authorID = 1;
			if ( ! empty( $instance['author_username'] ) ) {
				$author = get_user_by( 'login', $instance['author_username'] );

				if ( $author ) {
					$authorID = $author->ID;
				}
			}

			$author_info = get_the_author_meta( 'email', $authorID );
			?>

            <div class="widget mkdf-author-info-widget <?php echo esc_attr( $extra_class ); ?>">
                <div class="mkdf-aiw-inner">
                    <a itemprop="url" class="mkdf-aiw-image"
                       href="<?php echo esc_url( get_author_posts_url( $authorID ) ); ?>">
						<?php echo cocco_mikado_kses_img( get_avatar( $authorID, 138 ) ); ?>
                    </a>
					<?php if ( $author_info !== "" ) { ?>
                        <h5 class="mkdf-aiw-title"><?php echo get_the_author_meta( 'first_name', $authorID ) . " " . get_the_author_meta( 'last_name', $authorID ) ?></h5>
                        <span itemprop="description"
                              class="mkdf-aiw-text"><p><?php echo wp_kses_post( $author_info ); ?></p></span>
                        <ul>
                            <li>
                                <a href="<?php echo get_the_author_meta( 'instagram', $authorID ); ?>">
                                    <span class="mkdf-social-network-icon social_instagram"></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo get_the_author_meta( 'twitter', $authorID ); ?>">
                                    <span class="mkdf-social-network-icon social_twitter"></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo get_the_author_meta( 'facebook', $authorID ); ?>">
                                    <span class="mkdf-social-network-icon social_facebook"></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo get_the_author_meta( 'linkedin', $authorID ); ?>">
                                    <span class="mkdf-social-network-icon social_linkedin"></span>
                                </a>
                            </li>
                        </ul>
					<?php } ?>
                </div>
            </div>
			<?php
		}
	}
}