<div class="mkdf-price-plan mkdf-item-space <?php echo esc_attr($holder_classes); ?>">
    <div class="mkdf-pp-inner" <?php echo cocco_mikado_get_inline_style($holder_styles); ?>>
        <div class="mkdf-pp-content-top">
            <h1 class="mkdf-pp-title-period" <?php echo cocco_mikado_get_inline_style($price_period_styles); ?>>
                <?php echo esc_html($price_period); ?>
            </h1>
            <div class="mkdf-pp-text" <?php echo cocco_mikado_get_inline_style($text_styles); ?>>
                <?php echo esc_html($pricing_plan_text);?>
            </div>
        </div>
            <div class="mkdf-pp-content-bottom">
                <?php
                if (!empty($button_text)) { ?>
                    <div class="mkdf-pp-button">
                        <?php echo cocco_mikado_get_button_html(array(
                            'link' => $link,
                            'text' => $button_text,
                            'type' => 'simple',
                            'size' => 'medium',
                            'color' => $button_text_color,
                            'hover_color'  => $button_text_hover_color,
                            'enable_icon' => 'icon_pack',
                            'icon_pack' => 'font_elegant',
                            'fe_icon' => 'arrow_carrot-right',
                            'animate_icon'  => 'yes'
                        )); ?>
                    </div>
                <?php } ?>
                <div class="mkdf-pp-price-holder">
                    <span class="mkdf-pp-value" <?php echo cocco_mikado_get_inline_style($currency_styles); ?>><?php echo esc_html($currency); ?></span>
                    <span class="mkdf-pp-price" <?php echo cocco_mikado_get_inline_style($price_styles); ?>><?php echo esc_html($price); ?></span>
                </div>
            </div>
    </div>
</div>