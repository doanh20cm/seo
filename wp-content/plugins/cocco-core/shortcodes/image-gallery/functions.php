<?php

if ( ! function_exists( 'cocco_core_add_image_gallery_shortcodes' ) ) {
	function cocco_core_add_image_gallery_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'CoccoCore\CPT\Shortcodes\ImageGallery\ImageGallery'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'cocco_core_filter_add_vc_shortcode', 'cocco_core_add_image_gallery_shortcodes' );
}

if ( ! function_exists( 'cocco_core_set_image_gallery_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for image gallery shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function cocco_core_set_image_gallery_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-image-gallery';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'cocco_core_filter_add_vc_shortcodes_custom_icon_class', 'cocco_core_set_image_gallery_icon_class_name_for_vc_shortcodes' );
}

if ( ! function_exists( 'cocco_core_add_image_gallery_attachment_custom_field' ) ) {
	function cocco_core_add_image_gallery_attachment_custom_field( $form_fields, $post = null ) {
		if ( wp_attachment_is_image( $post->ID ) ) {
			$field_value = get_post_meta( $post->ID, 'image_gallery_masonry_image_size', true );
			
			$form_fields['image_gallery_masonry_image_size'] = array(
				'input' => 'html',
				'label' => esc_html__( 'Image Size', 'cocco-core' ),
				'helps' => esc_html__( 'Choose image size for Image Gallery shortcode item - Masonry layout', 'cocco-core' )
			);
			
			$form_fields['image_gallery_masonry_image_size']['html'] = "<select name='attachments[{$post->ID}][image_gallery_masonry_image_size]'>";
			$form_fields['image_gallery_masonry_image_size']['html'] .= '<option ' . selected( $field_value, 'mkdf-default-masonry-item', false ) . ' value="mkdf-default-masonry-item">' . esc_html__( 'Default Size', 'cocco-core' ) . '</option>';
			$form_fields['image_gallery_masonry_image_size']['html'] .= '<option ' . selected( $field_value, 'mkdf-large-masonry-item', false ) . ' value="mkdf-large-masonry-item">' . esc_html__( 'Large Size', 'cocco-core' ) . '</option>';
			$form_fields['image_gallery_masonry_image_size']['html'] .= '</select>';

			$field_value = get_post_meta( $post->ID, 'image_gallery_fixed_masonry_image_size', true );
			
			$form_fields['image_gallery_fixed_masonry_image_size'] = array(
				'input' => 'html',
				'label' => esc_html__( 'Fixed Image Size', 'cocco-core' ),
				'helps' => esc_html__( 'Choose image size for Image Gallery shortcode item - Masonry Fixed layout', 'cocco-core' )
			);
			
			$form_fields['image_gallery_fixed_masonry_image_size']['html'] = "<select name='attachments[{$post->ID}][image_gallery_fixed_masonry_image_size]'>";
			$form_fields['image_gallery_fixed_masonry_image_size']['html'] .= '<option ' . selected( $field_value, 'mkdf-default-masonry-item', false ) . ' value="mkdf-default-masonry-item">' . esc_html__( 'Default Size', 'cocco-core' ) . '</option>';
			$form_fields['image_gallery_fixed_masonry_image_size']['html'] .= '<option ' . selected( $field_value, 'mkdf-large-width-masonry-item', false ) . ' value="mkdf-large-width-masonry-item">' . esc_html__( 'Large Width', 'cocco-core' ) . '</option>';
			$form_fields['image_gallery_fixed_masonry_image_size']['html'] .= '<option ' . selected( $field_value, 'mkdf-large-height-masonry-item', false ) . ' value="mkdf-large-height-masonry-item">' . esc_html__( 'Large Height', 'cocco-core' ) . '</option>';
			$form_fields['image_gallery_fixed_masonry_image_size']['html'] .= '<option ' . selected( $field_value, 'mkdf-large-width-height-masonry-item', false ) . ' value="mkdf-large-width-height-masonry-item">' . esc_html__( 'Large Width Height', 'cocco-core' ) . '</option>';
			$form_fields['image_gallery_fixed_masonry_image_size']['html'] .= '</select>';
		}
		
		return $form_fields;
	}
	
	add_filter( 'attachment_fields_to_edit', 'cocco_core_add_image_gallery_attachment_custom_field', 10, 2 );
}

if ( ! function_exists( 'cocco_core_save_image_gallery_attachment_fields' ) ) {
	/**
	 * @param array $post
	 * @param array $attachment
	 *
	 * @return array
	 */
	function cocco_core_save_image_gallery_attachment_fields( $post, $attachment ) {
		
		if ( isset( $attachment['image_gallery_masonry_image_size'] ) ) {
			update_post_meta( $post['ID'], 'image_gallery_masonry_image_size', $attachment['image_gallery_masonry_image_size'] );
		}
		
		if ( isset( $attachment['image_gallery_fixed_masonry_image_size'] ) ) {
			update_post_meta( $post['ID'], 'image_gallery_fixed_masonry_image_size', $attachment['image_gallery_fixed_masonry_image_size'] );
		}
		
		return $post;
	}
	
	add_filter( 'attachment_fields_to_save', 'cocco_core_save_image_gallery_attachment_fields', 10, 2 );
}