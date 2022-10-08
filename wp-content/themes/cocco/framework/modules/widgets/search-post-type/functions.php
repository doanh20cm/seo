<?php

if ( ! function_exists( 'cocco_mikado_register_search_post_type_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function cocco_mikado_register_search_post_type_widget( $widgets ) {
		$widgets[] = 'CoccoMikadoSearchPostType';
		
		return $widgets;
	}
	
	add_filter( 'cocco_core_filter_register_widgets', 'cocco_mikado_register_search_post_type_widget' );
}

if ( ! function_exists( 'cocco_mikado_search_post_types' ) ) {
	function cocco_mikado_search_post_types() {
		$user_id = get_current_user_id();
		
		if ( empty( $_POST ) || ! isset( $_POST ) ) {
			cocco_mikado_ajax_status( 'error', esc_html__( 'All fields are empty', 'cocco' ) );
		} else {
			$args = array(
				'post_type'      => sanitize_text_field( $_POST['postType'] ),
				'post_status'    => 'publish',
				'order'          => 'DESC',
				'orderby'        => 'date',
				's'              => sanitize_text_field( $_POST['term'] ),
				'posts_per_page' => 5
			);
			
			$html  = '';
			$query = new WP_Query( $args );
			
			if ( $query->have_posts() ) {
				$html .= '<ul>';
					while ( $query->have_posts() ) {
						$query->the_post();
						$html .= '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
					}
				$html              .= '</ul>';
				$json_data['html'] = $html;
				cocco_mikado_ajax_status( 'success', '', $json_data );
			} else {
				$html              .= '<ul>';
					$html              .= '<li>' . esc_html__( 'No posts found.', 'cocco' ) . '</li>';
				$html              .= '</ul>';
				$json_data['html'] = $html;
				cocco_mikado_ajax_status( 'success', '', $json_data );
			}
		}
		
		wp_die();
	}
	
	add_action( 'wp_ajax_cocco_mikado_search_post_types', 'cocco_mikado_search_post_types' );
    add_action( 'wp_ajax_nopriv_cocco_mikado_search_post_types', 'cocco_mikado_search_post_types' );
}