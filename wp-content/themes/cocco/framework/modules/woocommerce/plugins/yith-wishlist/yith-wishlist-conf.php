<?php

/*************** YITH WISHLIST FILTERS - begin ***************/

if ( ! function_exists( 'cocco_mikado_woocommerce_yith_wishlist_init' ) ) {
    function cocco_mikado_woocommerce_yith_wishlist_init() {
        //Change yith wishlist button position on single product page

        //Add yith wishlist button
        add_action( 'cocco_mikado_action_woo_quickview_wishlist_holder', 'cocco_mikado_woocommerce_wishlist_shortcode', 2 );

        //Remove quick view button from wishlist
        remove_all_actions('yith_wcwl_table_after_product_name');        
    }

    add_action( 'init', 'cocco_mikado_woocommerce_yith_wishlist_init', 15 );
}

/*************** YITH WISHLIST FILTERS - end ***************/