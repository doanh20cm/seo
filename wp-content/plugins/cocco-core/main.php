<?php
/*
Plugin Name: Cocco CORE
Description: Plugin that adds all post types needed by our theme
Author: Mikado Themes
Version: 1.7.1
*/


	require_once 'load.php';


	add_action( 'after_setup_theme', array( CoccoCore\CPT\PostTypesRegister::getInstance(), 'register' ) );

	if ( ! function_exists( 'cocco_core_activation' ) ) {
		/**
		 * Triggers when plugin is activated. It calls flush_rewrite_rules
		 * and defines cocco_mikado_action_core_on_activate action
		 */
		function cocco_core_activation() {
			do_action( 'cocco_mikado_action_core_on_activate' );

			CoccoCore\CPT\PostTypesRegister::getInstance()->register();
			flush_rewrite_rules();
		}

		register_activation_hook( __FILE__, 'cocco_core_activation' );
	}

	if ( ! function_exists( 'cocco_core_text_domain' ) ) {
		/**
		 * Loads plugin text domain so it can be used in translation
		 */
		function cocco_core_text_domain() {
			load_plugin_textdomain( 'cocco-core', false, COCCO_CORE_REL_PATH . '/languages' );
		}

		add_action( 'plugins_loaded', 'cocco_core_text_domain' );
	}

	if ( ! function_exists( 'cocco_core_version_class' ) ) {
		/**
		 * Adds plugins version class to body
		 *
		 * @param $classes
		 *
		 * @return array
		 */
		function cocco_core_version_class( $classes ) {
			$classes[] = 'cocco-core-' . COCCO_CORE_VERSION;

			return $classes;
		}

		add_filter( 'body_class', 'cocco_core_version_class' );
	}

	if ( ! function_exists( 'cocco_core_theme_installed' ) ) {
		/**
		 * Checks whether theme is installed or not
		 * @return bool
		 */
		function cocco_core_theme_installed() {
			return defined( 'MIKADO_ROOT' );
		}
	}

	if ( ! function_exists( 'cocco_core_is_woocommerce_installed' ) ) {
		/**
		 * Function that checks if woocommerce is installed
		 * @return bool
		 */
		function cocco_core_is_woocommerce_installed() {
			return function_exists( 'is_woocommerce' );
		}
	}

	if ( ! function_exists( 'cocco_core_is_woocommerce_integration_installed' ) ) {
		//is Mikado Woocommerce Integration installed?
		function cocco_core_is_woocommerce_integration_installed() {
			return defined( 'MIKADO_WOOCOMMERCE_CHECKOUT_INTEGRATION' );
		}
	}

	if ( ! function_exists( 'cocco_core_is_revolution_slider_installed' ) ) {
		function cocco_core_is_revolution_slider_installed() {
			return class_exists( 'RevSliderFront' );
		}
	}

	if ( ! function_exists( 'cocco_core_is_wpml_installed' ) ) {
		/**
		 * Function that checks if WPML plugin is installed
		 * @return bool
		 *
		 * @version 0.1
		 */
		function cocco_core_is_wpml_installed() {
			return defined( 'ICL_SITEPRESS_VERSION' );
		}
	}

	if ( ! function_exists( 'cocco_core_theme_menu' ) ) {
		/**
		 * Function that generates admin menu for options page.
		 * It generates one admin page per options page.
		 */
		function cocco_core_theme_menu() {
			if ( cocco_core_theme_installed() && cocco_mikado_is_theme_registered() ) {

				global $cocco_mikado_Framework;
				cocco_mikado_init_theme_options();

				$page_hook_suffix = add_menu_page(
					esc_html__( 'Mikado Options', 'cocco-core' ), // The value used to populate the browser's title bar when the menu page is active
					esc_html__( 'Mikado Options', 'cocco-core' ), // The text of the menu in the administrator's sidebar
					'administrator',                            // What roles are able to access the menu
					'cocco_mikado_theme_menu',            // The ID used to bind submenu items to this menu
					array(
						$cocco_mikado_Framework->getSkin(),
						'renderOptions'
					), // The callback function used to render this menu
					$cocco_mikado_Framework->getSkin()->getSkinURI() . '/assets/img/admin-logo-icon.png', // Icon For menu Item
					4                                                                                           // Position
				);

				foreach ( $cocco_mikado_Framework->mkdOptions->adminPages as $key => $value ) {
					$slug = "";

					if ( ! empty( $value->slug ) ) {
						$slug = "_tab" . $value->slug;
					}

					$subpage_hook_suffix = add_submenu_page(
						'cocco_mikado_theme_menu',
						esc_html__( 'Mikado Options - ', 'cocco-core' ) . $value->title, // The value used to populate the browser's title bar when the menu page is active
						$value->title,                                                 // The text of the menu in the administrator's sidebar
						'administrator',                                               // What roles are able to access the menu
						'cocco_mikado_theme_menu' . $slug,                       // The ID used to bind submenu items to this menu
						array( $cocco_mikado_Framework->getSkin(), 'renderOptions' )
					);

					add_action( 'admin_print_scripts-' . $subpage_hook_suffix, 'cocco_mikado_enqueue_admin_scripts' );
					add_action( 'admin_print_styles-' . $subpage_hook_suffix, 'cocco_mikado_enqueue_admin_styles' );
				};

				add_action( 'admin_print_scripts-' . $page_hook_suffix, 'cocco_mikado_enqueue_admin_scripts' );
				add_action( 'admin_print_styles-' . $page_hook_suffix, 'cocco_mikado_enqueue_admin_styles' );
			}
		}

		add_action( 'admin_menu', 'cocco_core_theme_menu' );
	}

	if ( ! function_exists( 'cocco_core_theme_menu_backup_options' ) ) {
		/**
		 * Function that generates admin menu for options page.
		 * It generates one admin page per options page.
		 */
		function cocco_core_theme_menu_backup_options() {
			if ( cocco_core_theme_installed() ) {
				global $cocco_mikado_Framework;

				$slug             = "_backup_options";
				$page_hook_suffix = add_submenu_page(
					'cocco_mikado_theme_menu',
					esc_html__( 'Mikado Options - Backup Options', 'cocco-core' ), // The value used to populate the browser's title bar when the menu page is active
					esc_html__( 'Backup Options', 'cocco-core' ),                // The text of the menu in the administrator's sidebar
					'administrator',                                             // What roles are able to access the menu
					'cocco_mikado_theme_menu' . $slug,                     // The ID used to bind submenu items to this menu
					array( $cocco_mikado_Framework->getSkin(), 'renderBackupOptions' )
				);

				add_action( 'admin_print_scripts-' . $page_hook_suffix, 'cocco_mikado_enqueue_admin_scripts' );
				add_action( 'admin_print_styles-' . $page_hook_suffix, 'cocco_mikado_enqueue_admin_styles' );
			}
		}

		add_action( 'admin_menu', 'cocco_core_theme_menu_backup_options' );
	}

	if ( ! function_exists( 'cocco_core_theme_admin_bar_menu_options' ) ) {
		/**
		 * Add a link to the WP Toolbar
		 */
		function cocco_core_theme_admin_bar_menu_options( $wp_admin_bar ) {
			$args = array(
				'id'    => 'cocco-admin-bar-options',
				'title' => sprintf( '<span class="ab-icon dashicons-before dashicons-admin-generic"></span> %s', esc_html__( 'Mikado Options', 'cocco-core' ) ),
				'href'  => esc_url( admin_url( 'admin.php?page=cocco_mikado_theme_menu' ) )
			);

			$wp_admin_bar->add_node( $args );
		}

		add_action( 'admin_bar_menu', 'cocco_core_theme_admin_bar_menu_options', 999 );
	}
if( ! function_exists( 'cocco_core_is_theme_registered' ) ) {
    function cocco_core_is_theme_registered() {
        return class_exists('MikadoCoreDashboard') ? MikadoCoreDashboard::get_instance()->is_theme_registered() : true;
    }
}