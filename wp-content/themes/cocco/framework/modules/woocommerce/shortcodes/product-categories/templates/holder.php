<?php
if(is_array($query_result) && count($query_result)){ ?>

	<div class="mkdf-product-categories-holder clearfix <?php echo esc_attr($holder_clases); ?>">
		<div class="mkdf-product-categories-holder-inner clearfix">

			<?php foreach ($query_result as $term){

				$link = get_term_link($term->term_id, 'product_cat');
				$img_id = get_term_meta($term->term_id, 'thumbnail_id', true);
				$img_style = '';
				$holder_class =  array();
				$image_url = '';

				if($img_id && $img_id !== ''){

					$image_url = wp_get_attachment_image_url($img_id, 'full');
					if($image_url && $image_url !== ''){
						$img_style = 'background-image: url('.esc_url($image_url).')';
						$holder_class[] = 'mkdf-category-with-image';
					}

				}

				$term_params = array(
					'term' => $term,
					'link' => $link,
					'img_url' => $image_url,
					'img_style' => $img_style,
					'item_classes'   => implode(' ', $holder_class)
				);

				echo cocco_mikado_get_woo_shortcode_module_template_part('templates/item', 'product-categories', '', $term_params);

			} ?>

		</div>
	</div>

<?php }