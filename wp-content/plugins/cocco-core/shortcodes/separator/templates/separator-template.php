<div class="mkdf-separator-holder clearfix <?php echo esc_attr($holder_classes); ?>" <?php cocco_mikado_inline_style($holder_styles); ?>>
	<?php if ($enable_icon !== 'none' && $icon_position == 'left') { ?>
		<span class="mkdf-separator-icon" <?php cocco_mikado_inline_style($icon_holder_style);?>>
			<?php echo cocco_mikado_get_module_part( $icon_html ); ?>
		</span>
	<?php } ?>
	<div class="mkdf-separator" <?php cocco_mikado_inline_style($separator_styles); ?>></div>
	<?php if ($enable_icon !== 'none' && $icon_position !== 'left') { ?>
		<span class="mkdf-separator-icon" <?php cocco_mikado_inline_style($icon_holder_style);?>>
			<?php echo cocco_mikado_get_module_part( $icon_html ); ?>
		</span>
		<?php if ($icon_position == 'center') { ?>
			<div class="mkdf-separator" <?php cocco_mikado_inline_style($separator_styles); ?>></div>
		<?php } ?>
	<?php } ?>
</div>
