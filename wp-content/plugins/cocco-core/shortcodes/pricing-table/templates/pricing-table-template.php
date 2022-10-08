<div class="mkdf-price-table mkdf-item-space <?php echo esc_attr($holder_classes); ?>">
	<div class="mkdf-pt-inner" <?php echo cocco_mikado_get_inline_style($holder_styles); ?>>
		<ul>
			<li class="mkdf-pt-title-holder" <?php echo cocco_mikado_get_inline_style($top_area_style); ?>>
				<?php if ($top_content == 'title') { ?>
	                <span class="mkdf-pt-title" <?php echo cocco_mikado_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></span>
				<?php } else { ?>
	                <span class="mkdf-pt-value" <?php echo cocco_mikado_get_inline_style($currency_styles); ?>><?php echo esc_html($currency); ?></span>
	                <span class="mkdf-pt-price" <?php echo cocco_mikado_get_inline_style($price_styles); ?>><?php echo esc_html($price); ?></span>
	                <span class="mkdf-pt-mark" <?php echo cocco_mikado_get_inline_style($price_period_styles); ?>><?php echo esc_html($price_period); ?></span>
                <?php } ?>
			</li>
            <li class="mkdf-pt-content-bottom">
            	<ul>
					<?php if ($top_content !== 'title') { ?>
	                	<li class="mkdf-pt-title" <?php echo cocco_mikado_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></li>
					<?php } else { ?>
						<li class="mkdf-pt-price-holder">
			                <span class="mkdf-pt-value" <?php echo cocco_mikado_get_inline_style($currency_styles); ?>><?php echo esc_html($currency); ?></span>
			                <span class="mkdf-pt-price" <?php echo cocco_mikado_get_inline_style($price_styles); ?>><?php echo esc_html($price); ?></span>
			                <span class="mkdf-pt-mark" <?php echo cocco_mikado_get_inline_style($price_period_styles); ?>><?php echo esc_html($price_period); ?></span>
			            </li>
	                <?php } ?>
	                <li class="mkdf-pt-content">
	                    <?php echo do_shortcode($content); ?>
	                </li>
	                <?php
	                if(!empty($button_text)) { ?>
	                    <li class="mkdf-pt-button">
	                        <?php echo cocco_mikado_get_button_html(array(
	                            'link' => $link,
	                            'text' => $button_text,
	                            'type' => $button_type,
	                            'size' => 'medium'
	                        )); ?>
	                    </li>
	                <?php } ?>
	            </ul>
            </li>
		</ul>
	</div>
</div>