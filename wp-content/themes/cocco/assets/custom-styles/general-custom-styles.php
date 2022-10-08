<?php

if(!function_exists('cocco_mikado_design_styles')) {
    /**
     * Generates general custom styles
     */
    function cocco_mikado_design_styles() {
	    $font_family = cocco_mikado_options()->getOptionValue( 'google_fonts' );
	    if ( ! empty( $font_family ) && cocco_mikado_is_font_option_valid( $font_family ) ) {
		    $font_family_selector = array(
			    'body'
		    );
		    echo cocco_mikado_dynamic_css( $font_family_selector, array( 'font-family' => cocco_mikado_get_font_option_val( $font_family ) ) );
	    }

		$first_main_color = cocco_mikado_options()->getOptionValue('first_color');
        if(!empty($first_main_color)) {
            $color_selector = array(
                'a:hover',
                'h1 a:hover',
                'h2 a:hover',
                'h3 a:hover',
                'h4 a:hover',
                'h5 a:hover',
                'h6 a:hover',
                'p a:hover',
                '.mkdf-comment-holder .mkdf-comment-list .children:before',
                '.mkdf-comment-holder .mkdf-comment-text .mkdf-comment-date',
                '.mkdf-comment-holder .mkdf-comment-text #cancel-comment-reply-link',
                '.mkdf-owl-slider .owl-nav .owl-next:hover',
                '.mkdf-owl-slider .owl-nav .owl-prev:hover',
                '.mkdf-owl-slider .owl-nav .owl-next .mkdf-arrow-stack-outer .mkdf-arrow-stack .mkdf-prev-icon',
                '.mkdf-owl-slider .owl-nav .owl-prev .mkdf-arrow-stack-outer .mkdf-arrow-stack .mkdf-prev-icon',
                '.mkdf-owl-slider .owl-nav .owl-next .mkdf-arrow-stack-outer .mkdf-arrow-stack .mkdf-next-icon:hover',
                '.mkdf-owl-slider .owl-nav .owl-prev .mkdf-arrow-stack-outer .mkdf-arrow-stack .mkdf-next-icon:hover',
                'footer .widget ul li a:hover',
                'footer .widget.widget_archive ul li a abbr:hover',
                'footer .widget.widget_archive ul li a:hover',
                'footer .widget.widget_categories ul li a abbr:hover',
                'footer .widget.widget_categories ul li a:hover',
                'footer .widget.widget_meta ul li a abbr:hover',
                'footer .widget.widget_meta ul li a:hover',
                'footer .widget.widget_nav_menu ul li a abbr:hover',
                'footer .widget.widget_nav_menu ul li a:hover',
                'footer .widget.widget_pages ul li a abbr:hover',
                'footer .widget.widget_pages ul li a:hover',
                'footer .widget.widget_recent_entries ul li a abbr:hover',
                'footer .widget.widget_recent_entries ul li a:hover',
                'footer .widget #wp-calendar tfoot a:hover',
                'footer .widget.widget_rss .rsswidget:hover',
                'footer .widget.widget_tag_cloud a:hover',
                '.mkdf-fullscreen-sidebar .widget ul li a:hover',
                '.mkdf-fullscreen-sidebar .widget.widget_archive ul li a abbr:hover',
                '.mkdf-fullscreen-sidebar .widget.widget_archive ul li a:hover',
                '.mkdf-fullscreen-sidebar .widget.widget_categories ul li a abbr:hover',
                '.mkdf-fullscreen-sidebar .widget.widget_categories ul li a:hover',
                '.mkdf-fullscreen-sidebar .widget.widget_meta ul li a abbr:hover',
                '.mkdf-fullscreen-sidebar .widget.widget_meta ul li a:hover',
                '.mkdf-fullscreen-sidebar .widget.widget_nav_menu ul li a abbr:hover',
                '.mkdf-fullscreen-sidebar .widget.widget_nav_menu ul li a:hover',
                '.mkdf-fullscreen-sidebar .widget.widget_pages ul li a abbr:hover',
                '.mkdf-fullscreen-sidebar .widget.widget_pages ul li a:hover',
                '.mkdf-fullscreen-sidebar .widget.widget_recent_entries ul li a abbr:hover',
                '.mkdf-fullscreen-sidebar .widget.widget_recent_entries ul li a:hover',
                '.mkdf-fullscreen-sidebar .widget #wp-calendar tfoot a:hover',
                '.mkdf-fullscreen-sidebar .widget.widget_rss .rsswidget:hover',
                '.mkdf-fullscreen-sidebar .widget.widget_tag_cloud a:hover',
                '.mkdf-side-menu .widget ul li a:hover',
                '.mkdf-side-menu .widget.widget_archive ul li a abbr:hover',
                '.mkdf-side-menu .widget.widget_archive ul li a:hover',
                '.mkdf-side-menu .widget.widget_categories ul li a abbr:hover',
                '.mkdf-side-menu .widget.widget_categories ul li a:hover',
                '.mkdf-side-menu .widget.widget_meta ul li a abbr:hover',
                '.mkdf-side-menu .widget.widget_meta ul li a:hover',
                '.mkdf-side-menu .widget.widget_nav_menu ul li a abbr:hover',
                '.mkdf-side-menu .widget.widget_nav_menu ul li a:hover',
                '.mkdf-side-menu .widget.widget_pages ul li a abbr:hover',
                '.mkdf-side-menu .widget.widget_pages ul li a:hover',
                '.mkdf-side-menu .widget.widget_recent_entries ul li a abbr:hover',
                '.mkdf-side-menu .widget.widget_recent_entries ul li a:hover',
                '.mkdf-side-menu .widget #wp-calendar tfoot a:hover',
                '.mkdf-side-menu .widget.widget_rss .rsswidget:hover',
                '.mkdf-side-menu .widget.widget_tag_cloud a:hover',
                '.wpb_widgetised_column .widget ul li a:hover',
                'aside.mkdf-sidebar .widget ul li a:hover',
                '.wpb_widgetised_column .widget.widget_archive ul li a abbr:hover',
                '.wpb_widgetised_column .widget.widget_archive ul li a:hover',
                '.wpb_widgetised_column .widget.widget_categories ul li a abbr:hover',
                '.wpb_widgetised_column .widget.widget_categories ul li a:hover',
                '.wpb_widgetised_column .widget.widget_meta ul li a abbr:hover',
                '.wpb_widgetised_column .widget.widget_meta ul li a:hover',
                '.wpb_widgetised_column .widget.widget_nav_menu ul li a abbr:hover',
                '.wpb_widgetised_column .widget.widget_nav_menu ul li a:hover',
                '.wpb_widgetised_column .widget.widget_pages ul li a abbr:hover',
                '.wpb_widgetised_column .widget.widget_pages ul li a:hover',
                '.wpb_widgetised_column .widget.widget_recent_entries ul li a abbr:hover',
                '.wpb_widgetised_column .widget.widget_recent_entries ul li a:hover',
                'aside.mkdf-sidebar .widget.widget_archive ul li a abbr:hover',
                'aside.mkdf-sidebar .widget.widget_archive ul li a:hover',
                'aside.mkdf-sidebar .widget.widget_categories ul li a abbr:hover',
                'aside.mkdf-sidebar .widget.widget_categories ul li a:hover',
                'aside.mkdf-sidebar .widget.widget_meta ul li a abbr:hover',
                'aside.mkdf-sidebar .widget.widget_meta ul li a:hover',
                'aside.mkdf-sidebar .widget.widget_nav_menu ul li a abbr:hover',
                'aside.mkdf-sidebar .widget.widget_nav_menu ul li a:hover',
                'aside.mkdf-sidebar .widget.widget_pages ul li a abbr:hover',
                'aside.mkdf-sidebar .widget.widget_pages ul li a:hover',
                'aside.mkdf-sidebar .widget.widget_recent_entries ul li a abbr:hover',
                'aside.mkdf-sidebar .widget.widget_recent_entries ul li a:hover',
                '.wpb_widgetised_column .widget #wp-calendar tfoot a:hover',
                'aside.mkdf-sidebar .widget #wp-calendar tfoot a:hover',
                '.wpb_widgetised_column .widget.widget_rss .rsswidget:hover',
                'aside.mkdf-sidebar .widget.widget_rss .rsswidget:hover',
                '.wpb_widgetised_column .widget.widget_tag_cloud a:hover',
                'aside.mkdf-sidebar .widget.widget_tag_cloud a:hover',
                '.mkdf-sidebar-holder.mkdf-sidebar-boxed aside.mkdf-sidebar .widget ul li a:hover',
                '.mkdf-sidebar-holder.mkdf-sidebar-boxed aside.mkdf-sidebar .widget.widget_archive ul li a abbr:hover',
                '.mkdf-sidebar-holder.mkdf-sidebar-boxed aside.mkdf-sidebar .widget.widget_archive ul li a:hover',
                '.mkdf-sidebar-holder.mkdf-sidebar-boxed aside.mkdf-sidebar .widget.widget_categories ul li a abbr:hover',
                '.mkdf-sidebar-holder.mkdf-sidebar-boxed aside.mkdf-sidebar .widget.widget_categories ul li a:hover',
                '.mkdf-sidebar-holder.mkdf-sidebar-boxed aside.mkdf-sidebar .widget.widget_meta ul li a abbr:hover',
                '.mkdf-sidebar-holder.mkdf-sidebar-boxed aside.mkdf-sidebar .widget.widget_meta ul li a:hover',
                '.mkdf-sidebar-holder.mkdf-sidebar-boxed aside.mkdf-sidebar .widget.widget_nav_menu ul li a abbr:hover',
                '.mkdf-sidebar-holder.mkdf-sidebar-boxed aside.mkdf-sidebar .widget.widget_nav_menu ul li a:hover',
                '.mkdf-sidebar-holder.mkdf-sidebar-boxed aside.mkdf-sidebar .widget.widget_pages ul li a abbr:hover',
                '.mkdf-sidebar-holder.mkdf-sidebar-boxed aside.mkdf-sidebar .widget.widget_pages ul li a:hover',
                '.mkdf-sidebar-holder.mkdf-sidebar-boxed aside.mkdf-sidebar .widget.widget_recent_entries ul li a abbr:hover',
                '.mkdf-sidebar-holder.mkdf-sidebar-boxed aside.mkdf-sidebar .widget.widget_recent_entries ul li a:hover',
                '.mkdf-sidebar-holder.mkdf-sidebar-boxed aside.mkdf-sidebar .widget #wp-calendar tfoot a:hover',
                '.mkdf-sidebar-holder.mkdf-sidebar-boxed aside.mkdf-sidebar .widget.widget_rss .rsswidget:hover',
                '.mkdf-sidebar-holder.mkdf-sidebar-boxed aside.mkdf-sidebar .widget.widget_tag_cloud a:hover',
                'aside.mkdf-sidebar .widget.mkdf-blog-list-widget .mkdf-blog-list-holder.mkdf-bl-simple .mkdf-bli-content p.mkdf-post-title a:hover',
                '.widget.widget_mkdf_twitter_widget .mkdf-twitter-widget.mkdf-twitter-standard li .mkdf-tweet-text a:hover',
                '.widget.widget_mkdf_twitter_widget .mkdf-twitter-widget.mkdf-twitter-slider li .mkdf-twitter-icon i',
                '.widget.widget_mkdf_twitter_widget .mkdf-twitter-widget.mkdf-twitter-slider li .mkdf-tweet-text a',
                '.widget.widget_mkdf_twitter_widget .mkdf-twitter-widget.mkdf-twitter-slider li .mkdf-tweet-text span',
                '.widget_icl_lang_sel_widget .wpml-ls-legacy-dropdown .wpml-ls-item-toggle:hover',
                '.widget_icl_lang_sel_widget .wpml-ls-legacy-dropdown-click .wpml-ls-item-toggle:hover',
                '.mkdf-top-bar .widget_icl_lang_sel_widget .wpml-ls-legacy-dropdown ul li .wpml-ls-sub-menu a:hover',
                '.mkdf-top-bar .widget_icl_lang_sel_widget .wpml-ls-legacy-dropdown-click ul li .wpml-ls-sub-menu a:hover',
                '.mkdf-blog-holder article.sticky .mkdf-post-title a',
                '.mkdf-blog-holder article .mkdf-post-info-top>div a:hover',
                '.mkdf-blog-holder article .mkdf-post-info-top>div.mkdf-post-info-comments-holder span',
                '.mkdf-blog-holder article .mkdf-post-info-top>div.mkdf-post-info-category span',
                '.mkdf-blog-pagination ul li a',
                '.mkdf-bl-standard-pagination ul li a',
                '.mkdf-author-description .mkdf-author-description-text-holder .mkdf-author-name a:hover',
                '.mkdf-author-description .mkdf-author-description-text-holder .mkdf-author-social-icons a span:hover',
                '.mkdf-blog-single-navigation .mkdf-blog-single-next:hover',
                '.mkdf-blog-single-navigation .mkdf-blog-single-prev:hover',
                '.mkdf-single-links-pages a',
                '.mkdf-single-links-pages>span',
                '.mkdf-blog-holder.mkdf-blog-single article .mkdf-post-info-bottom .mkdf-post-info-bottom-left>div a i',
                '.mkdf-blog-holder.mkdf-blog-single article .mkdf-post-info-bottom .mkdf-post-info-bottom-left>div a span',
                '.mkdf-blog-holder.mkdf-blog-single article .mkdf-post-info-bottom .mkdf-post-info-bottom-left>div.mkdf-post-info-category span',
                '.mkdf-blog-holder.mkdf-blog-single article .mkdf-post-info-bottom .mkdf-post-info-bottom-left>div.mkdf-tags-holder span',
                '.mkdf-blog-holder.mkdf-blog-single article .mkdf-post-info-bottom a:hover',
                '.mkdf-blog-list-holder .mkdf-bli-info>div a:hover',
                '.mkdf-blog-list-holder .mkdf-bli-info>div a span',
                '.mkdf-blog-list-holder .mkdf-bli-info>div a.mkdf-like i',
                '.mkdf-blog-list-holder .mkdf-bli-info>div.mkdf-post-info-category span',
                '.mkdf-drop-down .wide .second .inner>ul>li.current-menu-item>a',
                '.mkdf-dark-header .mkdf-page-header>div:not(.mkdf-sticky-header):not(.fixed) .mkdf-fullscreen-menu-opener.mkdf-fm-opened',
                '.mkdf-light-header .mkdf-page-header>div:not(.mkdf-sticky-header):not(.fixed) .mkdf-fullscreen-menu-opener.mkdf-fm-opened',
                '.mkdf-fullscreen-menu-opener.mkdf-fm-opened',
                '.mkdf-header-vertical .mkdf-vertical-menu ul li ul li.current-menu-ancestor>a',
                '.mkdf-header-vertical .mkdf-vertical-menu ul li ul li.current-menu-item>a',
                '.mkdf-header-vertical .mkdf-vertical-menu ul li ul li.current_page_item>a',
                '.mkdf-header-vertical .mkdf-vertical-menu ul li ul li.mkdf-active-item>a',
                '.mkdf-header-vertical .mkdf-vertical-menu ul li .second .inner ul li a:hover',
                '.mkdf-dark-header.mkdf-header-vertical .mkdf-vertical-menu ul li a .second .inner ul li a:hover',
                '.mkdf-header-vertical .mkdf-vertical-area-widget-holder ul li a:hover',
                '.mkdf-mobile-header .mkdf-mobile-menu-opener.mkdf-mobile-menu-opened a',
                '.mkdf-mobile-header .mkdf-mobile-side-area .mkdf-close-mobile-side-area-holder i',
                '.mkdf-mobile-header .mkdf-mobile-nav ul li a:hover',
                '.mkdf-mobile-header .mkdf-mobile-nav ul li h6:hover',
                '.mkdf-mobile-header .mkdf-mobile-nav ul li.current-menu-ancestor>a',
                '.mkdf-mobile-header .mkdf-mobile-nav ul li.current-menu-ancestor>h6',
                '.mkdf-mobile-header .mkdf-mobile-nav ul li.current-menu-item>a',
                '.mkdf-mobile-header .mkdf-mobile-nav ul li.current-menu-item>h6',
                '.mkdf-popup-holder .mkdf-popup-close span',
                '.mkdf-search-page-holder article.sticky .mkdf-post-title a',
                '.mkdf-side-menu-button-opener.opened',
                '.mkdf-side-menu-button-opener:hover',
                '.mkdf-title-holder.mkdf-breadcrumbs-type .mkdf-breadcrumbs .mkdf-current',
                '.mkdf-title-holder.mkdf-breadcrumbs-type .mkdf-breadcrumbs a:hover',
                '.mkdf-title-holder.mkdf-standard-with-breadcrumbs-type .mkdf-breadcrumbs .mkdf-current',
                '.mkdf-title-holder.mkdf-standard-with-breadcrumbs-type .mkdf-breadcrumbs a:hover',
                '.widget.mkdf-author-info-widget .mkdf-aiw-text',
                '.mkdf-testimonials-holder.mkdf-testimonials-boxed .owl-item .mkdf-testimonial-triangle',
                '.mkdf-testimonials-holder .mkdf-testimonial-quote-image',
                '.mkdf-testimonials-holder.mkdf-testimonials-light .owl-nav .owl-next:hover',
                '.mkdf-testimonials-holder.mkdf-testimonials-light .owl-nav .owl-prev:hover',
                '.mkdf-accordion-holder.mkdf-ac-simple .mkdf-accordion-title.ui-state-active',
                '.mkdf-accordion-holder.mkdf-ac-simple .mkdf-accordion-title.ui-state-hover',
                '.mkdf-banner-holder .mkdf-banner-link-text .mkdf-banner-link-hover span',
                '.mkdf-icon-list-holder .mkdf-il-link:hover',
                '.mkdf-section-title-holder .mkdf-st-title .mkdf-st-title-colored',
                '.mkdf-social-share-holder.mkdf-dropdown .mkdf-social-share-dropdown-opener .social_share',
                '.mkdf-social-share-holder.mkdf-dropdown .mkdf-social-share-dropdown-opener:hover',
                '.mkdf-tabs.mkdf-tabs-standard .mkdf-tabs-nav li.ui-state-hover a',
                '.mkdf-tabs.mkdf-tabs-simple .mkdf-tabs-nav li.ui-state-active a',
                '.mkdf-tabs.mkdf-tabs-simple .mkdf-tabs-nav li.ui-state-hover a',
                '.mkdf-tabs.mkdf-tabs-vertical .mkdf-tabs-nav li.ui-state-hover a',
                '.mkdf-tabs.mkdf-tabs-boxed .mkdf-tabs-nav li.ui-state-active a',
                '.mkdf-tabs.mkdf-tabs-boxed .mkdf-tabs-nav li.ui-state-hover a',
                '.mkdf-twitter-list-holder .mkdf-twitter-icon',
                '.mkdf-twitter-list-holder .mkdf-tweet-text a:hover',
                '.mkdf-twitter-list-holder .mkdf-twitter-profile a:hover',
                '.widget.widget_mkdf_twitter_widget .mkdf-twitter-widget li .mkdf-twitter-icon',
                '.widget.widget_mkdf_twitter_widget .mkdf-twitter-widget li .mkdf-tweet-text a:hover'
            );

            $woo_color_selector = array();
            if(cocco_mikado_is_woocommerce_installed()) {
                $woo_color_selector = array(
                    '.woocommerce-pagination .page-numbers li a',
                    '.woocommerce-pagination .page-numbers li span',
                    '.woocommerce-page .mkdf-content .mkdf-quantity-buttons .mkdf-quantity-minus:hover',
                    '.woocommerce-page .mkdf-content .mkdf-quantity-buttons .mkdf-quantity-plus:hover',
                    'div.woocommerce .mkdf-quantity-buttons .mkdf-quantity-minus:hover',
                    'div.woocommerce .mkdf-quantity-buttons .mkdf-quantity-plus:hover',
                    'ul.products>.product .price',
                    'ul.products>.product .price ins',
                    '.mkdf-woo-single-page .mkdf-single-product-summary .price',
                    '.mkdf-woo-single-page .mkdf-single-product-summary .price ins',
                    '.mkdf-woo-single-page .mkdf-single-product-summary .product_meta>span a:hover',
                    '.mkdf-woo-single-page .yith-wcwl-add-to-wishlist .yith-wcwl-add-button:hover a',
                    '.mkdf-woo-single-page .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse:hover a',
                    '.mkdf-woo-single-page .woocommerce-tabs ul.tabs>li.active a',
                    '.mkdf-shopping-cart-dropdown .mkdf-item-info-holder .remove',
                    '.mkdf-shopping-cart-dropdown .mkdf-cart-bottom .mkdf-subtotal-holder .mkdf-total-amount',
                    '.widget.woocommerce.widget_layered_nav ul li.chosen a',
                    '.widget.woocommerce.widget_products ul li .product-title:hover',
                    '.widget.woocommerce.widget_recently_viewed_products ul li .product-title:hover',
                    '.widget.woocommerce.widget_top_rated_products ul li .product-title:hover',
                    '.widget.woocommerce.widget_products ul li .amount',
                    '.widget.woocommerce.widget_recently_viewed_products ul li .amount',
                    '.widget.woocommerce.widget_top_rated_products ul li .amount',
                    '.widget.woocommerce.widget_products ul li ins .amount',
                    '.widget.woocommerce.widget_recently_viewed_products ul li ins .amount',
                    '.widget.woocommerce.widget_top_rated_products ul li ins .amount',
                    '.mkdf-plc-holder .mkdf-plc-item .mkdf-plc-price',
                    '.mkdf-plc-holder .mkdf-plc-item .mkdf-plc-price ins',
                    '.mkdf-pls-holder .mkdf-pls-text .mkdf-pls-price',
                    '.mkdf-pl-holder .mkdf-pli .mkdf-pli-price',
                    '.mkdf-pl-holder .mkdf-pli .mkdf-pli-price ins',
                    '.mkdf-pl-holder .mkdf-pl-categories ul li a.active',
                    '.mkdf-pl-holder .mkdf-pl-categories ul li a:hover',
                    '#yith-quick-view-modal #yith-quick-view-content .product .mkdf-quick-view-gallery .owl-next .mkdf-prev-icon',
                    '#yith-quick-view-modal #yith-quick-view-content .product .mkdf-quick-view-gallery .owl-prev .mkdf-prev-icon',
                    '.yith-quick-view.yith-modal #yith-quick-view-content .product .mkdf-quick-view-gallery .owl-next .mkdf-prev-icon',
                    '.yith-quick-view.yith-modal #yith-quick-view-content .product .mkdf-quick-view-gallery .owl-prev .mkdf-prev-icon',
                    '#yith-quick-view-modal #yith-quick-view-content .summary .price',
                    '.yith-quick-view.yith-modal #yith-quick-view-content .summary .price',
                    '#yith-quick-view-modal #yith-quick-view-content .summary .mkdf-single-product-share-wish .yith-wcwl-wishlistaddedbrowse a:after',
                    '#yith-quick-view-modal #yith-quick-view-content .summary .mkdf-single-product-share-wish .yith-wcwl-wishlistexistsbrowse a:after',
                    '.yith-quick-view.yith-modal #yith-quick-view-content .summary .mkdf-single-product-share-wish .yith-wcwl-wishlistaddedbrowse a:after',
                    '.yith-quick-view.yith-modal #yith-quick-view-content .summary .mkdf-single-product-share-wish .yith-wcwl-wishlistexistsbrowse a:after',
                    '#yith-quick-view-modal #yith-quick-view-content .summary .mkdf-single-product-share-wish .mkdf-woo-social-share-holder>span',
                    '.yith-quick-view.yith-modal #yith-quick-view-content .summary .mkdf-single-product-share-wish .mkdf-woo-social-share-holder>span',
                    '#yith-quick-view-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a',
                    '#yith-quick-view-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a',
                    '#yith-quick-view-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a',
                    '.yith-quick-view.yith-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a',
                    '.yith-quick-view.yith-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a',
                    '.yith-quick-view.yith-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a',
                    '#yith-quick-view-modal #yith-quick-view-close',
                    '.yith-quick-view.yith-modal #yith-quick-view-close',
                    '.yith-wcwl-add-button a',
                    '.yith-wcwl-wishlistaddedbrowse a',
                    '.yith-wcwl-wishlistexistsbrowse a',
                    '.woocommerce-wishlist table.wishlist_table tbody tr td.product-name a:hover',
                    '.mkdf-single-product-summary .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a',
                    '.mkdf-single-product-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a',
                    '.mkdf-single-product-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a',
                    '.mkdf-single-product-summary .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a:after',
                    '.mkdf-single-product-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a:after',
                    '.mkdf-single-product-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a:after'
                );
            }

            $color_selector = array_merge($color_selector, $woo_color_selector);

            $color_important_selector = array(
                '.mkdf-dark-header.mkdf-header-vertical .mkdf-vertical-menu ul li ul li.current-menu-ancestor>a',
                '.mkdf-dark-header.mkdf-header-vertical .mkdf-vertical-menu ul li ul li.current-menu-item>a',
                '.mkdf-dark-header.mkdf-header-vertical .mkdf-vertical-menu ul li ul li.current_page_item>a',
                '.mkdf-dark-header.mkdf-header-vertical .mkdf-vertical-menu>ul>li.current-menu-ancestor>a',
                '.mkdf-dark-header.mkdf-header-vertical .mkdf-vertical-menu>ul>li.mkdf-active-item>a',
                '.mkdf-btn.mkdf-btn-simple:not(.mkdf-btn-custom-hover-color):not(.mkdf-btn-underline):hover'
            );

            $background_color_selector = array(
                '.mkdf-cocco-loader .mkdf-icon-rocket-bg',
                '.mkdf-st-loader .pulse',
                '.mkdf-st-loader .double_pulse .double-bounce1',
                '.mkdf-st-loader .double_pulse .double-bounce2',
                '.mkdf-st-loader .cube',
                '.mkdf-st-loader .rotating_cubes .cube1',
                '.mkdf-st-loader .rotating_cubes .cube2',
                '.mkdf-st-loader .stripes>div',
                '.mkdf-st-loader .wave>div',
                '.mkdf-st-loader .two_rotating_circles .dot1',
                '.mkdf-st-loader .two_rotating_circles .dot2',
                '.mkdf-st-loader .five_rotating_circles .container1>div',
                '.mkdf-st-loader .five_rotating_circles .container2>div',
                '.mkdf-st-loader .five_rotating_circles .container3>div',
                '.mkdf-st-loader .atom .ball-1:before',
                '.mkdf-st-loader .atom .ball-2:before',
                '.mkdf-st-loader .atom .ball-3:before',
                '.mkdf-st-loader .atom .ball-4:before',
                '.mkdf-st-loader .clock .ball:before',
                '.mkdf-st-loader .mitosis .ball',
                '.mkdf-st-loader .lines .line1',
                '.mkdf-st-loader .lines .line2',
                '.mkdf-st-loader .lines .line3',
                '.mkdf-st-loader .lines .line4',
                '.mkdf-st-loader .fussion .ball',
                '.mkdf-st-loader .fussion .ball-1',
                '.mkdf-st-loader .fussion .ball-2',
                '.mkdf-st-loader .fussion .ball-3',
                '.mkdf-st-loader .fussion .ball-4',
                '.mkdf-st-loader .wave_circles .ball',
                '.mkdf-st-loader .pulse_circles .ball',
                '#submit_comment',
                '.post-password-form input[type=submit]',
                'input.wpcf7-form-control.wpcf7-submit',
                '.mkdf-owl-slider .owl-dots .owl-dot.active span',
                '.mkdf-owl-slider .owl-dots .owl-dot:hover span',
                '#mkdf-back-to-top .mkdf-icon-stack-outer .mkdf-icon-stack',
                'footer .widget.widget_archive ul li a:before',
                'footer .widget.widget_categories ul li a:before',
                'footer .widget.widget_meta ul li a:before',
                'footer .widget.widget_nav_menu ul li a:before',
                'footer .widget.widget_pages ul li a:before',
                'footer .widget.widget_recent_entries ul li a:before',
                'footer .widget.mkdf-recent-post-widget .mkdf-recent-posts .mkdf-rp-item a .mkdf-rp-date',
                '.mkdf-fullscreen-sidebar .widget.widget_archive ul li a:before',
                '.mkdf-fullscreen-sidebar .widget.widget_categories ul li a:before',
                '.mkdf-fullscreen-sidebar .widget.widget_meta ul li a:before',
                '.mkdf-fullscreen-sidebar .widget.widget_nav_menu ul li a:before',
                '.mkdf-fullscreen-sidebar .widget.widget_pages ul li a:before',
                '.mkdf-fullscreen-sidebar .widget.widget_recent_entries ul li a:before',
                '.mkdf-fullscreen-sidebar .widget.mkdf-recent-post-widget .mkdf-recent-posts .mkdf-rp-item a .mkdf-rp-date',
                '.mkdf-side-menu .widget.widget_archive ul li a:before',
                '.mkdf-side-menu .widget.widget_categories ul li a:before',
                '.mkdf-side-menu .widget.widget_meta ul li a:before',
                '.mkdf-side-menu .widget.widget_nav_menu ul li a:before',
                '.mkdf-side-menu .widget.widget_pages ul li a:before',
                '.mkdf-side-menu .widget.widget_recent_entries ul li a:before',
                '.mkdf-side-menu .widget.mkdf-recent-post-widget .mkdf-recent-posts .mkdf-rp-item a .mkdf-rp-date',
                '.wpb_widgetised_column .widget.widget_archive ul li a:before',
                '.wpb_widgetised_column .widget.widget_categories ul li a:before',
                '.wpb_widgetised_column .widget.widget_meta ul li a:before',
                '.wpb_widgetised_column .widget.widget_nav_menu ul li a:before',
                '.wpb_widgetised_column .widget.widget_pages ul li a:before',
                '.wpb_widgetised_column .widget.widget_recent_entries ul li a:before',
                'aside.mkdf-sidebar .widget.widget_archive ul li a:before',
                'aside.mkdf-sidebar .widget.widget_categories ul li a:before',
                'aside.mkdf-sidebar .widget.widget_meta ul li a:before',
                'aside.mkdf-sidebar .widget.widget_nav_menu ul li a:before',
                'aside.mkdf-sidebar .widget.widget_pages ul li a:before',
                'aside.mkdf-sidebar .widget.widget_recent_entries ul li a:before',
                '.wpb_widgetised_column .widget.mkdf-recent-post-widget .mkdf-recent-posts .mkdf-rp-item a .mkdf-rp-date',
                'aside.mkdf-sidebar .widget.mkdf-recent-post-widget .mkdf-recent-posts .mkdf-rp-item a .mkdf-rp-date',
                '.mkdf-sidebar-holder.mkdf-sidebar-boxed aside.mkdf-sidebar .widget.widget_archive ul li a:before',
                '.mkdf-sidebar-holder.mkdf-sidebar-boxed aside.mkdf-sidebar .widget.widget_categories ul li a:before',
                '.mkdf-sidebar-holder.mkdf-sidebar-boxed aside.mkdf-sidebar .widget.widget_meta ul li a:before',
                '.mkdf-sidebar-holder.mkdf-sidebar-boxed aside.mkdf-sidebar .widget.widget_nav_menu ul li a:before',
                '.mkdf-sidebar-holder.mkdf-sidebar-boxed aside.mkdf-sidebar .widget.widget_pages ul li a:before',
                '.mkdf-sidebar-holder.mkdf-sidebar-boxed aside.mkdf-sidebar .widget.widget_recent_entries ul li a:before',
                '.mkdf-sidebar-holder.mkdf-sidebar-boxed aside.mkdf-sidebar .widget.mkdf-recent-post-widget .mkdf-recent-posts .mkdf-rp-item a .mkdf-rp-date',
                '.mkdf-sidebar-holder.mkdf-sidebar-boxed aside.mkdf-sidebar .widget:nth-child(3n+2) .mkdf-widget-title-holder',
                '.mkdf-sidebar-holder.mkdf-sidebar-boxed aside.mkdf-sidebar .widget:nth-child(3n+3) .mkdf-widget-title-holder',
                '.mkdf-blog-holder article .mkdf-post-info-top>div.mkdf-post-info-date',
                '.mkdf-blog-holder article.format-audio .mkdf-blog-audio-holder .mejs-container .mejs-controls>.mejs-time-rail .mejs-time-total .mejs-time-current',
                '.mkdf-blog-holder article.format-audio .mkdf-blog-audio-holder .mejs-container .mejs-controls>a.mejs-horizontal-volume-slider .mejs-horizontal-volume-current',
                '.mkdf-blog-pagination ul li a.mkdf-pag-active',
                '.mkdf-blog-pagination ul li a:hover',
                '.mkdf-bl-standard-pagination ul li a:hover',
                '.mkdf-bl-standard-pagination ul li.mkdf-bl-pag-active a',
                '.mkdf-author-description .mkdf-author-description-text-holder .mkdf-author-social-icons a',
                '.mkdf-single-links-pages a:hover',
                '.mkdf-single-links-pages>span:hover',
                '.mkdf-blog-holder.mkdf-blog-single article .mkdf-post-info-bottom .mkdf-post-info-bottom-left>div.mkdf-post-info-date',
                '.mkdf-blog-list-holder .mkdf-bli-image-holder .mkdf-post-info-date',
                '.mkdf-blog-list-holder .mkdf-bli-info>div.mkdf-post-info-date',
                '.mkdf-blog-list-holder.mkdf-bl-minimal .mkdf-post-info-date',
                '.mkdf-blog-list-holder.mkdf-bl-simple .mkdf-bli-content .mkdf-post-info-date',
                '.mkdf-drop-down .second .inner ul li a .item_outer .item_text:before',
                '.mkdf-top-bar',
                '.mkdf-search-cover',
                'a.mkdf-social-icon-widget-holder.mkdf-social-icon-circle',
                'a.mkdf-social-icon-widget-holder.mkdf-social-icon-square',
                '.mkdf-social-icons-group-widget.mkdf-square-icons .mkdf-social-icon-widget-holder:hover',
                '.mkdf-social-icons-group-widget.mkdf-square-icons.mkdf-light-skin .mkdf-social-icon-widget-holder:hover',
                '.mkdf-testimonials-holder.mkdf-testimonials-boxed .owl-item .mkdf-testimonial-text',
                '.mkdf-accordion-holder.mkdf-ac-boxed .mkdf-accordion-title.ui-state-active',
                '.mkdf-accordion-holder.mkdf-ac-boxed .mkdf-accordion-title.ui-state-hover',
                '.mkdf-btn.mkdf-btn-solid',
                '.mkdf-iwt.mkdf-custom-icon-mkdf-circle .mkdf-iwt-custom-icon .mkdf-iwt-custom-icon-shape',
                '.mkdf-iwt.mkdf-custom-icon-mkdf-square .mkdf-iwt-custom-icon .mkdf-iwt-custom-icon-shape',
                '.mkdf-icon-shortcode.mkdf-circle .mkdf-icon-bckg-holder',
                '.mkdf-icon-shortcode.mkdf-dropcaps.mkdf-circle .mkdf-icon-bckg-holder',
                '.mkdf-icon-shortcode.mkdf-square .mkdf-icon-bckg-holder',
                '.mkdf-price-plan .mkdf-pp-inner.mkdf-pp-title-holder',
                '.mkdf-price-table .mkdf-pt-inner ul li.mkdf-pt-title-holder',
                '.mkdf-process-holder .mkdf-process-circle',
                '.mkdf-process-holder .mkdf-process-line',
                '.mkdf-progress-bar .mkdf-pb-content-holder .mkdf-pb-content',
                '.mkdf-section-title-holder.mkdf-section-title-boxed .mkdf-st-title',
                '.mkdf-social-share-holder.mkdf-dropdown .mkdf-social-share-dropdown ul li',
                '.mkdf-tabs.mkdf-tabs-standard .mkdf-tabs-nav li.ui-state-active a',
                '.mkdf-tabs.mkdf-tabs-vertical .mkdf-tabs-nav li.ui-state-active a',
                '.mkdf-team-holder .mkdf-team-position',
                '.mkdf-video-button-holder.mkdf-vb-has-img .mkdf-video-button-play .mkdf-video-button-play-inner .mkdf-video-button-outer',
                '.mkdf-video-button-holder.mkdf-vb-has-img .mkdf-video-button-play-image .mkdf-video-button-play-inner .mkdf-video-button-outer',
                '.mkdf-instagram-feed li a .mkdf-instagram-icon',
            );

            $woo_background_color_selector = array();
            if(cocco_mikado_is_woocommerce_installed()) {
                $woo_background_color_selector = array(
                    '.woocommerce-page .mkdf-content .wc-forward:not(.added_to_cart):not(.checkout-button)',
                    '.woocommerce-page .mkdf-content a.added_to_cart',
                    '.woocommerce-page .mkdf-content a.button',
                    '.woocommerce-page .mkdf-content button[type=submit]:not(.mkdf-woo-search-widget-button)',
                    'div.woocommerce .wc-forward:not(.added_to_cart):not(.checkout-button)',
                    'div.woocommerce a.added_to_cart',
                    'div.woocommerce a.button',
                    'div.woocommerce button[type=submit]:not(.mkdf-woo-search-widget-button)',
                    '.woocommerce-page .mkdf-content input[type=submit]',
                    'div.woocommerce input[type=submit]',
                    '.woocommerce .mkdf-new-product',
                    '.woocommerce .mkdf-onsale',
                    '.woocommerce .mkdf-out-of-stock',
                    '.woocommerce-pagination .page-numbers li a.current',
                    '.woocommerce-pagination .page-numbers li a:hover',
                    '.woocommerce-pagination .page-numbers li span.current',
                    '.woocommerce-pagination .page-numbers li span:hover',
                    '.mkdf-shopping-cart-holder .mkdf-header-cart .mkdf-cart-number',
                    '.mkdf-shopping-cart-dropdown .mkdf-cart-bottom .mkdf-view-cart',
                    '.widget.woocommerce.widget_price_filter .price_slider_wrapper .ui-widget-content .ui-slider-handle',
                    '.widget.woocommerce.widget_price_filter .price_slider_wrapper .ui-widget-content .ui-slider-range',
                    '.widget.woocommerce.widget_product_categories ul li:before',
                    '.mkdf-plc-holder .mkdf-plc-item .mkdf-plc-image-outer .mkdf-plc-image .mkdf-plc-new-product',
                    '.mkdf-plc-holder .mkdf-plc-item .mkdf-plc-image-outer .mkdf-plc-image .mkdf-plc-onsale',
                    '.mkdf-plc-holder .mkdf-plc-item .mkdf-plc-image-outer .mkdf-plc-image .mkdf-plc-out-of-stock',
                    '.mkdf-plc-holder .mkdf-plc-item .mkdf-plc-image-outer .mkdf-plc-image .mkdf-pli-new-product',
                    '.mkdf-plc-holder .mkdf-plc-item .mkdf-plc-add-to-cart.mkdf-default-skin .added_to_cart',
                    '.mkdf-plc-holder .mkdf-plc-item .mkdf-plc-add-to-cart.mkdf-default-skin .button',
                    '.mkdf-plc-holder .mkdf-plc-item .mkdf-plc-add-to-cart.mkdf-light-skin .added_to_cart:hover',
                    '.mkdf-plc-holder .mkdf-plc-item .mkdf-plc-add-to-cart.mkdf-light-skin .button:hover',
                    '.mkdf-plc-holder .mkdf-plc-item .mkdf-plc-add-to-cart.mkdf-dark-skin .added_to_cart:hover',
                    '.mkdf-plc-holder .mkdf-plc-item .mkdf-plc-add-to-cart.mkdf-dark-skin .button:hover',
                    '.mkdf-pl-holder .mkdf-pli-inner .mkdf-pli-image .mkdf-pli-new-product',
                    '.mkdf-pl-holder .mkdf-pli-inner .mkdf-pli-image .mkdf-pli-onsale',
                    '.mkdf-pl-holder .mkdf-pli-inner .mkdf-pli-image .mkdf-pli-out-of-stock',
                    '.mkdf-pl-holder .mkdf-pli-inner .mkdf-pli-text-inner .mkdf-pli-add-to-cart.mkdf-default-skin .added_to_cart',
                    '.mkdf-pl-holder .mkdf-pli-inner .mkdf-pli-text-inner .mkdf-pli-add-to-cart.mkdf-default-skin .button',
                    '.mkdf-pl-holder .mkdf-pli-inner .mkdf-pli-text-inner .mkdf-pli-add-to-cart.mkdf-light-skin .added_to_cart:hover',
                    '.mkdf-pl-holder .mkdf-pli-inner .mkdf-pli-text-inner .mkdf-pli-add-to-cart.mkdf-light-skin .button:hover',
                    '.mkdf-pl-holder .mkdf-pli-inner .mkdf-pli-text-inner .mkdf-pli-add-to-cart.mkdf-dark-skin .added_to_cart:hover',
                    '.mkdf-pl-holder .mkdf-pli-inner .mkdf-pli-text-inner .mkdf-pli-add-to-cart.mkdf-dark-skin .button:hover',
                    '.yith-wcwl-add-to-wishlist:hover',
                    '.woocommerce-wishlist table.wishlist_table tbody tr td.product-add-to-cart a'
                );
            }

            $background_color_selector = array_merge($background_color_selector, $woo_background_color_selector);

            $background_color_important_selector = array(

            );

            $darken_background_color_selector = array(
                '#submit_comment:hover',
                '.post-password-form input[type=submit]:hover',
                'input.wpcf7-form-control.wpcf7-submit:not(.mkdf-cf7-submit-with-icon):hover',
            );

            $woo_darken_background_selector = array();
            if(cocco_mikado_is_woocommerce_installed()) {
                $woo_darken_background_selector = array(
                    '.woocommerce-page .mkdf-content .wc-forward:not(.added_to_cart):not(.checkout-button):hover',
                    '.woocommerce-page .mkdf-content a.added_to_cart:hover',
                    '.woocommerce-page .mkdf-content a.button:hover',
                    '.woocommerce-page .mkdf-content button[type=submit]:not(.mkdf-woo-search-widget-button):hover',
                    'div.woocommerce .wc-forward:not(.added_to_cart):not(.checkout-button):hover',
                    'div.woocommerce a.added_to_cart:hover',
                    'div.woocommerce a.button:hover',
                    'div.woocommerce button[type=submit]:not(.mkdf-woo-search-widget-button):hover',
                    '.woocommerce-page .mkdf-content input[type=submit]:hover',
                    'div.woocommerce input[type=submit]:hover',
                    '.mkdf-shopping-cart-dropdown .mkdf-cart-bottom .mkdf-view-cart:hover',
                    '.mkdf-plc-holder .mkdf-plc-item .mkdf-plc-add-to-cart.mkdf-default-skin .added_to_cart:hover',
                    '.mkdf-plc-holder .mkdf-plc-item .mkdf-plc-add-to-cart.mkdf-default-skin .button:hover',
                    '.mkdf-pl-holder .mkdf-pli-inner .mkdf-pli-text-inner .mkdf-pli-add-to-cart.mkdf-default-skin .added_to_cart:hover',
                    '.mkdf-pl-holder .mkdf-pli-inner .mkdf-pli-text-inner .mkdf-pli-add-to-cart.mkdf-default-skin .button:hover'
                );
            }

            $darken_background_color_selector = array_merge($darken_background_color_selector, $woo_darken_background_selector);

            $background_darken_color_important_selector = array(
                '.mkdf-btn.mkdf-btn-solid:not(.mkdf-btn-icon-animate):not(.mkdf-btn-custom-hover-bg):hover'
            );

            $border_color_selector = array(
                '.mkdf-cocco-loader .mkdf-icon-rocket-bg:before',
                '.mkdf-st-loader .pulse_circles .ball',
                '.mkdf-owl-slider+.mkdf-slider-thumbnail>.mkdf-slider-thumbnail-item.active img',
                '#mkdf-back-to-top .mkdf-icon-stack-outer:after',
                '#mkdf-back-to-top .mkdf-icon-stack-outer .mkdf-icon-stack',
                '.widget.mkdf-author-info-widget',
            );

            $woo_border_color_selector = array();
            if(cocco_mikado_is_woocommerce_installed()) {
                $woo_border_color_selector = array(
                    '.woocommerce .mkdf-onsale',
                    '.mkdf-plc-holder .mkdf-plc-item .mkdf-plc-image-outer .mkdf-plc-image .mkdf-plc-onsale',
                    '.mkdf-pl-holder .mkdf-pli-inner .mkdf-pli-image .mkdf-pli-onsale'
                );
            }

            $border_color_selector = array_merge($border_color_selector, $woo_border_color_selector);

            $border_darken_color_important_selector = array(
                '.mkdf-btn.mkdf-btn-solid:not(.mkdf-btn-icon-animate):not(.mkdf-btn-custom-border-hover):hover'
            );


            $first_darken_color = cocco_mikado_darken_color($first_main_color, -22);

            echo cocco_mikado_dynamic_css($color_selector, array('color' => $first_main_color));
            echo cocco_mikado_dynamic_css($color_important_selector, array('color' => $first_main_color.'!important'));
            echo cocco_mikado_dynamic_css($background_color_selector, array('background-color' => $first_main_color));
            echo cocco_mikado_dynamic_css($background_color_important_selector, array('color' => $first_main_color.'!important'));
            echo cocco_mikado_dynamic_css($darken_background_color_selector, array('background-color' => $first_darken_color));
            echo cocco_mikado_dynamic_css($border_color_selector, array('border-color' => $first_main_color));
            echo cocco_mikado_dynamic_css($border_darken_color_important_selector, array('border-color' => $first_darken_color.'!important'));
            echo cocco_mikado_dynamic_css($background_darken_color_important_selector, array('background-color' => $first_darken_color.'!important'));


            $first_transparency_085_color = cocco_mikado_rgba_color($first_main_color,0.85);
            $background_transparency_085_selector = array(
                '.mkdf-blog-slider-holder .mkdf-item-text-wrapper',
                '.mkdf-image-gallery.mkdf-image-hover-shader .mkdf-ig-image a:after',
                '.mkdf-image-gallery.mkdf-image-hover-zoom-shader .mkdf-ig-image a:after',

            );

            $first_transparency_01_color = cocco_mikado_rgba_color($first_main_color,0.1);
            $background_transparency_01_selector = array(
                '#mkdf-back-to-top .mkdf-icon-stack-outer',
            );


            echo cocco_mikado_dynamic_css($background_transparency_085_selector, array('background-color' => $first_transparency_085_color));
            echo cocco_mikado_dynamic_css($background_transparency_01_selector, array('background-color' => $first_transparency_01_color));

        }

        $second_color = cocco_mikado_options()->getOptionValue('second_color');
        if(!empty($second_color)) {
            $color_selector = array(
                'blockquote',
                '.mkdf-owl-slider .owl-nav .owl-next .mkdf-arrow-stack-outer .mkdf-arrow-stack .mkdf-prev-icon:hover',
                '.mkdf-owl-slider .owl-nav .owl-prev .mkdf-arrow-stack-outer .mkdf-arrow-stack .mkdf-prev-icon:hover',
                '.mkdf-owl-slider .owl-nav .owl-next .mkdf-arrow-stack-outer .mkdf-arrow-stack .mkdf-next-icon',
                '.mkdf-owl-slider .owl-nav .owl-prev .mkdf-arrow-stack-outer .mkdf-arrow-stack .mkdf-next-icon',
                '.mkdf-popup-holder .mkdf-popup-prevent-input.mkdf-popup-prevent-clicked span',
                '.mkdf-testimonials-holder.mkdf-testimonials-boxed .owl-item:nth-child(3n+2) .mkdf-testimonial-triangle'
            );

            $woo_color_selector = array();
            if(cocco_mikado_is_woocommerce_installed()) {
                $woo_color_selector = array(
                    '.mkdf-woo-single-page .mkdf-single-product-summary p.stock.in-stock',
                    '.mkdf-woo-single-page .mkdf-single-product-summary p.stock.out-of-stock',
                    '.mkdf-product-categories-holder .mkdf-product-category:nth-child(3n+3) .mkdf-product-category-inner:after',
                    '#yith-quick-view-modal #yith-quick-view-content .product .mkdf-quick-view-gallery .owl-next .mkdf-next-icon',
                    '#yith-quick-view-modal #yith-quick-view-content .product .mkdf-quick-view-gallery .owl-prev .mkdf-next-icon',
                    '.yith-quick-view.yith-modal #yith-quick-view-content .product .mkdf-quick-view-gallery .owl-next .mkdf-next-icon',
                    '.yith-quick-view.yith-modal #yith-quick-view-content .product .mkdf-quick-view-gallery .owl-prev .mkdf-next-icon',
                    '.mkdf-pl-holder .mkdf-pli-inner .mkdf-pli-text-inner .mkdf-yith-wcqv-holder .yith-wcqv-button',
                    '.mkdf-plc-holder .mkdf-plc-item .mkdf-plc-text-inner .mkdf-yith-wcqv-holder .yith-wcqv-button',
                    'ul.products>.product .mkdf-pl-inner .mkdf-pl-text-inner .mkdf-yith-wcqv-holder .yith-wcqv-button'
                );
            }

            $color_selector = array_merge($color_selector, $woo_color_selector);

            $color_important_selector = array(
            );

            $background_color_selector = array(
                '.mkdf-comment-form',
                'footer .widget.widget_search .input-holder',
                '.mkdf-fullscreen-sidebar .widget.widget_search .input-holder',
                '.mkdf-side-menu .widget #wp-calendar td#today',
                '.mkdf-side-menu .widget.widget_search .input-holder',
                '.mkdf-side-menu .widget.widget_search .input-holder button',
                '.wpb_widgetised_column .widget #wp-calendar td#today',
                'aside.mkdf-sidebar .widget #wp-calendar td#today',
                '.wpb_widgetised_column .widget.widget_search .input-holder',
                'aside.mkdf-sidebar .widget.widget_search .input-holder',
                '.wpb_widgetised_column .widget.widget_search .input-holder button',
                'aside.mkdf-sidebar .widget.widget_search .input-holder button',
                '.mkdf-sidebar-holder.mkdf-sidebar-boxed aside.mkdf-sidebar .widget #wp-calendar td#today',
                '.mkdf-sidebar-holder.mkdf-sidebar-boxed aside.mkdf-sidebar .widget.widget_search .input-holder',
                '.mkdf-sidebar-holder.mkdf-sidebar-boxed aside.mkdf-sidebar .widget.widget_search .input-holder button',
                '.mkdf-sidebar-holder.mkdf-sidebar-boxed aside.mkdf-sidebar .widget .wpcf7',
                '.mkdf-blog-list-holder.mkdf-bl-simple .mkdf-bl-item:nth-child(3n+2) .mkdf-post-info-date',
                '.mkdf-testimonials-holder.mkdf-testimonials-boxed .owl-item:nth-child(3n+2) .mkdf-testimonial-text',
                '.mkdf-working-hours-holder.mkdf-wh-with-frame'
            );

            $woo_background_color_selector = array();
            if(cocco_mikado_is_woocommerce_installed()) {
                $woo_background_color_selector = array(
                    '.mkdf-pl-holder .mkdf-pli-inner .mkdf-pli-text-inner .mkdf-yith-wcqv-holder .yith-wcqv-button:hover',
                    '.mkdf-plc-holder .mkdf-plc-item .mkdf-plc-text-inner .mkdf-yith-wcqv-holder .yith-wcqv-button:hover',
                    'ul.products>.product .mkdf-pl-inner .mkdf-pl-text-inner .mkdf-yith-wcqv-holder .yith-wcqv-button:hover'
                );
            }

            $background_color_selector = array_merge($background_color_selector, $woo_background_color_selector);

            $border_color_selector = array(
                '.mkdf-blog-holder article.format-quote .mkdf-post-text'
            );

            echo cocco_mikado_dynamic_css($color_selector, array('color' => $second_color));
            echo cocco_mikado_dynamic_css($color_important_selector, array('color' => $second_color.'!important'));
            echo cocco_mikado_dynamic_css($background_color_selector, array('background-color' => $second_color));
            echo cocco_mikado_dynamic_css($border_color_selector, array('border-color' => $second_color));

            $second_transparency_01_color = cocco_mikado_rgba_color($second_color,0.1);
            $background_transparency_01_selector = array(
                '.mkdf-working-hours-holder '

            );

            $second_transparency_02_color = cocco_mikado_rgba_color($second_color,0.2);
            $border_transparency_02_selector = array(
                '.mkdf-working-hours-holder'
            );


            echo cocco_mikado_dynamic_css($background_transparency_01_selector, array('background-color' => $second_transparency_01_color));
            echo cocco_mikado_dynamic_css($border_transparency_02_selector, array('background-color' => $second_transparency_02_color));

        }

        $third_color = cocco_mikado_options()->getOptionValue('third_color');
        if(!empty($third_color)) {
            $color_selector = array(
                '.mkdf-testimonials-holder.mkdf-testimonials-boxed .owl-item:nth-child(3n+3) .mkdf-testimonial-triangle'
            );

            $woo_color_selector = array();
            if(cocco_mikado_is_woocommerce_installed()) {
                $woo_color_selector = array(
                    '.mkdf-pl-holder .mkdf-pli .mkdf-pli-rating',
                    '.mkdf-plc-holder .mkdf-plc-item .mkdf-plc-rating',
                    '.mkdf-pls-holder .mkdf-pls-text .mkdf-pls-rating',
                    '.mkdf-product-info .mkdf-pi-rating',
                    '.mkdf-woo-single-page .woocommerce-tabs #reviews .comment-respond .stars a.active:after',
                    '.mkdf-woo-single-page .woocommerce-tabs #reviews .comment-respond .stars a:before',
                    '.woocommerce .star-rating',
                    '.mkdf-woo-single-page .mkdf-single-product-summary .woocommerce-product-rating .star-rating',
                    '.mkdf-woo-single-page .related.products .product .star-rating',
                    '.mkdf-woo-single-page .upsells.products .product .star-rating',
                    '.mkdf-product-categories-holder .mkdf-product-category .mkdf-product-category-inner:after',
                    '.mkdf-wishlist-widget-holder a .mkdf-wishlist-widget-icon:after'
                );
            }

            $color_selector = array_merge($color_selector, $woo_color_selector);

            $color_important_selector = array(
            );

            $background_color_selector = array(
                '.mkdf-blog-list-holder.mkdf-bl-simple .mkdf-bl-item:nth-child(3n+3) .mkdf-post-info-date',
                '.mkdf-testimonials-holder.mkdf-testimonials-boxed .owl-item:nth-child(3n+3) .mkdf-testimonial-text'
            );

            $woo_background_color_selector = array();
            if(cocco_mikado_is_woocommerce_installed()) {
                $woo_background_color_selector = array(
                    '.woocommerce .mkdf-new-product',
                    '.mkdf-plc-holder .mkdf-plc-item .mkdf-plc-image-outer .mkdf-plc-image .mkdf-plc-new-product',
                    '.mkdf-pl-holder .mkdf-pli-inner .mkdf-pli-image .mkdf-pli-new-product'
                );
            }

            $background_color_selector = array_merge($background_color_selector, $woo_background_color_selector);

            $border_color_selector = array(
                '.mkdf-blog-holder article.format-link .mkdf-post-text',
            );

            echo cocco_mikado_dynamic_css($color_selector, array('color' => $third_color));
            echo cocco_mikado_dynamic_css($color_important_selector, array('color' => $third_color.'!important'));
            echo cocco_mikado_dynamic_css($background_color_selector, array('background-color' => $third_color));
            echo cocco_mikado_dynamic_css($border_color_selector, array('border-color' => $third_color));

            $third_transparency_08_color = cocco_mikado_rgba_color($third_color,0.8);
            $border_transparency_08_selector = array(
                '.mkdf-comment-holder .mkdf-comment-list .children .mkdf-comment'
            );

            $third_transparency_01_color = cocco_mikado_rgba_color($third_color,0.1);
            $background_transparency_01_selector = array(
                '.mkdf-comment-holder .mkdf-comment-list .children .mkdf-comment'
            );


            echo cocco_mikado_dynamic_css($border_transparency_08_selector, array('border-color' => $third_transparency_08_color));
            echo cocco_mikado_dynamic_css($background_transparency_01_selector, array('background-color' => $third_transparency_01_color));
        }

        $fourth_color = cocco_mikado_options()->getOptionValue('fourth_color');
        if(!empty($fourth_color)) {
            $color_selector = array(
            );

            $woo_color_selector = array();
            if(cocco_mikado_is_woocommerce_installed()) {
                $woo_color_selector = array(
                    '.mkdf-shopping-cart-holder .mkdf-header-cart .mkdf-cart-icon:after'
                );
            }

            $color_selector = array_merge($color_selector, $woo_color_selector);

            $color_important_selector = array(
            );

            $background_color_selector = array(
                '.mkdf-comment-holder .mkdf-comment-text .comment-edit-link:after',
                '.mkdf-comment-holder .mkdf-comment-text .comment-reply-link:after',
                '.mkdf-comment-holder .mkdf-comment-text .replay:after',
                '.mkdf-comment-holder .mkdf-comment-text #cancel-comment-reply-link:after',
                '.mkdf-main-menu>ul>li>a>span.item_outer:after',
                '.mkdf-main-menu>ul>li.mkdf-active-item>a .item_outer:after',
                '.mkdf-drop-down .wide .second .inner>ul>li>a .item_outer .item_text:after',
                '.mkdf-drop-down .wide .second .inner>ul>li.current-menu-ancestor>a .item_outer .item_text:after',
                'nav.mkdf-fullscreen-menu ul li ul li.current-menu-ancestor>a span:after',
                'nav.mkdf-fullscreen-menu ul li ul li.current-menu-item>a span:after',
                'nav.mkdf-fullscreen-menu>ul>li.mkdf-active-item>a span:after',
                'nav.mkdf-fullscreen-menu>ul>li>a span:after',
                '.mkdf-header-vertical .mkdf-vertical-menu>ul>li>a span.item_text:after',
                '.mkdf-title-holder.mkdf-centered-type .mkdf-title-inner .mkdf-title-info .mkdf-title-info-holder',
                '.mkdf-title-holder.mkdf-standard-with-breadcrumbs-type .mkdf-title-info .mkdf-title-info-holder',
                '.mkdf-title-holder.mkdf-standard-type .mkdf-title-info .mkdf-title-info-holder',
                '.mkdf-btn.mkdf-btn-simple.mkdf-btn-underline:after',
                '.mkdf-section-title-holder.mkdf-section-title-boxed .mkdf-st-subtitle'
            );

            $woo_background_color_selector = array();
            if(cocco_mikado_is_woocommerce_installed()) {
                $woo_background_color_selector = array(
                );
            }

            $background_color_selector = array_merge($background_color_selector, $woo_background_color_selector);

            $border_color_selector = array(
                '.mkdf-tabs.mkdf-tabs-boxed .ui-widget-content',
                '.mkdf-tabs.mkdf-tabs-boxed .mkdf-tabs-nav li'
            );

            $woo_border_color_selector = array();
            if(cocco_mikado_is_woocommerce_installed()) {
                $woo_border_color_selector = array(
                    '.mkdf-woo-single-page .woocommerce-tabs ul.tabs>li',
                    '.mkdf-woo-single-page .woocommerce-tabs .entry-content'
                );
            }

            $border_color_selector = array_merge($border_color_selector, $woo_border_color_selector);

            echo cocco_mikado_dynamic_css($color_selector, array('color' => $fourth_color));
            echo cocco_mikado_dynamic_css($color_important_selector, array('color' => $fourth_color.'!important'));
            echo cocco_mikado_dynamic_css($background_color_selector, array('background-color' => $fourth_color));
            echo cocco_mikado_dynamic_css($border_color_selector, array('border-color' => $fourth_color));

            $fourth_transparency_08_color = cocco_mikado_rgba_color($fourth_color,0.8);
            $border_transparency_08_selector = array(
                '#respond textarea:focus',
                '.mkdf-style-form textarea:focus',
                '#respond input[type="text"]:focus',
                '#respond input[type="email"]:focus',
                'input[type="text"]:focus',
                'input[type="email"]:focus',
                'input[type="password"]:focus',
                '.wpcf7-form-control.wpcf7-text:focus',
                '.wpcf7-form-control.wpcf7-number:focus',
                '.wpcf7-form-control.wpcf7-date:focus',
                '.wpcf7-form-control.wpcf7-textarea:focus',
                '.wpcf7-form-control.wpcf7-select:focus',
                '.wpcf7-form-control.wpcf7-quiz:focus',
                '.mkdf-comment-holder .mkdf-comment-list .mkdf-comment',
                'footer .widget.widget_search .input-holder:focus',
                '.mkdf-fullscreen-sidebar .widget.widget_search .input-holder:focus',
                '.mkdf-side-menu .widget.widget_search .input-holder:focus',
                'aside.mkdf-sidebar .widget.widget_search .input-holder:focus',
                '.wpb_widgetised_column .widget.widget_search .input-holder:focus',
                '.mkdf-sidebar-holder.mkdf-sidebar-boxed aside.mkdf-sidebar .widget.widget_search .input-holder:focus'
            );

            $fourth_transparency_05_color = cocco_mikado_rgba_color($fourth_color,0.5);
            $border_transparency_05_selector = array(
                '.wpcf7-form-control.wpcf7-text:focus',
                '.wpcf7-form-control.wpcf7-number:focus',
                '.wpcf7-form-control.wpcf7-date:focus',
                '.wpcf7-form-control.wpcf7-textarea:focus',
                '.wpcf7-form-control.wpcf7-select:focus',
                '.wpcf7-form-control.wpcf7-quiz:focus'
            );

            $fourth_transparency_01_color = cocco_mikado_rgba_color($fourth_color,0.1);
            $background_transparency_01_selector = array(
                '.mkdf-comment-holder .mkdf-comment-list .mkdf-comment'
            );

            $fourth_transparency_02_color = cocco_mikado_rgba_color($fourth_color,0.2);
            $background_transparency_02_selector = array(
                '.mkdf-tabs.mkdf-tabs-boxed .mkdf-tabs-nav li a'
            );

            echo cocco_mikado_dynamic_css($border_transparency_08_selector, array('border-color' => $fourth_transparency_08_color));
            echo cocco_mikado_dynamic_css($border_transparency_05_selector, array('background-color' => $fourth_transparency_05_color));
            echo cocco_mikado_dynamic_css($background_transparency_01_selector, array('background-color' => $fourth_transparency_01_color));
            echo cocco_mikado_dynamic_css($background_transparency_02_selector, array('background-color' => $fourth_transparency_02_color));
        }

	    $page_background_color = cocco_mikado_options()->getOptionValue( 'page_background_color' );
	    if ( ! empty( $page_background_color ) ) {
		    $background_color_selector = array(
			    'body',
			    '.mkdf-content'
		    );
		    echo cocco_mikado_dynamic_css( $background_color_selector, array( 'background-color' => $page_background_color ) );
	    }
	
	    $selection_color = cocco_mikado_options()->getOptionValue( 'selection_color' );
	    if ( ! empty( $selection_color ) ) {
		    echo cocco_mikado_dynamic_css( '::selection', array( 'background' => $selection_color ) );
		    echo cocco_mikado_dynamic_css( '::-moz-selection', array( 'background' => $selection_color ) );
	    }
	
	    $preload_background_styles = array();
	
	    if ( cocco_mikado_options()->getOptionValue( 'preload_pattern_image' ) !== "" ) {
		    $preload_background_styles['background-image'] = 'url(' . cocco_mikado_options()->getOptionValue( 'preload_pattern_image' ) . ') !important';
	    }
	
	    echo cocco_mikado_dynamic_css( '.mkdf-preload-background', $preload_background_styles );
    }

    add_action('cocco_mikado_action_style_dynamic', 'cocco_mikado_design_styles');
}

if ( ! function_exists( 'cocco_mikado_content_styles' ) ) {
	function cocco_mikado_content_styles() {
		$content_style = array();

		$padding = cocco_mikado_options()->getOptionValue( 'content_padding' );
		if ( $padding !== '' ) {
			$content_style['padding'] = $padding;
		}
		
		$content_selector = array(
			'.mkdf-content .mkdf-content-inner > .mkdf-full-width > .mkdf-full-width-inner',
		);
		
		echo cocco_mikado_dynamic_css( $content_selector, $content_style );
		
		$content_style_in_grid = array();

		$padding_in_grid = cocco_mikado_options()->getOptionValue( 'content_padding_in_grid' );
		if ( $padding_in_grid !== '' ) {
			$content_style_in_grid['padding'] = $padding_in_grid;
		}
		
		$content_selector_in_grid = array(
			'.mkdf-content .mkdf-content-inner > .mkdf-container > .mkdf-container-inner',
		);
		
		echo cocco_mikado_dynamic_css( $content_selector_in_grid, $content_style_in_grid );

		$background_style = array();
		$background_image = cocco_mikado_options()->getOptionValue('content_background_image');
		if ($background_image !== ''){
			$background_style['background-image'] = 'url('.esc_url($background_image).')';
		}

		echo cocco_mikado_dynamic_css( '.mkdf-content', $background_style );
	}
	
	add_action( 'cocco_mikado_action_style_dynamic', 'cocco_mikado_content_styles' );
}

if ( ! function_exists( 'cocco_mikado_h1_styles' ) ) {
	function cocco_mikado_h1_styles() {
		$margin_top    = cocco_mikado_options()->getOptionValue( 'h1_margin_top' );
		$margin_bottom = cocco_mikado_options()->getOptionValue( 'h1_margin_bottom' );
		
		$item_styles = cocco_mikado_get_typography_styles( 'h1' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = cocco_mikado_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = cocco_mikado_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h1'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo cocco_mikado_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'cocco_mikado_action_style_dynamic', 'cocco_mikado_h1_styles' );
}

if ( ! function_exists( 'cocco_mikado_h2_styles' ) ) {
	function cocco_mikado_h2_styles() {
		$margin_top    = cocco_mikado_options()->getOptionValue( 'h2_margin_top' );
		$margin_bottom = cocco_mikado_options()->getOptionValue( 'h2_margin_bottom' );
		
		$item_styles = cocco_mikado_get_typography_styles( 'h2' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = cocco_mikado_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = cocco_mikado_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h2',
			'.mkdf-woo-single-page .related.products>h2'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo cocco_mikado_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'cocco_mikado_action_style_dynamic', 'cocco_mikado_h2_styles' );
}

if ( ! function_exists( 'cocco_mikado_h3_styles' ) ) {
	function cocco_mikado_h3_styles() {
		$margin_top    = cocco_mikado_options()->getOptionValue( 'h3_margin_top' );
		$margin_bottom = cocco_mikado_options()->getOptionValue( 'h3_margin_bottom' );
		
		$item_styles = cocco_mikado_get_typography_styles( 'h3' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = cocco_mikado_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = cocco_mikado_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h3',
			'.mkdf-woocommerce-page .cart_totals > h2'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo cocco_mikado_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'cocco_mikado_action_style_dynamic', 'cocco_mikado_h3_styles' );
}

if ( ! function_exists( 'cocco_mikado_h4_styles' ) ) {
	function cocco_mikado_h4_styles() {
		$margin_top    = cocco_mikado_options()->getOptionValue( 'h4_margin_top' );
		$margin_bottom = cocco_mikado_options()->getOptionValue( 'h4_margin_bottom' );
		
		$item_styles = cocco_mikado_get_typography_styles( 'h4' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = cocco_mikado_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = cocco_mikado_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h4'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo cocco_mikado_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'cocco_mikado_action_style_dynamic', 'cocco_mikado_h4_styles' );
}

if ( ! function_exists( 'cocco_mikado_h5_styles' ) ) {
	function cocco_mikado_h5_styles() {
		$margin_top    = cocco_mikado_options()->getOptionValue( 'h5_margin_top' );
		$margin_bottom = cocco_mikado_options()->getOptionValue( 'h5_margin_bottom' );
		
		$item_styles = cocco_mikado_get_typography_styles( 'h5' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = cocco_mikado_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = cocco_mikado_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h5'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo cocco_mikado_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'cocco_mikado_action_style_dynamic', 'cocco_mikado_h5_styles' );
}

if ( ! function_exists( 'cocco_mikado_h6_styles' ) ) {
	function cocco_mikado_h6_styles() {
		$margin_top    = cocco_mikado_options()->getOptionValue( 'h6_margin_top' );
		$margin_bottom = cocco_mikado_options()->getOptionValue( 'h6_margin_bottom' );
		
		$item_styles = cocco_mikado_get_typography_styles( 'h6' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = cocco_mikado_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = cocco_mikado_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h6'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo cocco_mikado_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'cocco_mikado_action_style_dynamic', 'cocco_mikado_h6_styles' );
}

if ( ! function_exists( 'cocco_mikado_text_styles' ) ) {
	function cocco_mikado_text_styles() {
		$item_styles = cocco_mikado_get_typography_styles( 'text' );
		
		$item_selector = array(
			'p'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo cocco_mikado_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'cocco_mikado_action_style_dynamic', 'cocco_mikado_text_styles' );
}

if ( ! function_exists( 'cocco_mikado_link_styles' ) ) {
	function cocco_mikado_link_styles() {
		$link_styles      = array();
		$link_color       = cocco_mikado_options()->getOptionValue( 'link_color' );
		$link_font_style  = cocco_mikado_options()->getOptionValue( 'link_fontstyle' );
		$link_font_weight = cocco_mikado_options()->getOptionValue( 'link_fontweight' );
		$link_decoration  = cocco_mikado_options()->getOptionValue( 'link_fontdecoration' );
		
		if ( ! empty( $link_color ) ) {
			$link_styles['color'] = $link_color;
		}
		if ( ! empty( $link_font_style ) ) {
			$link_styles['font-style'] = $link_font_style;
		}
		if ( ! empty( $link_font_weight ) ) {
			$link_styles['font-weight'] = $link_font_weight;
		}
		if ( ! empty( $link_decoration ) ) {
			$link_styles['text-decoration'] = $link_decoration;
		}
		
		$link_selector = array(
			'a',
			'p a'
		);
		
		if ( ! empty( $link_styles ) ) {
			echo cocco_mikado_dynamic_css( $link_selector, $link_styles );
		}
	}
	
	add_action( 'cocco_mikado_action_style_dynamic', 'cocco_mikado_link_styles' );
}

if ( ! function_exists( 'cocco_mikado_link_hover_styles' ) ) {
	function cocco_mikado_link_hover_styles() {
		$link_hover_styles     = array();
		$link_hover_color      = cocco_mikado_options()->getOptionValue( 'link_hovercolor' );
		$link_hover_decoration = cocco_mikado_options()->getOptionValue( 'link_hover_fontdecoration' );
		
		if ( ! empty( $link_hover_color ) ) {
			$link_hover_styles['color'] = $link_hover_color;
		}
		if ( ! empty( $link_hover_decoration ) ) {
			$link_hover_styles['text-decoration'] = $link_hover_decoration;
		}
		
		$link_hover_selector = array(
			'a:hover',
			'p a:hover'
		);
		
		if ( ! empty( $link_hover_styles ) ) {
			echo cocco_mikado_dynamic_css( $link_hover_selector, $link_hover_styles );
		}
		
		$link_heading_hover_styles = array();
		
		if ( ! empty( $link_hover_color ) ) {
			$link_heading_hover_styles['color'] = $link_hover_color;
		}
		
		$link_heading_hover_selector = array(
			'h1 a:hover',
			'h2 a:hover',
			'h3 a:hover',
			'h4 a:hover',
			'h5 a:hover',
			'h6 a:hover'
		);
		
		if ( ! empty( $link_heading_hover_styles ) ) {
			echo cocco_mikado_dynamic_css( $link_heading_hover_selector, $link_heading_hover_styles );
		}
	}
	
	add_action( 'cocco_mikado_action_style_dynamic', 'cocco_mikado_link_hover_styles' );
}

if ( ! function_exists( 'cocco_mikado_smooth_page_transition_styles' ) ) {
	function cocco_mikado_smooth_page_transition_styles( $style ) {
		$id            = cocco_mikado_get_page_id();
		$loader_style  = array();
		$current_style = '';
		
		$background_color = cocco_mikado_get_meta_field_intersect( 'smooth_pt_bgnd_color', $id );
		if ( ! empty( $background_color ) ) {
			$loader_style['background-color'] = $background_color;
		}
		
		$loader_selector = array(
			'.mkdf-smooth-transition-loader'
		);
		
		if ( ! empty( $loader_style ) ) {
			$current_style .= cocco_mikado_dynamic_css( $loader_selector, $loader_style );
		}
		
		$spinner_style = array();
		$spinner_color = cocco_mikado_get_meta_field_intersect( 'smooth_pt_spinner_color', $id );
		if ( ! empty( $spinner_color ) ) {
			$spinner_style['background-color'] = $spinner_color;
		}
		
		$spinner_selectors = array(
			'.mkdf-st-loader .mkdf-rotate-circles > div',
			'.mkdf-st-loader .pulse',
			'.mkdf-st-loader .double_pulse .double-bounce1',
			'.mkdf-st-loader .double_pulse .double-bounce2',
			'.mkdf-st-loader .cube',
			'.mkdf-st-loader .rotating_cubes .cube1',
			'.mkdf-st-loader .rotating_cubes .cube2',
			'.mkdf-st-loader .stripes > div',
			'.mkdf-st-loader .wave > div',
			'.mkdf-st-loader .two_rotating_circles .dot1',
			'.mkdf-st-loader .two_rotating_circles .dot2',
			'.mkdf-st-loader .five_rotating_circles .container1 > div',
			'.mkdf-st-loader .five_rotating_circles .container2 > div',
			'.mkdf-st-loader .five_rotating_circles .container3 > div',
			'.mkdf-st-loader .atom .ball-1:before',
			'.mkdf-st-loader .atom .ball-2:before',
			'.mkdf-st-loader .atom .ball-3:before',
			'.mkdf-st-loader .atom .ball-4:before',
			'.mkdf-st-loader .clock .ball:before',
			'.mkdf-st-loader .mitosis .ball',
			'.mkdf-st-loader .lines .line1',
			'.mkdf-st-loader .lines .line2',
			'.mkdf-st-loader .lines .line3',
			'.mkdf-st-loader .lines .line4',
			'.mkdf-st-loader .fussion .ball',
			'.mkdf-st-loader .fussion .ball-1',
			'.mkdf-st-loader .fussion .ball-2',
			'.mkdf-st-loader .fussion .ball-3',
			'.mkdf-st-loader .fussion .ball-4',
			'.mkdf-st-loader .wave_circles .ball',
			'.mkdf-st-loader .pulse_circles .ball'
		);
		
		if ( ! empty( $spinner_style ) ) {
			$current_style .= cocco_mikado_dynamic_css( $spinner_selectors, $spinner_style );
		}
		
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'cocco_mikado_filter_add_page_custom_style', 'cocco_mikado_smooth_page_transition_styles' );
}