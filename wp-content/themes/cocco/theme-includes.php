<?php

//define constants
define( 'MIKADO_ROOT', get_template_directory_uri() );
define( 'MIKADO_ROOT_DIR', get_template_directory() );
define( 'MIKADO_ASSETS_ROOT', get_template_directory_uri() . '/assets' );
define( 'MIKADO_ASSETS_ROOT_DIR', get_template_directory() . '/assets' );
define( 'MIKADO_FRAMEWORK_ROOT', get_template_directory_uri() . '/framework' );
define( 'MIKADO_FRAMEWORK_ROOT_DIR', get_template_directory() . '/framework' );
define( 'MIKADO_FRAMEWORK_ADMIN_ASSETS_ROOT', get_template_directory_uri() . '/framework/admin/assets' );
define( 'MIKADO_FRAMEWORK_ICONS_ROOT', get_template_directory_uri() . '/framework/lib/icons-pack' );
define( 'MIKADO_FRAMEWORK_ICONS_ROOT_DIR', get_template_directory() . '/framework/lib/icons-pack' );
define( 'MIKADO_FRAMEWORK_MODULES_ROOT', get_template_directory_uri() . '/framework/modules' );
define( 'MIKADO_FRAMEWORK_MODULES_ROOT_DIR', get_template_directory() . '/framework/modules' );
define( 'MIKADO_FRAMEWORK_HEADER_ROOT', get_template_directory_uri() . '/framework/modules/header' );
define( 'MIKADO_FRAMEWORK_HEADER_ROOT_DIR', get_template_directory() . '/framework/modules/header' );
define( 'MIKADO_FRAMEWORK_HEADER_TYPES_ROOT', MIKADO_FRAMEWORK_HEADER_ROOT . '/types' );
define( 'MIKADO_FRAMEWORK_HEADER_TYPES_ROOT_DIR', MIKADO_FRAMEWORK_HEADER_ROOT_DIR . '/types' );
define( 'MIKADO_FRAMEWORK_SEARCH_ROOT', get_template_directory_uri() . '/framework/modules/search' );
define( 'MIKADO_FRAMEWORK_SEARCH_ROOT_DIR', get_template_directory() . '/framework/modules/search' );
define( 'MIKADO_THEME_ENV', 'false' );
define( 'MIKADO_PROFILE_SLUG', 'mikado' );
define( 'MIKADO_OPTIONS_SLUG', 'cocco_mikado_theme_menu');

//include necessary files
include_once MIKADO_ROOT_DIR . '/framework/mkdf-framework.php';
include_once MIKADO_ROOT_DIR . '/includes/nav-menu/mkdf-menu.php';
require_once MIKADO_ROOT_DIR . '/includes/plugins/class-tgm-plugin-activation.php';
include_once MIKADO_ROOT_DIR . '/includes/plugins/plugins-activation.php';
include_once MIKADO_ROOT_DIR . '/assets/custom-styles/general-custom-styles.php';
include_once MIKADO_ROOT_DIR . '/assets/custom-styles/general-custom-styles-responsive.php';

if ( file_exists( MIKADO_ROOT_DIR . '/export' ) ) {
	include_once MIKADO_ROOT_DIR . '/export/export.php';
}

if ( ! is_admin() ) {
	include_once MIKADO_ROOT_DIR . '/includes/mkdf-body-class-functions.php';
	include_once MIKADO_ROOT_DIR . '/includes/mkdf-loading-spinners.php';
}