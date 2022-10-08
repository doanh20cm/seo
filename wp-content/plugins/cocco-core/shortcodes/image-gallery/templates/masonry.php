<?php
$i    = 0;
$rand = rand(0,1000);
?>
<div class="mkdf-image-gallery <?php echo esc_attr($holder_classes); ?>">
	<div class="mkdf-ig-inner mkdf-outer-space <?php echo esc_attr($inner_classes); ?>">
		<div class="mkdf-ig-grid-sizer"></div>
		<div class="mkdf-ig-grid-gutter"></div>
		<?php foreach ($images as $image) { ?>
			<?php
				$image_classes = '';

				if ($type == 'masonry-fixed') {
					$image_classes = 'mkdf-image-gallery-masonry-fixed ';
					$image_size_class    = get_post_meta( $image['image_id'], 'image_gallery_fixed_masonry_image_size', true );

					switch ($image_size_class) {
						case 'mkdf-default-masonry-item':
							$image_size = 'cocco_mikado_square';
							break;
						case 'mkdf-large-width-masonry-item':
							$image_size = 'cocco_mikado_landscape';
							break;
						case 'mkdf-large-height-masonry-item':
							$image_size = 'cocco_mikado_portrait';
							break;
						case 'mkdf-large-width-height-masonry-item':
							$image_size = 'cocco_mikado_huge';
							break;
						default:
							$image_size = 'cocco_mikado_square';
							break;
					}

					if ($image_size_class == '') {
						$image_size_class = 'mkdf-default-masonry-item';
					}
				} else {
					$image_size_class    = get_post_meta( $image['image_id'], 'image_gallery_masonry_image_size', true );
				}

				if ( ! empty( $image_size_class ) ) {
					$image_classes .= esc_attr( $image_size_class );
				}
			?>
			<div class="mkdf-ig-image mkdf-item-space <?php echo esc_attr($image_classes); ?>">
				<div class="mkdf-ig-image-inner">
					<?php if ($image_behavior === 'lightbox') { ?>
						<a itemprop="image" class="mkdf-ig-lightbox" href="<?php echo esc_url($image['url']); ?>" data-rel="prettyPhoto[image_gallery_pretty_photo-<?php echo esc_attr($rand); ?>]" title="<?php echo esc_attr($image['title']); ?>">
							<span class="mkdf-ig-lightbox-icon dripicon dripicons-rocket"></span>
					<?php } else if ($image_behavior === 'custom-link' && !empty($custom_links)) { ?>
						<a itemprop="url" class="mkdf-ig-custom-link" href="<?php echo esc_url($custom_links[$i++]); ?>" target="<?php echo esc_attr($custom_link_target); ?>" title="<?php echo esc_attr($image['title']); ?>">
					<?php } ?>
						<?php if(is_array($image_size) && count($image_size)) :
							echo cocco_mikado_generate_thumbnail($image['image_id'], null, $image_size[0], $image_size[1]);
						else:
							echo wp_get_attachment_image($image['image_id'], $image_size);
						endif; ?>
					<?php if ($image_behavior === 'lightbox' || $image_behavior === 'custom-link') { ?>
						</a>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
	</div>
</div>