<?php do_action('cocco_mikado_action_before_sticky_header'); ?>

<div class="mkdf-sticky-header">
    <?php do_action('cocco_mikado_action_after_sticky_menu_html_open'); ?>
    <div class="mkdf-sticky-holder">
        <?php if ($sticky_header_in_grid && cocco_mikado_options()->getOptionValue( 'fullscreen_in_grid' ) === 'yes' ) : ?>
        <div class="mkdf-grid">
            <?php endif; ?>
            <div class=" mkdf-vertical-align-containers">
                <div class="mkdf-position-left"><!--
                 --><div class="mkdf-position-left-inner">
                        <?php if (!$hide_logo) {
                            cocco_mikado_get_logo('sticky');
                        } ?>
                    </div>
                </div>
                <div class="mkdf-position-right"><!--
                 --><div class="mkdf-position-right-inner">
                        <?php
                            $fullscreen_menu_icon_class = cocco_mikado_get_fullscreen_menu_icon_class();
                        ?>
                        <a href="javascript:void(0)" <?php cocco_mikado_class_attribute( $fullscreen_menu_icon_class ); ?>>
                            <span class="mkdf-fullscreen-menu-close-icon">
                                <?php echo cocco_mikado_get_icon_sources_html( 'fullscreen_menu', true ); ?>
                            </span>
                            <span class="mkdf-fullscreen-menu-opener-icon">
                                <?php echo cocco_mikado_get_icon_sources_html( 'fullscreen_menu' ); ?>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <?php if ($sticky_header_in_grid) : ?>
        </div>
    <?php endif; ?>
    </div>
</div>

<?php do_action('cocco_mikado_action_after_sticky_header'); ?>
