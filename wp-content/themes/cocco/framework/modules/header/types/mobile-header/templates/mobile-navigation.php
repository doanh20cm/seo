<?php do_action('cocco_mikado_action_before_mobile_navigation'); ?>


<div class="mkdf-mobile-side-area">
    <div class="mkdf-close-mobile-side-area-holder">
		<?php echo cocco_mikado_icon_collections()->renderIcon('dripicons-cross', 'dripicons'); ?>
    </div>
    <div class="mkdf-mobile-side-area-inner">
    <?php if ( has_nav_menu( 'mobile-navigation' ) || has_nav_menu( 'main-navigation' ) ) { ?>
        <nav class="mkdf-mobile-nav">
        <?php
        // Set main navigation menu as mobile if mobile navigation is not set
        $theme_location = has_nav_menu( 'mobile-navigation' ) ? 'mobile-navigation' : 'main-navigation';

        wp_nav_menu(array(
            'theme_location' => $theme_location,
            'container'  => '',
            'container_class' => '',
            'menu_class' => '',
            'menu_id' => '',
            'fallback_cb' => 'top_navigation_fallback',
            'link_before' => '<span>',
            'link_after' => '</span>',
            'walker' => new CoccoMikadoMobileNavigationWalker()
        )); ?>
        </nav>
    <?php } ?>
    </div>
    <div class="mkdf-mobile-widget-area">
        <div class="mkdf-mobile-widget-area-inner">
            <?php
            if(is_active_sidebar('mkdf-mobile-area')) : ?>
                <?php dynamic_sidebar('mkdf-mobile-area'); ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php do_action('cocco_mikado_action_after_mobile_navigation'); ?>