<?php if($icon_animation_holder) : ?>
    <span class="mkdf-icon-animation-holder" <?php cocco_mikado_inline_style($icon_animation_holder_styles); ?>>
<?php endif; ?>
    <span <?php cocco_mikado_class_attribute($icon_holder_classes); ?> <?php cocco_mikado_inline_style($icon_holder_styles); ?> <?php echo cocco_mikado_get_inline_attrs($icon_holder_data); ?>>
        <span class="mkdf-icon-bckg-holder" <?php cocco_mikado_inline_style($icon_background_styles);?>></span>
        <?php if(!empty($link)) : ?>
            <a itemprop="url" class="<?php echo esc_attr($link_class) ?>" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>">
        <?php endif; ?>
            <?php echo cocco_mikado_icon_collections()->renderIcon($icon, $icon_pack, $icon_params); ?>
        <?php if ($icon_switch == 'yes') { ?>
        	<span class="mkdf-icon-duplicate">
        		<?php echo cocco_mikado_icon_collections()->renderIcon($icon, $icon_pack, $icon_double_params); ?>
        	</span>
        <?php } ?>
        <?php if(!empty($link)) : ?>
            </a>
        <?php endif; ?>
    </span>
<?php if($icon_animation_holder) : ?>
    </span>
<?php endif; ?>
