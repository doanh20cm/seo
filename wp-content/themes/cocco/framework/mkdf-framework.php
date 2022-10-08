<?php

require_once MIKADO_FRAMEWORK_ROOT_DIR . "/lib/mkdf.kses.php";
require_once MIKADO_FRAMEWORK_ROOT_DIR . "/lib/mkdf.layout1.php";
require_once MIKADO_FRAMEWORK_ROOT_DIR . "/lib/mkdf.layout2.php";
require_once MIKADO_FRAMEWORK_ROOT_DIR . "/lib/mkdf.layout3.php";
require_once MIKADO_FRAMEWORK_ROOT_DIR . "/lib/mkdf.layout.tax.php";
require_once MIKADO_FRAMEWORK_ROOT_DIR . "/lib/mkdf.layout.user.php";
require_once MIKADO_FRAMEWORK_ROOT_DIR . "/lib/mkdf.layout.dashboard.php";
require_once MIKADO_FRAMEWORK_ROOT_DIR . "/lib/mkdf.optionsapi.php";
require_once MIKADO_FRAMEWORK_ROOT_DIR . "/lib/mkdf.framework.php";
require_once MIKADO_FRAMEWORK_ROOT_DIR . "/lib/mkdf.functions.php";
require_once MIKADO_FRAMEWORK_ROOT_DIR . "/lib/icons-pack/icons-pack.php";
require_once MIKADO_FRAMEWORK_ROOT_DIR . "/admin/options/mkdf-options-setup.php";
require_once MIKADO_FRAMEWORK_ROOT_DIR . "/admin/meta-boxes/mkdf-meta-boxes-setup.php";
require_once MIKADO_FRAMEWORK_ROOT_DIR . "/modules/mkdf-modules-loader.php";

if ( ! function_exists( 'cocco_mikado_admin_scripts_init' ) ) {
	/**
	 * Function that registers all scripts that are necessary for our back-end
	 */
	function cocco_mikado_admin_scripts_init() {
		
		//This part is required for field type address
		$enable_google_map_in_admin = apply_filters('cocco_mikado_filter_google_maps_in_backend', false);
		if($enable_google_map_in_admin) {
			//include google map api script
			$google_maps_api_key          = cocco_mikado_options()->getOptionValue( 'google_maps_api_key' );
			$google_maps_extensions       = '';
			$google_maps_extensions_array = apply_filters( 'cocco_mikado_filter_google_maps_extensions_array', array() );
			if ( ! empty( $google_maps_extensions_array ) ) {
				$google_maps_extensions .= '&libraries=';
				$google_maps_extensions .= implode( ',', $google_maps_extensions_array );
			}
			if ( ! empty( $google_maps_api_key ) ) {
                wp_enqueue_script( 'cocco-mikado-admin-maps', '//maps.googleapis.com/maps/api/js?key=' . esc_attr( $google_maps_api_key ) . $google_maps_extensions, array(), false, true );
                wp_enqueue_script( 'jquery.geocomplete', get_template_directory_uri() . '/framework/admin/assets/js/jquery.geocomplete.min.js', array('mkdf-admin-maps'), false, true );
			}
		}
		
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/framework/admin/assets/js/bootstrap.min.js', array(), false, true );
		wp_enqueue_script( 'bootstrap-select', get_template_directory_uri() . '/framework/admin/assets/js/bootstrap-select.min.js', array(), false, true );
		wp_enqueue_script( 'select2', get_template_directory_uri() . '/framework/admin/assets/js/select2.min.js', array(), false, true );
		wp_enqueue_script( 'cocco-mikado-ui-admin', get_template_directory_uri() . '/framework/admin/assets/js/mkdf-ui/mkdf-ui.js', array(), false, true );
		
		
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/framework/admin/assets/css/font-awesome/css/font-awesome.min.css' );
		wp_enqueue_style( 'select2', get_template_directory_uri() . '/framework/admin/assets/css/select2.min.css' );
		
		/**
		 * @see CoccoMikadoSkinAbstract::registerScripts - hooked with 10
		 * @see CoccoMikadoSkinAbstract::registerStyles - hooked with 10
		 */
		do_action( 'cocco_mikado_action_admin_scripts_init' );
	}
	
	add_action( 'admin_init', 'cocco_mikado_admin_scripts_init' );
}

if ( ! function_exists( 'cocco_mikado_enqueue_admin_styles' ) ) {
	/**
	 * Function that enqueues styles for options page
	 */
	function cocco_mikado_enqueue_admin_styles() {
		wp_enqueue_style( 'wp-color-picker' );
		
		/**
		 * @see CoccoMikadoSkinAbstract::enqueueStyles - hooked with 10
		 */
		do_action( 'cocco_mikado_action_enqueue_admin_styles' );
	}
}

if ( ! function_exists( 'cocco_mikado_enqueue_admin_scripts' ) ) {
	/**
	 * Function that enqueues styles for options page
	 */
	function cocco_mikado_enqueue_admin_scripts() {
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'jquery-ui-accordion' );
		wp_enqueue_script( 'common' );
		wp_enqueue_script( 'wp-lists' );
		wp_enqueue_script( 'postbox' );
		wp_enqueue_media();
		wp_enqueue_script( 'cocco-mikado-dependence', get_template_directory_uri() . '/framework/admin/assets/js/mkdf-ui/mkdf-dependence.js', array(), false, true );
		wp_enqueue_script( 'cocco-mikado-twitter-connect', get_template_directory_uri() . '/framework/admin/assets/js/mkdf-ui/mkdf-twitter-connect.js', array(), false, true );
		
		/**
		 * @see CoccoMikadoSkinAbstract::enqueueScripts - hooked with 10
		 */
		do_action( 'cocco_mikado_action_enqueue_admin_scripts' );
	}
}

if ( ! function_exists( 'cocco_mikado_enqueue_meta_box_styles' ) ) {
	/**
	 * Function that enqueues styles for meta boxes
	 */
	function cocco_mikado_enqueue_meta_box_styles() {
		wp_enqueue_style( 'wp-color-picker' );
		
		/**
		 * @see CoccoMikadoSkinAbstract::enqueueStyles - hooked with 10
		 */
		do_action( 'cocco_mikado_action_enqueue_meta_box_styles' );
	}
}

if ( ! function_exists( 'cocco_mikado_enqueue_meta_box_scripts' ) ) {
	/**
	 * Function that enqueues scripts for meta boxes
	 */
	function cocco_mikado_enqueue_meta_box_scripts() {
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'jquery-ui-accordion' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'common' );
		wp_enqueue_script( 'wp-lists' );
		wp_enqueue_script( 'postbox' );
		wp_enqueue_media();
        wp_enqueue_script( 'cocco-mikado-dependence', get_template_directory_uri() . '/framework/admin/assets/js/mkdf-ui/mkdf-dependence.js', array(), false, true );
        wp_enqueue_script( 'cocco-mikado-repeater', get_template_directory_uri() . '/framework/admin/assets/js/mkdf-ui/mkdf-ui-repeater.js', array(), false, true );
		
		/**
		 * @see CoccoMikadoSkinAbstract::enqueueScripts - hooked with 10
		 */
		do_action( 'cocco_mikado_action_enqueue_meta_box_scripts' );
	}
}

if ( ! function_exists( 'cocco_mikado_enqueue_nav_menu_script' ) ) {
	/**
	 * Function that enqueues styles and scripts necessary for menu administration page.
	 * It checks $hook variable
	 *
	 * @param $hook string current page hook to check
	 */
	function cocco_mikado_enqueue_nav_menu_script( $hook ) {
		if ( $hook == 'nav-menus.php' ) {
			wp_enqueue_script( 'cocco-mikado-nav-menu', get_template_directory_uri() . '/framework/admin/assets/js/mkdf-ui/mkdf-nav-menu.js' );
			wp_enqueue_style( 'cocco-mikado-nav-menu', get_template_directory_uri() . '/framework/admin/assets/css/mkdf-nav-menu.css' );
		}
	}
	
	add_action( 'admin_enqueue_scripts', 'cocco_mikado_enqueue_nav_menu_script' );
}

if ( ! function_exists( 'cocco_mikado_enqueue_widgets_admin_script' ) ) {
	/**
	 * Function that enqueues styles and scripts for admin widgets page.
	 *
	 * @param $hook string current page hook to check
	 */
	function cocco_mikado_enqueue_widgets_admin_script( $hook ) {
		if ( $hook == 'widgets.php' ) {
			wp_enqueue_script( 'wp-color-picker' );
            wp_enqueue_script( 'cocco-mikado-dependence', get_template_directory_uri() . '/framework/admin/assets/js/mkdf-ui/mkdf-dependence.js', array(), false, true );
			wp_enqueue_script( 'cocco-mikado-widgets-dependence', get_template_directory_uri() . '/framework/admin/assets/js/mkdf-ui/mkdf-widget-dependence.js', array(), false, true );
		}
	}
	
	add_action( 'admin_enqueue_scripts', 'cocco_mikado_enqueue_widgets_admin_script' );
}

if ( ! function_exists( 'cocco_mikado_enqueue_taxonomy_script' ) ) {
	/**
	 * Function that enqueues styles and scripts necessary for menu administration page.
	 * It checks $hook variable
	 *
	 * @param $hook string current page hook to check
	 */
	function cocco_mikado_enqueue_taxonomy_script( $hook ) {
		if ( $hook == 'edit-tags.php' || $hook == 'term.php' ) {
			wp_enqueue_script( 'select2' );
			wp_enqueue_style( 'select2', get_template_directory_uri() . '/framework/admin/assets/css/select2.min.css' );
		}
	}

	add_action( 'admin_enqueue_scripts', 'cocco_mikado_enqueue_taxonomy_script' );
}


if ( ! function_exists( 'cocco_mikado_dashboard_page' ) ) {
	/**
	 * Function that checks whether Dashboard assets needs to be loaded.
	 *
	 */
	function cocco_mikado_dashboard_page() {
		return is_page_template('user-dashboard.php');
	}
}

if ( ! function_exists( 'cocco_mikado_init_theme_options_array' ) ) {
	/**
	 * Function that merges $cocco_mikado_options and default options array into one array.
	 *
	 * @see array_merge()
	 */
	function cocco_mikado_init_theme_options_array() {
		global $cocco_mikado_options, $cocco_mikado_Framework;
		
		$db_options = get_option( 'mkdf_options_cocco' );
		
		//does mkd_options exists in db?
		if ( is_array( $db_options ) ) {
			//merge with default options
			$cocco_mikado_options = array_merge( $cocco_mikado_Framework->mkdOptions->options, get_option( 'mkdf_options_cocco' ) );
		} else {
			//options don't exists in db, take default ones
			$cocco_mikado_options = $cocco_mikado_Framework->mkdOptions->options;
		}
	}
	
	add_action( 'cocco_mikado_action_after_options_map', 'cocco_mikado_init_theme_options_array', 0 );
}

if ( ! function_exists( 'cocco_mikado_init_theme_options' ) ) {
	/**
	 * Function that sets $cocco_mikado_options variable if it does'nt exists
	 */
	function cocco_mikado_init_theme_options() {
		global $cocco_mikado_options;
		global $cocco_mikado_Framework;
		if ( isset( $cocco_mikado_options['reset_to_defaults'] ) ) {
			if ( $cocco_mikado_options['reset_to_defaults'] == 'yes' ) {
				delete_option( "mkdf_options_cocco" );
			}
		}
		
		if ( ! get_option( "mkdf_options_cocco" ) ) {
			add_option( "mkdf_options_cocco", $cocco_mikado_Framework->mkdOptions->options );
			
			$cocco_mikado_options = $cocco_mikado_Framework->mkdOptions->options;
		}
	}
}

if ( ! function_exists( 'cocco_mikado_register_theme_settings' ) ) {
	/**
	 * Function that registers setting that will be used to store theme options
	 */
	function cocco_mikado_register_theme_settings() {
		register_setting( 'cocco_mikado_theme_menu', 'mkd_options' );
	}
	
	add_action( 'admin_init', 'cocco_mikado_register_theme_settings' );
}

if ( ! function_exists( 'cocco_mikado_get_admin_tab' ) ) {
	/**
	 * Helper function that returns current tab from url.
	 * @return null
	 */
	function cocco_mikado_get_admin_tab() {
		return isset( $_GET['page'] ) ? cocco_mikado_strafter( $_GET['page'], 'tab' ) : null;
	}
}

if ( ! function_exists( 'cocco_mikado_strafter' ) ) {
	/**
	 * Function that returns string that comes after found string
	 *
	 * @param $string string where to search
	 * @param $substring string what to search for
	 *
	 * @return null|string string that comes after found string
	 */
	function cocco_mikado_strafter( $string, $substring ) {
		$pos = strpos( $string, $substring );
		if ( $pos === false ) {
			return null;
		}
		
		return ( substr( $string, $pos + strlen( $substring ) ) );
	}
}

if ( ! function_exists( 'cocco_mikado_save_options' ) ) {
	/**
	 * Function that saves theme options to db.
	 * It hooks to ajax wp_ajax_mkdf_save_options action.
	 */
	function cocco_mikado_save_options() {
		global $cocco_mikado_options;
		
		if ( current_user_can( 'edit_theme_options' ) ) {
			$_REQUEST = stripslashes_deep( $_REQUEST );
			
			unset( $_REQUEST['action'] );
			
			check_ajax_referer( 'mkdf_ajax_save_nonce', 'mkdf_ajax_save_nonce' );
			
			$cocco_mikado_options = array_merge( $cocco_mikado_options, $_REQUEST );
			
			update_option( 'mkdf_options_cocco', $cocco_mikado_options );
			
			do_action( 'cocco_mikado_action_after_theme_option_save' );
			echo esc_html__( 'Saved', 'cocco' );
			
			die();
		}
	}
	
	add_action( 'wp_ajax_cocco_mikado_save_options', 'cocco_mikado_save_options' );
}

if ( ! function_exists( 'cocco_mikado_meta_box_add' ) ) {
	/**
	 * Function that adds all defined meta boxes.
	 * It loops through array of created meta boxes and adds them
	 */
	function cocco_mikado_meta_box_add() {
		global $cocco_mikado_Framework;
		
		foreach ( $cocco_mikado_Framework->mkdMetaBoxes->metaBoxes as $key => $box ) {
			$hidden = false;
			if ( ! empty( $box->hidden_property ) ) {
				foreach ( $box->hidden_values as $value ) {
					if ( cocco_mikado_option_get_value( $box->hidden_property ) == $value ) {
						$hidden = true;
					}
				}
			}
			
			if ( is_string( $box->scope ) ) {
				$box->scope = array( $box->scope );
			}
			
			if ( is_array( $box->scope ) && count( $box->scope ) ) {
				foreach ( $box->scope as $screen ) {
                    cocco_mikado_create_meta_box_handler( $box, $key, $screen );
					
					if ( $hidden ) {
						add_filter( 'postbox_classes_' . $screen . '_mkdf-meta-box-' . $key, 'cocco_mikado_meta_box_add_hidden_class' );
					}
				}
			}
		}

		if ( cocco_mikado_is_wp_gutenberg_installed() || cocco_mikado_is_gutenberg_installed() ) {
			cocco_mikado_enqueue_meta_box_styles();
		  	cocco_mikado_enqueue_meta_box_scripts();
		}else{	
			add_action( 'admin_enqueue_scripts', 'cocco_mikado_enqueue_meta_box_styles' );
			add_action( 'admin_enqueue_scripts', 'cocco_mikado_enqueue_meta_box_scripts' );
		}
	}
}

if ( ! function_exists( 'cocco_mikado_meta_box_save' ) ) {
	/**
	 * Function that saves meta box to postmeta table
	 *
	 * @param $post_id int id of post that meta box is being saved
	 * @param $post WP_Post current post object
	 */
	function cocco_mikado_meta_box_save( $post_id, $post ) {
		global $cocco_mikado_Framework;
		
		$nonces_array = array();
		$meta_boxes   = cocco_mikado_framework()->mkdMetaBoxes->getMetaBoxesByScope( $post->post_type );
		
		if ( is_array( $meta_boxes ) && count( $meta_boxes ) ) {
			foreach ( $meta_boxes as $meta_box ) {
				$nonces_array[] = 'cocco_mikado_meta_box_' . $meta_box->name . '_save';
			}
		}
		
		if ( is_array( $nonces_array ) && count( $nonces_array ) ) {
			foreach ( $nonces_array as $nonce ) {
				if ( ! isset( $_POST[ $nonce ] ) || ! wp_verify_nonce( $_POST[ $nonce ], $nonce ) ) {
					return;
				}
			}
		}
		
		$postTypes = apply_filters( 'cocco_mikado_filter_meta_box_post_types_save', array( 'post', 'page' ) );
		
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		
		if ( ! isset( $_POST['_wpnonce'] ) ) {
			return;
		}
		
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		
		if ( ! in_array( $post->post_type, $postTypes ) ) {
			return;
		}
		
		foreach ( $cocco_mikado_Framework->mkdMetaBoxes->options as $key => $box ) {
			
			if ( isset( $_POST[ $key ] ) && trim( $_POST[ $key ] !== '' ) ) {
				
				$value = $_POST[ $key ];
				
				update_post_meta( $post_id, $key, $value );
			} else {
				delete_post_meta( $post_id, $key );
			}
		}
	}
	
	add_action( 'save_post', 'cocco_mikado_meta_box_save', 1, 2 );
}

if ( ! function_exists( 'cocco_mikado_render_meta_box' ) ) {
	/**
	 * Function that renders meta box
	 *
	 * @param $post WP_Post post object
	 * @param $metabox array array of current meta box parameters
	 */
	function cocco_mikado_render_meta_box( $post, $metabox ) { ?>
		<div class="mkdf-meta-box mkdf-page">
			<div class="mkdf-meta-box-holder">
				<?php $metabox['args']['box']->render(); ?>
				<?php wp_nonce_field( 'cocco_mikado_meta_box_' . $metabox['args']['box']->name . '_save', 'cocco_mikado_meta_box_' . $metabox['args']['box']->name . '_save' ); ?>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'cocco_mikado_meta_box_add_hidden_class' ) ) {
	/**
	 * Function that adds class that will initially hide meta box
	 *
	 * @param array $classes array of classes
	 *
	 * @return array modified array of classes
	 */
	function cocco_mikado_meta_box_add_hidden_class( $classes = array() ) {
		if ( ! in_array( 'mkdf-meta-box-hidden', $classes ) ) {
			$classes[] = 'mkdf-meta-box-hidden';
		}
		
		return $classes;
	}
}

if ( ! function_exists( 'cocco_mikado_remove_default_custom_fields' ) ) {
	/**
	 * Function that removes default WordPress custom fields interface
	 */
	function cocco_mikado_remove_default_custom_fields() {
		foreach ( array( 'normal', 'advanced', 'side' ) as $context ) {
			foreach ( apply_filters( 'cocco_mikado_filter_meta_box_post_types_remove', array( 'post', 'page' ) ) as $postType ) {
				remove_meta_box( 'postcustom', $postType, $context );
			}
		}
	}
	
	add_action( 'do_meta_boxes', 'cocco_mikado_remove_default_custom_fields' );
}

if ( ! function_exists( 'cocco_mikado_generate_icon_pack_options' ) ) {
	/**
	 * Generates options HTML for each icon in given icon pack
	 * Hooked to wp_ajax_update_admin_nav_icon_options action
	 */
	function cocco_mikado_generate_icon_pack_options() {
		$html               = '';
		$icon_pack          = isset( $_POST['icon_pack'] ) ? $_POST['icon_pack'] : '';
		$collections_object = cocco_mikado_icon_collections()->getIconCollection( $icon_pack );
		
		if ( $collections_object ) {
			$icons = $collections_object->getIconsArray();
			if ( is_array( $icons ) && count( $icons ) ) {
				foreach ( $icons as $key => $icon ) {
					$html .= '<option value="' . esc_attr( $key ) . '">' . esc_html( $key ) . '</option>';
				}
			}
		}
		
		echo wp_kses( $html, array( 'option' => array( 'value' => true ) ) );
	}
	
	add_action( 'wp_ajax_update_admin_nav_icon_options', 'cocco_mikado_generate_icon_pack_options' );
}

if ( ! function_exists( 'cocco_mikado_save_dismisable_notice' ) ) {
	/**
	 * Updates user meta with dismisable notice. Hooks to admin_init action
	 * in order to check this on every page request in admin
	 */
	function cocco_mikado_save_dismisable_notice() {
		if ( is_admin() && ! empty( $_GET['mkd_dismis_notice'] ) ) {
			$notice_id       = sanitize_key( $_GET['mkd_dismis_notice'] );
			$current_user_id = get_current_user_id();
			
			update_user_meta( $current_user_id, 'dismis_' . $notice_id, 1 );
		}
	}
	
	add_action( 'admin_init', 'cocco_mikado_save_dismisable_notice' );
}

if ( ! function_exists( 'cocco_mikado_ajax_status' ) ) {
	/**
	 * Function that return status from ajax functions
	 */
	function cocco_mikado_ajax_status( $status, $message, $data = null ) {
		$response = array(
			'status'  => $status,
			'message' => $message,
			'data'    => $data
		);
		
		$output = json_encode( $response );
		
		exit( $output );
	}
}

if ( ! function_exists( 'cocco_mikado_hook_twitter_request_ajax' ) ) {
	/**
	 * Wrapper function for obtaining twitter request token.
	 * Hooks to wp_ajax_mkd_twitter_obtain_request_token ajax action
	 *
	 * @see MikadoTwitterApi::obtainRequestToken()
	 */
	function cocco_mikado_hook_twitter_request_ajax() {
		CoccoTwitterApi::getInstance()->obtainRequestToken();
	}
	
	add_action( 'wp_ajax_mkd_twitter_obtain_request_token', 'cocco_mikado_hook_twitter_request_ajax' );
}


if ( ! function_exists( 'cocco_mikado_set_admin_google_api_class' ) ) {
	function cocco_mikado_set_admin_google_api_class( $classes ) {
		$google_map_api = cocco_mikado_options()->getOptionValue( 'google_maps_api_key' );

		if ( empty( $google_map_api ) ) {
			$classes .= ' mkdf-empty-google-api';
		}
		
		return $classes;
	}
	
	add_filter( 'admin_body_class', 'cocco_mikado_set_admin_google_api_class' );
}

if ( ! function_exists( 'cocco_mikado_comment' ) ) {
	/**
	 * Function which modify default wordpress comments
	 *
	 * @return comments html
	 */
	function cocco_mikado_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		
		global $post;
		
		$is_pingback_comment = $comment->comment_type == 'pingback';
		$is_author_comment   = $post->post_author == $comment->user_id;
		
		$comment_class = 'mkdf-comment clearfix';
		
		if ( $is_author_comment ) {
			$comment_class .= ' mkdf-post-author-comment';
		}
		
		if ( $is_pingback_comment ) {
			$comment_class .= ' mkdf-pingback-comment';
		}
		?>
		
		<li>
		<div class="<?php echo esc_attr( $comment_class ); ?>">
			<?php if ( ! $is_pingback_comment ) { ?>
				<div class="mkdf-comment-image"> <?php echo cocco_mikado_kses_img( get_avatar( $comment, 'thumbnail' ) ); ?> </div>
			<?php } ?>
			<div class="mkdf-comment-text">
                <div class="mkdf-comment-info">
					<h6 class="mkdf-comment-name vcard">
						<?php if ( $is_pingback_comment ) {
							esc_html_e( 'Pingback:', 'cocco' );
						} ?>
						<?php echo wp_kses_post( get_comment_author_link() ); ?>
					</h6>
                    <div class="mkdf-comment-date"><?php comment_time( get_option( 'date_format' ) ); ?></div>
				</div>
				<?php if ( ! $is_pingback_comment ) { ?>
					<div class="mkdf-text-holder" id="comment-<?php echo comment_ID(); ?>">
						<?php comment_text(); ?>
					</div>
				<?php } ?>
                <?php
                comment_reply_link( array_merge( $args, array(
                    'reply_text' => esc_html__( 'Reply', 'cocco' ),
                    'depth'      => $depth,
                    'max_depth'  => $args['max_depth']
                ) ) );
                edit_comment_link( esc_html__( 'Edit', 'cocco' ) );
                ?>
			</div>
		</div>
		<?php //li tag will be closed by WordPress after looping through child elements ?>
		<?php
	}
}

/* Taxonomy custom fields functions - START */

if ( ! function_exists( 'cocco_mikado_init_custom_taxonomy_fields' ) ) {
	function cocco_mikado_init_custom_taxonomy_fields() {
		do_action( 'cocco_mikado_action_custom_taxonomy_fields' );
	}
	
	add_action( 'after_setup_theme', 'cocco_mikado_init_custom_taxonomy_fields' );
}

if ( ! function_exists( 'cocco_mikado_taxonomy_fields_add' ) ) {
	function cocco_mikado_taxonomy_fields_add() {
		global $cocco_mikado_Framework;
		
		foreach ( $cocco_mikado_Framework->mkdTaxonomyOptions->taxonomyOptions as $key => $fields ) {
			add_action( $fields->scope . '_add_form_fields', 'cocco_mikado_taxonomy_fields_display_add', 10, 2 );
		}
	}
	
	add_action( 'after_setup_theme', 'cocco_mikado_taxonomy_fields_add', 11 );
}

if ( ! function_exists( 'cocco_mikado_taxonomy_fields_edit' ) ) {
	function cocco_mikado_taxonomy_fields_edit() {
		global $cocco_mikado_Framework;
		
		foreach ( $cocco_mikado_Framework->mkdTaxonomyOptions->taxonomyOptions as $key => $fields ) {
			add_action( $fields->scope . '_edit_form_fields', 'cocco_mikado_taxonomy_fields_display_edit', 10, 2 );
		}
	}
	
	add_action( 'after_setup_theme', 'cocco_mikado_taxonomy_fields_edit', 11 );
}

if ( ! function_exists( 'cocco_mikado_taxonomy_fields_display_add' ) ) {
	function cocco_mikado_taxonomy_fields_display_add( $taxonomy ) {
		global $cocco_mikado_Framework;
		
		foreach ( $cocco_mikado_Framework->mkdTaxonomyOptions->taxonomyOptions as $key => $fields ) {
			if ( $taxonomy == $fields->scope ) {
				$fields->render();
			}
		}
	}
}

if ( ! function_exists( 'cocco_mikado_taxonomy_fields_display_edit' ) ) {
	function cocco_mikado_taxonomy_fields_display_edit( $term, $taxonomy ) {
		global $cocco_mikado_Framework;
		
		foreach ( $cocco_mikado_Framework->mkdTaxonomyOptions->taxonomyOptions as $key => $fields ) {
			if ( $taxonomy == $fields->scope ) {
				$fields->render();
			}
		}
	}
}

if ( ! function_exists( 'cocco_mikado_save_taxonomy_custom_fields' ) ) {
	function cocco_mikado_save_taxonomy_custom_fields( $term_id ) {
		$fields = apply_filters( 'cocco_mikado_filter_taxonomy_fields', array() );
		
		foreach ( $fields as $value ) {
			if ( isset( $_POST[ $value ] ) && '' !== $_POST[ $value ] ) {
				add_term_meta( $term_id, $value, $_POST[ $value ] );
			}
		}
	}
	
	add_action( 'created_term', 'cocco_mikado_save_taxonomy_custom_fields', 10, 2 );
}

if ( ! function_exists( 'cocco_mikado_update_taxonomy_custom_fields' ) ) {
	function cocco_mikado_update_taxonomy_custom_fields( $term_id ) {
		$fields = apply_filters( 'cocco_mikado_filter_taxonomy_fields', array() );
		
		foreach ( $fields as $value ) {
			if ( isset( $_POST[ $value ] ) && '' !== $_POST[ $value ] ) {
				update_term_meta( $term_id, $value, $_POST[ $value ] );
			} else {
				update_term_meta( $term_id, $value, '' );
			}
		}
	}
	
	add_action( 'edited_term', 'cocco_mikado_update_taxonomy_custom_fields', 10, 2 );
}

if ( ! function_exists( 'cocco_mikado_tax_add_script' ) ) {
	function cocco_mikado_tax_add_script() {
		wp_enqueue_media();
		wp_enqueue_script( 'cocco-mikado-tax-js', MIKADO_FRAMEWORK_ROOT . '/admin/assets/js/mkdf-ui/mkdf-tax-custom-fields.js' );
	}
	
	add_action( 'admin_enqueue_scripts', 'cocco_mikado_tax_add_script' );
}

/** Taxonomy Delete Image **/
if ( ! function_exists( 'cocco_mikado_tax_del_image' ) ) {
	function cocco_mikado_tax_del_image() {
		/** If we don't have a term_id, bail out **/
		if ( ! isset( $_GET['term_id'] ) ) {
			esc_html_e( 'Not Set or Empty', 'cocco' );
			exit;
		}
		
		$field_name = $_GET['field_name'];
		$term_id    = $_GET['term_id'];
		$imageID    = get_term_meta( $term_id, $field_name, true );  // Get our attachment ID
		
		if ( is_numeric( $imageID ) ) {                              // Verify that the attachment ID is indeed a number
			wp_delete_attachment( $imageID );                       // Delete our image
			delete_term_meta( $term_id, $field_name );// Delete our image meta
			exit;
		}
		
		esc_html_e( 'Contact Administrator', 'cocco' ); // If we've reached this point, something went wrong - enable debugging
		exit;
	}
	
	add_action( 'wp_ajax_cocco_mikado_tax_del_image', 'cocco_mikado_tax_del_image' );
}

/* Taxonomy custom fields functions - END */

/* User custom fields functions - START */

if ( ! function_exists( 'cocco_mikado_user_add_script' ) ) {
	function cocco_mikado_user_add_script() {
		wp_enqueue_script( 'cocco-mikado-user-js', MIKADO_FRAMEWORK_ROOT . '/admin/assets/js/mkdf-ui/mkdf-user-custom-fields.js' );
	}

	add_action( 'admin_enqueue_scripts', 'cocco_mikado_user_add_script' );
}

if ( ! function_exists( 'cocco_mikado_init_custom_user_fields' ) ) {
	function cocco_mikado_init_custom_user_fields() {
		do_action( 'cocco_mikado_action_custom_user_fields' );
	}
	
	add_action( 'after_setup_theme', 'cocco_mikado_init_custom_user_fields' );
}

if ( ! function_exists( 'cocco_mikado_user_fields_edit' ) ) {
	function cocco_mikado_user_fields_edit($user) {
		global $cocco_mikado_Framework;

		foreach ( $cocco_mikado_Framework->mkdUserOptions->userOptions as $key => $fields ) {

			$display_fields = false;
			foreach ($user->roles as $role) {
				if (in_array($role, $fields->scope)){
					$display_fields = true;
					break;
				}
			}
			if ( $display_fields ) {
				$fields->render();
			}
		}
	}
	
	add_action('show_user_profile', 'cocco_mikado_user_fields_edit');
	add_action('edit_user_profile', 'cocco_mikado_user_fields_edit');
}

if ( ! function_exists( 'cocco_mikado_save_user_fields' ) ) {
	function cocco_mikado_save_user_fields($user_id) {

		$fields = apply_filters( 'cocco_mikado_filter_user_fields', array() );

		foreach ( $fields as $value ) {
			if ( isset( $_POST[ $value ] ) && '' !== $_POST[ $value ] ) {
				update_user_meta( $user_id, $value, $_POST[ $value ] );
			}
		}
	}
		
	add_action( 'personal_options_update', 'cocco_mikado_save_user_fields');
	add_action( 'edit_user_profile_update', 'cocco_mikado_save_user_fields');
}
/* User custom fields functions - END */

/** User Delete Image **/
if ( ! function_exists( 'cocco_mikado_user_del_image' ) ) {
	function cocco_mikado_user_del_image() {
		/** If we don't have a term_id, bail out **/
		if ( ! isset( $_GET['user_id'] ) ) {
			esc_html_e( 'Not Set or Empty', 'cocco' );
			exit;
		}

		$field_name = $_GET['field_name'];
		$user_id    = $_GET['user_id'];
		$imageID    = get_user_meta( $user_id, $field_name, true );;  // Get our attachment ID

		if ( is_numeric( $imageID ) ) {               // Verify that the attachment ID is indeed a number
			delete_user_meta( $user_id, $field_name );// Delete our image meta
			exit;
		}

		esc_html_e( 'Contact Administrator', 'cocco' ); // If we've reached this point, something went wrong - enable debugging
		exit;
	}

	add_action( 'wp_ajax_cocco_mikado_user_del_image', 'cocco_mikado_user_del_image' );
}
?>