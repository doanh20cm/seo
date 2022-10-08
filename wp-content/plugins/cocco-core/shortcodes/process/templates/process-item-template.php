<div class="mkdf-process-item <?php echo esc_attr( $holder_classes ); ?>">
	<div class="mkdf-pi-content">
        <?php if(!empty($process_image)){?>
            <div class="mkdf-pi-image-holder" <?php echo cocco_mikado_get_inline_style($image_styles);?>>
                <img src="<?php echo esc_url($process_image);?>" />
            </div>
        <?php } ?>
		<?php if(!empty($title)) { ?>
			<<?php echo esc_attr($title_tag); ?> class="mkdf-pi-title" <?php echo cocco_mikado_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
		<?php } ?>
		<?php if(!empty($text)) { ?>
			<p class="mkdf-pi-text" <?php echo cocco_mikado_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
		<?php } ?>
	</div>
</div>