<div <?php cocco_mikado_class_attribute($holder_classes); ?>>
	<div class="mkdf-iwt-icon">
		<?php if(!empty($link)) : ?>
			<a itemprop="url" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>">
		<?php endif; ?>
			<?php if(!empty($custom_icon)) { ?>
				<div class="mkdf-iwt-custom-icon" <?php cocco_mikado_inline_style($custom_icon_style);?>>
                    <div class="mkdf-iwt-custom-icon-shape" <?php cocco_mikado_inline_style($custom_icon_bckg_style);?>></div>
					<?php echo wp_get_attachment_image($custom_icon, 'full'); ?>
					<?php if(!empty($custom_hover_icon)) { ?>
						<span class="mkdf-iwt-hover-icon">
							<?php echo wp_get_attachment_image($custom_hover_icon, 'full'); ?>
						</span>
					<?php } ?>
				</div>
			<?php } else {
				echo cocco_core_get_shortcode_module_template_part('templates/icon', 'icon-with-text', '', array('icon_parameters' => $icon_parameters));
			} ?>
		<?php if(!empty($link)) : ?>
			</a>
		<?php endif; ?>
	</div>
	<div class="mkdf-iwt-content" <?php cocco_mikado_inline_style($content_styles); ?>>
		<?php if(!empty($title)) { ?>
			<<?php echo esc_attr($title_tag); ?> class="mkdf-iwt-title" <?php cocco_mikado_inline_style($title_styles); ?>>
				<?php if(!empty($link)) : ?>
					<a itemprop="url" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>">
				<?php endif; ?>
				<span class="mkdf-iwt-title-text"><?php echo esc_html($title); ?></span>
				<?php if(!empty($link)) : ?>
					</a>
				<?php endif; ?>
			</<?php echo esc_attr($title_tag); ?>>
		<?php } ?>
		<?php if(!empty($text)) { ?>
			<p class="mkdf-iwt-text" <?php cocco_mikado_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
		<?php } ?>
	</div>
</div>