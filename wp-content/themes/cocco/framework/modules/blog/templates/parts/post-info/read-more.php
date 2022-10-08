<?php if ( ! cocco_mikado_post_has_read_more() && ! post_password_required() ) { ?>
	<div class="mkdf-post-read-more-button">
		<?php
			$button_params = array(
				'type'         => 'simple',
				'link'         => get_the_permalink(),
				'text'         => esc_html__( 'Read More', 'cocco' ),
				'custom_class' => 'mkdf-blog-list-button',
                'enable_underline' => 'yes',
			);
			echo cocco_mikado_return_button_html( $button_params );
		?>
	</div>
<?php } ?>