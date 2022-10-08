<div class="mkdf-section-title-holder <?php echo esc_attr($holder_classes); ?>" <?php echo cocco_mikado_get_inline_style($holder_styles); ?>>
	<div class="mkdf-st-inner">
		<?php if(!empty($subtitle) && $subtitle_position == 'above') { ?>
            <<?php echo esc_attr($subtitle_tag); ?> class="mkdf-st-subtitle" <?php echo cocco_mikado_get_inline_style($subtitle_styles); ?>>
                <?php echo wp_kses($subtitle, array('br' => true)); ?>
            </<?php echo esc_attr($subtitle_tag); ?>>
        <?php } ?>
		<?php if(!empty($title)) { ?>
            <div>
                <<?php echo esc_attr($title_tag); ?> class="mkdf-st-title" <?php echo cocco_mikado_get_inline_style($title_styles); ?>>
                    <?php echo wp_kses($title, array('br' => true, 'span' => array('class' => true))); ?>
                </<?php echo esc_attr($title_tag); ?>>
            </div>
		<?php } ?>
        <?php if(!empty($subtitle) && $subtitle_position == 'under') { ?>
            <<?php echo esc_attr($subtitle_tag); ?> class="mkdf-st-subtitle" <?php echo cocco_mikado_get_inline_style($subtitle_styles); ?>>
                <?php echo wp_kses($subtitle, array('br' => true)); ?>
            </<?php echo esc_attr($subtitle_tag); ?>>
        <?php } ?>
		<?php if(!empty($text)) { ?>
			<p class="mkdf-st-text" <?php echo cocco_mikado_get_inline_style($text_styles); ?>>
				<?php echo wp_kses($text, array('br' => true)); ?>
			</p>
		<?php } ?>
	</div>
</div>