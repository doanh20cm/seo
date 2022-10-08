<?php

define( 'COCCO_CORE_VERSION', '1.7.1' );
define( 'COCCO_CORE_ABS_PATH', dirname( __FILE__ ) );
define( 'COCCO_CORE_REL_PATH', dirname( plugin_basename( __FILE__ ) ) );
define( 'COCCO_CORE_URL_PATH', plugin_dir_url( __FILE__ ) );
define( 'COCCO_CORE_ASSETS_PATH', COCCO_CORE_ABS_PATH . '/assets' );
define( 'COCCO_CORE_ASSETS_URL_PATH', COCCO_CORE_URL_PATH . 'assets' );
define( 'COCCO_CORE_CPT_PATH', COCCO_CORE_ABS_PATH . '/post-types' );
define( 'COCCO_CORE_CPT_URL_PATH', COCCO_CORE_URL_PATH . 'post-types' );
define( 'COCCO_CORE_SHORTCODES_PATH', COCCO_CORE_ABS_PATH . '/shortcodes' );
define( 'COCCO_CORE_SHORTCODES_URL_PATH', COCCO_CORE_URL_PATH . 'shortcodes' );

define( 'MIKADO_CORE_OPTIONS_NAME', 'mkdf_options_cocco' );