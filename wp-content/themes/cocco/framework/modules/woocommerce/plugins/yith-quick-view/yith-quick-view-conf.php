<?php

/*************** YITH QUICK VIEW CONTENT FILTERS - begin ***************/

if ( ! function_exists( 'cocco_mikado_woocommerce_yith_quick_view_init' ) ) {
    function cocco_mikado_woocommerce_yith_quick_view_init() {
        //Add yith quick view button
        add_action('cocco_mikado_action_woo_quickview_wishlist_holder', 'cocco_mikado_woocommerce_quickview_link', 3);

        //Override product title
        remove_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_title', 5 );
        add_action( 'yith_wcqv_product_summary', 'cocco_mikado_woocommerce_yith_template_single_title', 5 );

        //Remove add to cart
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );


        //Remove deafult actions for product image and add custom
        remove_action('yith_wcqv_product_image', 'woocommerce_show_product_sale_flash', 10);
        remove_action('yith_wcqv_product_image', 'woocommerce_show_product_images', 20);
        add_action('yith_wcqv_product_image', 'cocco_mikado_woocommerce_show_product_images', 9);

        //Change rating star position
        remove_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_rating', 10 );
        add_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_rating', 9 );

        add_action( 'yith_wcqv_product_summary', 'cocco_mikado_woocommerce_quickview_shortcode', 31 );

        //Add social share (default woocommerce_share)
        add_action( 'yith_wcqv_product_summary', 'cocco_mikado_woocommerce_share', 32 );

        //Remove product meta
        remove_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_meta', 30 );
    }

    add_action( 'init', 'cocco_mikado_woocommerce_yith_quick_view_init', 15 );
}

/*************** YITH QUICK VIEW CONTENT FILTERS - end ***************/