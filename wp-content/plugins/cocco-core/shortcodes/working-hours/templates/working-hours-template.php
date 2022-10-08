<div class="mkdf-working-hours-holder <?php echo esc_attr($holder_classes); ?>" <?php echo cocco_mikado_get_inline_style($content_style); ?>>
	<div class="mkdf-wh-holder-inner">
		<?php if(is_array($working_hours) && count($working_hours)) : ?>
				<?php if($title !== '') : ?>
					<div class="mkdf-wh-title-holder">
						<h3 class="mkdf-wh-title"><?php echo esc_html($title); ?></h3>
					</div>
				<?php endif; ?>

            <?php if($text !== '') : ?>
                <div class="mkdf-wh-text-holder">
                    <p class="mkdf-wh-text"><?php echo esc_html($text); ?></p>
                </div>
            <?php endif; ?>

			<?php foreach($working_hours as $working_hour) : ?>
				<div class="mkdf-wh-item clearfix">
					<span class="mkdf-wh-day">
						<?php echo esc_html($working_hour['label']); ?>
					</span>
                    <span class="mkdf-wh-delimiter"></span>
					<span class="mkdf-wh-hours">
						<?php if(isset($working_hour['from_to'])) : ?>
							<span class="mkdf-wh-from-to"><?php echo esc_html($working_hour['from_to']); ?></span>
						<?php endif; ?>
					</span>
				</div>
			<?php endforeach; ?>
            <?php
            if(!empty($button_text)) { ?>
                <div class="mkdf-wh-button">
                    <?php echo cocco_mikado_get_button_html(array(
                        'link' => $link,
                        'text' => $button_text,
                        'type' => 'solid',
                        'size' => 'small',
                        'enable_icon' => 'icon_pack',
                        'icon_pack'   => 'font_elegant',
                        'fe_icon'     => 'arrow_carrot-right'
                    )); ?>
                </div>
            <?php } ?>
		<?php else: ?>
		<p><?php esc_html_e('Working hours are not set', 'cocco-core'); ?></p>
		<?php endif; ?>
	</div>
</div>