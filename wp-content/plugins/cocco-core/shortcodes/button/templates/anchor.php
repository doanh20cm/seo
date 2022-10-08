<a itemprop="url" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" <?php cocco_mikado_inline_style($button_styles); ?> <?php cocco_mikado_class_attribute($button_classes); ?> <?php echo cocco_mikado_get_inline_attrs($button_data); ?> <?php echo cocco_mikado_get_inline_attrs($button_custom_attrs); ?>>
    <span class="mkdf-btn-text"><?php echo esc_html($text); ?></span>
    <?php if ($enable_icon == 'icon_pack') {?>
        <span class="mkdf-btn-icon-holder">
            <span class="mkdf-btn-icon-holder-inner">
                <?php
                    if ($animate_icon == 'yes' && $type == 'solid') {
                        echo cocco_mikado_icon_collections()->renderIcon('dripicons-rocket','dripicons', array(
                            'icon_attributes' => array(
                                'class' => 'mkdf-btn-icon-elem'
                            )
                        ));
                    }
                    echo cocco_mikado_icon_collections()->renderIcon($icon, $icon_pack, array(
                        'icon_attributes' => array(
                            'class' => 'mkdf-btn-icon-elem'
                        )
                    ));
                    ?>
            </span>
        </span>
    <?php } ?>
</a>