<?php
if ( ! function_exists( 'cocco_mikado_add_admin_page' ) ) {
	/**
	 * Generates admin page object and adds it to options
	 * $attributes array can container:
	 *      $slug - slug of the page with which it will be registered in admin, and which will be appended to admin URL
	 *      $title - title of the page
	 *      $icon - icon that will be added to admin page in options navigation
	 *
	 * @param $attributes
	 *
	 * @return bool|CoccoMikadoAdminPage
	 */
	function cocco_mikado_add_admin_page( $attributes ) {
		$slug  = '';
		$title = '';
		$icon  = '';
		
		extract( $attributes );
		
		if ( isset( $slug ) && ! empty( $title ) ) {
			$admin_page = new CoccoMikadoAdminPage( $slug, $title, $icon );
			cocco_mikado_framework()->mkdOptions->addAdminPage( $slug, $admin_page );
			
			return $admin_page;
		}
		
		return false;
	}
}

if ( ! function_exists( 'cocco_mikado_add_admin_panel' ) ) {
	/**
	 * Generates panel object from given parameters
	 * $attributes can container:
	 *      $title - title of panel
	 *      $name - name of panel with which it will be registered in admin page
	 *      $page - slug of that page to which to add panel
	 *
	 * @param $attributes
	 *
	 * @return bool|CoccoMikadoPanel
	 */
	function cocco_mikado_add_admin_panel( $attributes ) {
		$title           = '';
		$name            = '';
		$dependency      = array();
		$args            = array();
		$page            = '';
		
		extract( $attributes );
		
		if ( isset( $page ) && ! empty( $title ) && ! empty( $name ) && cocco_mikado_framework()->mkdOptions->adminPageExists( $page ) ) {
			$admin_page = cocco_mikado_framework()->mkdOptions->getAdminPage( $page );
			
			if ( is_object( $admin_page ) ) {
				$panel = new CoccoMikadoPanel( $title, $name, $args, $dependency);
				$admin_page->addChild( $name, $panel );
				
				return $panel;
			}
		}
		
		return false;
	}
}

if ( ! function_exists( 'cocco_mikado_add_admin_container' ) ) {
	/**
	 * Generates container object
	 * $attributes can contain:
	 *      $name - name of the container with which it will be added to parent element
	 *      $parent - parent object to which to add container
	 *
	 * @param $attributes
	 *
	 * @return bool|CoccoMikadoContainer
	 */
	function cocco_mikado_add_admin_container( $attributes ) {
		$name            = '';
		$parent          = '';
		$dependency      = array();
		
		extract( $attributes );
		
		if ( ! empty( $name ) && is_object( $parent ) ) {
			$container = new CoccoMikadoContainer( $name, $dependency );
			$parent->addChild( $name, $container );
			
			return $container;
		}
		
		return false;
	}
}

if ( ! function_exists( 'cocco_mikado_add_admin_twitter_button' ) ) {
	
	/**
	 * Generates twitter button field
	 *
	 * @param $attributes
	 *
	 * @return bool|CoccoMikadoTwitterFramework
	 */
	function cocco_mikado_add_admin_twitter_button( $attributes ) {
		$name   = '';
		$parent = '';
		
		extract( $attributes );
		
		if ( ! empty( $parent ) && ! empty( $name ) ) {
			$field = new CoccoMikadoTwitterFramework();
			
			if ( is_object( $parent ) ) {
				$parent->addChild( $name, $field );
			}
			
			return $field;
		}
		
		return false;
	}
}

if ( ! function_exists( 'cocco_mikado_add_admin_instagram_button' ) ) {
	
	/**
	 * Generates instagram button field
	 *
	 * @param $attributes
	 *
	 * @return bool|CoccoMikadoInstagramFramework
	 */
	function cocco_mikado_add_admin_instagram_button( $attributes ) {
		$name   = '';
		$parent = '';
		
		extract( $attributes );
		
		if ( ! empty( $parent ) && ! empty( $name ) ) {
			$field = new CoccoMikadoInstagramFramework();
			
			if ( is_object( $parent ) ) {
				$parent->addChild( $name, $field );
			}
			
			return $field;
		}
		
		return false;
	}
}

if ( ! function_exists( 'cocco_mikado_add_admin_container_no_style' ) ) {
	/**
	 * Generates container object
	 * $attributes can contain:
	 *      $name - name of the container with which it will be added to parent element
	 *      $parent - parent object to which to add container
	 *
	 * @param $attributes
	 *
	 * @return bool|CoccoMikadoContainerNoStyle
	 */
	function cocco_mikado_add_admin_container_no_style( $attributes ) {
		$name            = '';
		$parent          = '';
		$args            = array();
		$dependency      = array();

		extract( $attributes );
		
		if ( ! empty( $name ) && is_object( $parent ) ) {
			$container = new CoccoMikadoContainerNoStyle( $name, $args, $dependency );
			$parent->addChild( $name, $container );
			
			return $container;
		}
		
		return false;
	}
}

if ( ! function_exists( 'cocco_mikado_add_admin_group' ) ) {
	/**
	 * Generates group object
	 * $attributes can contain:
	 *      $name - name of the group with which it will be added to parent element
	 *      $title - title of group
	 *      $description - description of group
	 *      $parent - parent object to which to add group
	 *
	 * @param $attributes
	 *
	 * @return bool|CoccoMikadoGroup
	 */
	function cocco_mikado_add_admin_group( $attributes ) {
		$name        = '';
		$title       = '';
		$description = '';
		$parent      = '';
		
		extract( $attributes );
		
		if ( ! empty( $name ) && ! empty( $title ) && is_object( $parent ) ) {
			$group = new CoccoMikadoGroup( $title, $description );
			$parent->addChild( $name, $group );
			
			return $group;
		}
		
		return false;
	}
}

if ( ! function_exists( 'cocco_mikado_add_admin_row' ) ) {
	/**
	 * Generates row object
	 * $attributes can contain:
	 *      $name - name of the group with which it will be added to parent element
	 *      $parent - parent object to which to add row
	 *      $next - whether row has next row. Used to add bottom margin class
	 *
	 * @param $attributes
	 *
	 * @return bool|CoccoMikadoRow
	 */
	function cocco_mikado_add_admin_row( $attributes ) {
		$parent = '';
		$next   = false;
		$name   = '';
		
		extract( $attributes );
		
		if ( is_object( $parent ) ) {
			$row = new CoccoMikadoRow( $next );
			$parent->addChild( $name, $row );
			
			return $row;
		}
		
		return false;
	}
}

if ( ! function_exists( 'cocco_mikado_add_admin_field' ) ) {
	/**
	 * Generates admin field object
	 * $attributes can container:
	 *      $type - type of the field to generate
	 *      $name - name of the field. This will be name of the option in database
	 *      $default_value
	 *      $label - title of the option
	 *      $description
	 *      $options - assoc array of option. Used only for select and radiogroup field types
	 *      $args - assoc array of additional parameters. Used for dependency
	 *      $parent - parent object to which to add field
	 *
	 * @param $attributes
	 *
	 * @return bool|CoccoMikadoField
	 */
	function cocco_mikado_add_admin_field( $attributes ) {
		$type            = '';
		$name            = '';
		$default_value   = '';
		$label           = '';
		$description     = '';
		$options         = array();
		$args            = array();
		$parent          = '';
		$dependency		 = array();
		
		extract( $attributes );

		if ( ! empty( $parent ) && ! empty( $type ) && ! empty( $name ) ) {
			$field = new CoccoMikadoField( $type, $name, $default_value, $label, $description, $options, $args, $dependency );
			
			if ( is_object( $parent ) ) {
				$parent->addChild( $name, $field );
				
				return $field;
			}
		}
		
		return false;
	}
}

if ( ! function_exists( 'cocco_mikado_add_admin_section_title' ) ) {
	/**
	 * Generates admin title field
	 * $attributes can contain:
	 *      $parent - parent object to which to add title
	 *      $name - name of title with which to add it to the parent
	 *      $title - title text
	 *
	 * @param $attributes
	 *
	 * @return bool|CoccoMikadoTitle
	 */
	function cocco_mikado_add_admin_section_title( $attributes ) {
		$parent = '';
		$name   = '';
		$title  = '';
		
		extract( $attributes );
		
		if ( is_object( $parent ) && ! empty( $title ) && ! empty( $name ) ) {
			$section_title = new CoccoMikadoTitle( $name, $title );
			$parent->addChild( $name, $section_title );
			
			return $section_title;
		}
		
		return false;
	}
}

if ( ! function_exists( 'cocco_mikado_add_admin_notice' ) ) {
	/**
	 * Generates CoccoMikadoNotice object from given parameters
	 * $attributes array can contain:
	 *      $title - title of notice object
	 *      $description - description of notice object
	 *      $notice - text of notice to display
	 *      $name - unique name of notice with which it will be added to it's parent
	 *      $parent - object to which to add notice object using addChild method
	 *
	 * @param $attributes
	 *
	 * @return bool|CoccoMikadoNotice
	 */
	function cocco_mikado_add_admin_notice( $attributes ) {
		$title           = '';
		$description     = '';
		$notice          = '';
		$parent          = '';
		$name            = '';
		
		extract( $attributes );
		
		if ( is_object( $parent ) && ! empty( $title ) && ! empty( $notice ) && ! empty( $name ) ) {
			$notice_object = new CoccoMikadoNotice( $title, $description, $notice);
			$parent->addChild( $name, $notice_object );
			
			return $notice_object;
		}
		
		return false;
	}
}

if ( ! function_exists( 'cocco_mikado_framework' ) ) {
	/**
	 * Function that returns instance of CoccoMikadoFramework class
	 *
	 * @return CoccoMikadoFramework
	 */
	function cocco_mikado_framework() {
		return CoccoMikadoFramework::get_instance();
	}
}

if ( ! function_exists( 'cocco_mikado_options' ) ) {
	/**
	 * Returns instance of CoccoMikadoOptions class
	 *
	 * @return CoccoMikadoOptions
	 */
	function cocco_mikado_options() {
		return cocco_mikado_framework()->mkdOptions;
	}
}

if ( ! function_exists( 'cocco_mikado_meta_boxes' ) ) {
	/**
	 * Returns instance of CoccoMikadoMetaBoxes class
	 *
	 * @return CoccoMikadoMetaBoxes
	 */
	function cocco_mikado_meta_boxes() {
		return cocco_mikado_framework()->mkdMetaBoxes;
	}
}

/**
 * Meta boxes functions
 */
if ( ! function_exists( 'cocco_mikado_create_meta_box' ) ) {
	/**
	 * Adds new meta box
	 *
	 * @param $attributes
	 *
	 * @return bool|CoccoMikadoMetaBox
	 */
	function cocco_mikado_create_meta_box( $attributes ) {
		$scope           = array();
		$title           = '';
		$name            = '';
		
		extract( $attributes );
		
		if ( ! empty( $scope ) && $title !== '' && $name !== '' ) {
			$meta_box_obj = new CoccoMikadoMetaBox( $scope, $title, $name );
			cocco_mikado_framework()->mkdMetaBoxes->addMetaBox( $name, $meta_box_obj );
			
			return $meta_box_obj;
		}
		
		return false;
	}
}

if ( ! function_exists( 'cocco_mikado_create_meta_box_field' ) ) {
	/**
	 * Generates meta box field object
	 * $attributes can contain:
	 *      $type - type of the field to generate
	 *      $name - name of the field. This will be name of the option in database
	 *      $default_value
	 *      $label - title of the option
	 *      $description
	 *      $options - assoc array of option. Used only for select and radiogroup field types
	 *      $args - assoc array of additional parameters. Used for dependency
	 *      $parent - parent object to which to add field
	 *
	 * @param $attributes
	 *
	 * @return bool|CoccoMikadoField
	 */
	function cocco_mikado_create_meta_box_field( $attributes ) {
		$type            = '';
		$name            = '';
		$default_value   = '';
		$label           = '';
		$description     = '';
		$options         = array();
		$args            = array();
		$dependency		 = array();
		$parent          = '';
		
		extract( $attributes );
		
		if ( ! empty( $parent ) && ! empty( $type ) && ! empty( $name ) ) {
			$field = new CoccoMikadoMetaField( $type, $name, $default_value, $label, $description, $options, $args, $dependency );
			
			if ( is_object( $parent ) ) {
				$parent->addChild( $name, $field );
				
				return $field;
			}
		}
		
		return false;
	}
}

if ( ! function_exists( 'cocco_mikado_add_multiple_images_field' ) ) {
	/**
	 * Generates meta box field object
	 * $attributes can contain:
	 *      $name - name of the field. This will be name of the option in database
	 *      $label - title of the option
	 *      $description
	 *      $parent - parent object to which to add field
	 *
	 * @param $attributes
	 *
	 * @return bool|CoccoMikadoField
	 */
	function cocco_mikado_add_multiple_images_field( $attributes ) {
		$name        = '';
		$label       = '';
		$description = '';
		$parent      = '';
		
		extract( $attributes );
		
		if ( ! empty( $parent ) && ! empty( $name ) ) {
			$field = new CoccoMikadoMultipleImages( $name, $label, $description );
			
			if ( is_object( $parent ) ) {
				$parent->addChild( $name, $field );
				
				return $field;
			}
		}
		
		return false;
	}
}

if ( ! function_exists( 'cocco_mikado_get_yes_no_select_array' ) ) {
	/**
	 * Returns array of yes no
	 * @return array
	 */
	function cocco_mikado_get_yes_no_select_array( $enable_default = true, $set_yes_to_be_first = false ) {
		$select_options = array();
		
		if ( $enable_default ) {
			$select_options[''] = esc_html__( 'Default', 'cocco' );
		}
		
		if ( $set_yes_to_be_first ) {
			$select_options['yes'] = esc_html__( 'Yes', 'cocco' );
			$select_options['no']  = esc_html__( 'No', 'cocco' );
		} else {
			$select_options['no']  = esc_html__( 'No', 'cocco' );
			$select_options['yes'] = esc_html__( 'Yes', 'cocco' );
		}
		
		return $select_options;
	}
}

if ( ! function_exists( 'cocco_mikado_get_query_order_by_array' ) ) {
	/**
	 * Returns array of query order by
	 *
	 * @param bool $first_empty whether to add empty first member
	 * @param array $additional_elements
	 *
	 * @return array
	 */
	function cocco_mikado_get_query_order_by_array( $first_empty = false, $additional_elements = array() ) {
		$orderBy = array();
		
		if ( $first_empty ) {
			$orderBy[''] = esc_html__( 'Default', 'cocco' );
		}
		
		$orderBy['date']       = esc_html__( 'Date', 'cocco' );
		$orderBy['ID']         = esc_html__( 'ID', 'cocco' );
		$orderBy['menu_order'] = esc_html__( 'Menu Order', 'cocco' );
		$orderBy['name']       = esc_html__( 'Post Name', 'cocco' );
		$orderBy['rand']       = esc_html__( 'Random', 'cocco' );
		$orderBy['title']      = esc_html__( 'Title', 'cocco' );
		
		if ( ! empty( $additional_elements ) ) {
			$orderBy = array_merge( $orderBy, $additional_elements );
		}
		
		return $orderBy;
	}
}

if ( ! function_exists( 'cocco_mikado_get_query_order_array' ) ) {
	/**
	 * Returns array of query order
	 *
	 * @param bool $first_empty whether to add empty first member
	 *
	 * @return array
	 */
	function cocco_mikado_get_query_order_array( $first_empty = false ) {
		$order = array();
		
		if ( $first_empty ) {
			$order[''] = esc_html__( 'Default', 'cocco' );
		}
		
		$order['ASC']  = esc_html__( 'ASC', 'cocco' );
		$order['DESC'] = esc_html__( 'DESC', 'cocco' );
		
		return $order;
	}
}

if ( ! function_exists( 'cocco_mikado_get_space_between_items_array' ) ) {
	/**
	 * Returns array of space between items
	 *
	 * @param bool $first_empty whether to add empty first member
	 * @param bool $enable_large whether to add huge member
	 * @param bool $enable_huge whether to add large member
	 *
	 * @return array
	 */
	function cocco_mikado_get_space_between_items_array( $first_empty = false, $enable_medium = true, $enable_large = true, $enable_huge = false ) {
		$spaceBetweenItems = array();
		
		if ( $first_empty ) {
			$spaceBetweenItems[''] = esc_html__( 'Default', 'cocco' );
		}
		
		if ( $enable_huge ) {
			$spaceBetweenItems['huge']   = esc_html__( 'Huge', 'cocco' );
		}
		
		if ( $enable_large ) {
			$spaceBetweenItems['large']  = esc_html__( 'Large', 'cocco' );
		}
		
		if ( $enable_medium ) {
			$spaceBetweenItems['medium']  = esc_html__( 'Medium', 'cocco' );
		}
		
		$spaceBetweenItems['normal'] = esc_html__( 'Normal', 'cocco' );
		$spaceBetweenItems['small']  = esc_html__( 'Small', 'cocco' );
		$spaceBetweenItems['tiny']   = esc_html__( 'Tiny', 'cocco' );
		$spaceBetweenItems['no']     = esc_html__( 'No', 'cocco' );
		
		return $spaceBetweenItems;
	}
}

if ( ! function_exists( 'cocco_mikado_get_link_target_array' ) ) {
	/**
	 * Returns array of link target
	 *
	 * @param bool $first_empty whether to add empty first member
	 *
	 * @return array
	 */
	function cocco_mikado_get_link_target_array( $first_empty = false ) {
		$order = array();
		
		if ( $first_empty ) {
			$order[''] = esc_html__( 'Default', 'cocco' );
		}
		
		$order['_self']  = esc_html__( 'Same Window', 'cocco' );
		$order['_blank'] = esc_html__( 'New Window', 'cocco' );
		
		return $order;
	}
}

if ( ! function_exists( 'cocco_mikado_get_title_tag' ) ) {
	/**
	 * Returns array of title tags
	 *
	 * @param bool $first_empty
	 * @param array $additional_elements
	 *
	 * @return array
	 */
	function cocco_mikado_get_title_tag( $first_empty = false, $additional_elements = array() ) {
		$title_tag = array();
		
		if ( $first_empty ) {
			$title_tag[''] = esc_html__( 'Default', 'cocco' );
		}
		
		$title_tag['h1'] = 'h1';
		$title_tag['h2'] = 'h2';
		$title_tag['h3'] = 'h3';
		$title_tag['h4'] = 'h4';
		$title_tag['h5'] = 'h5';
		$title_tag['h6'] = 'h6';
		
		if ( ! empty( $additional_elements ) ) {
			$title_tag = array_merge( $title_tag, $additional_elements );
		}
		
		return $title_tag;
	}
}

if ( ! function_exists( 'cocco_mikado_get_font_weight_array' ) ) {
	/**
	 * Returns array of font weights
	 *
	 * @param bool $first_empty whether to add empty first member
	 *
	 * @return array
	 */
	function cocco_mikado_get_font_weight_array( $first_empty = false ) {
		$font_weights = array();
		
		if ( $first_empty ) {
			$font_weights[''] = esc_html__( 'Default', 'cocco' );
		}
		
		$font_weights['100'] = esc_html__( '100 Thin', 'cocco' );
		$font_weights['200'] = esc_html__( '200 Thin-Light', 'cocco' );
		$font_weights['300'] = esc_html__( '300 Light', 'cocco' );
		$font_weights['400'] = esc_html__( '400 Normal', 'cocco' );
		$font_weights['500'] = esc_html__( '500 Medium', 'cocco' );
		$font_weights['600'] = esc_html__( '600 Semi-Bold', 'cocco' );
		$font_weights['700'] = esc_html__( '700 Bold', 'cocco' );
		$font_weights['800'] = esc_html__( '800 Extra-Bold', 'cocco' );
		$font_weights['900'] = esc_html__( '900 Ultra-Bold', 'cocco' );
		
		return $font_weights;
	}
}

if ( ! function_exists( 'cocco_mikado_get_font_style_array' ) ) {
	/**
	 * Returns array of font styles
	 *
	 * @param bool $first_empty
	 *
	 * @return array
	 */
	function cocco_mikado_get_font_style_array( $first_empty = false ) {
		$font_styles = array();
		
		if ( $first_empty ) {
			$font_styles[''] = esc_html__( 'Default', 'cocco' );
		}
		
		$font_styles['normal']  = esc_html__( 'Normal', 'cocco' );
		$font_styles['italic']  = esc_html__( 'Italic', 'cocco' );
		$font_styles['oblique'] = esc_html__( 'Oblique', 'cocco' );
		$font_styles['initial'] = esc_html__( 'Initial', 'cocco' );
		$font_styles['inherit'] = esc_html__( 'Inherit', 'cocco' );
		
		return $font_styles;
	}
}

if ( ! function_exists( 'cocco_mikado_get_text_transform_array' ) ) {
	/**
	 * Returns array of text transforms
	 *
	 * @param bool $first_empty
	 *
	 * @return array
	 */
	function cocco_mikado_get_text_transform_array( $first_empty = false ) {
		$text_transforms = array();
		
		if ( $first_empty ) {
			$text_transforms[''] = esc_html__( 'Default', 'cocco' );
		}
		
		$text_transforms['none']       = esc_html__( 'None', 'cocco' );
		$text_transforms['capitalize'] = esc_html__( 'Capitalize', 'cocco' );
		$text_transforms['uppercase']  = esc_html__( 'Uppercase', 'cocco' );
		$text_transforms['lowercase']  = esc_html__( 'Lowercase', 'cocco' );
		$text_transforms['initial']    = esc_html__( 'Initial', 'cocco' );
		$text_transforms['inherit']    = esc_html__( 'Inherit', 'cocco' );
		
		return $text_transforms;
	}
}

if ( ! function_exists( 'cocco_mikado_get_text_decorations' ) ) {
	/**
	 * Returns array of text transforms
	 *
	 * @param bool $first_empty
	 *
	 * @return array
	 */
	function cocco_mikado_get_text_decorations( $first_empty = false ) {
		$text_decorations = array();
		
		if ( $first_empty ) {
			$text_decorations[''] = esc_html__( 'Default', 'cocco' );
		}
		
		$text_decorations['none']         = esc_html__( 'None', 'cocco' );
		$text_decorations['underline']    = esc_html__( 'Underline', 'cocco' );
		$text_decorations['overline']     = esc_html__( 'Overline', 'cocco' );
		$text_decorations['line-through'] = esc_html__( 'Line-Through', 'cocco' );
		$text_decorations['initial']      = esc_html__( 'Initial', 'cocco' );
		$text_decorations['inherit']      = esc_html__( 'Inherit', 'cocco' );
		
		return $text_decorations;
	}
}

if ( ! function_exists( 'cocco_mikado_is_font_option_valid' ) ) {
	/**
	 * Checks if font family option is valid (different that -1)
	 *
	 * @param $option_name
	 *
	 * @return bool
	 */
	function cocco_mikado_is_font_option_valid( $option_name ) {
		return $option_name !== '-1' && $option_name !== '';
	}
}

if ( ! function_exists( 'cocco_mikado_get_font_option_val' ) ) {
	/**
	 * Returns font option value without + so it can be used in css
	 *
	 * @param $option_val
	 *
	 * @return mixed
	 */
	function cocco_mikado_get_font_option_val( $option_val ) {
		$option_val = str_replace( '+', ' ', $option_val );
		
		return $option_val;
	}
}


if ( ! function_exists( 'cocco_mikado_get_icon_sources_array' ) ) {
	/**
	 * Returns array of icon sources
	 *
	 * @param bool $first_empty
	 * @param bool $enable_predefined
	 *
	 * @return array
	 */
	function cocco_mikado_get_icon_sources_array( $first_empty = false, $enable_predefined = true ) {
		$icon_sources = array();

		if ( $first_empty ) {
			$icon_sources[''] = esc_html__( 'Default', 'cocco' );
		}

		$icon_sources['icon_pack']	= esc_html__( 'Icon Pack', 'cocco' );
		$icon_sources['svg_path']	= esc_html__( 'SVG Path', 'cocco' );

		if ( $enable_predefined ) {
			$icon_sources['predefined']	= esc_html__( 'Predefined', 'cocco' );
		}

		return $icon_sources;
	}
}

if ( ! function_exists( 'cocco_mikado_get_icon_sources_class' ) ) {
	/**
	 * Returns class for icon sources
	 *
	 * @param string $option_name
	 * @param string $class_prefix
	 *
	 * @return string
	 */
	function cocco_mikado_get_icon_sources_class( $option_name = '', $class_prefix = '' ) {
		$class = '';

		if ( ! empty( $option_name ) && ! empty( $class_prefix ) ) {
			$icon_source 	= cocco_mikado_options()->getOptionValue( $option_name . '_icon_source' );

			if ( $icon_source === 'icon_pack' ) {
				$class = $class_prefix . '-icon-pack';
			} else if ( $icon_source === 'svg_path' ) {
				$class = $class_prefix . '-svg-path';
			} else if ( $icon_source === 'predefined' ) {
				$class = $class_prefix . '-predefined';
			}
		}

		return $class;
	}
}

if ( ! function_exists( 'cocco_mikado_get_icon_sources_html' ) ) {
	/**
	 * Returns html for icon sources
	 *
	 * @param string $option_name
	 * @param bool $is_close_icon
	 * @param array $args
	 *
	 * @return string/html
	 */
	function cocco_mikado_get_icon_sources_html( $option_name = '', $is_close_icon = false, $args = array() ) {
		$html = '';

		if ( ! empty( $option_name ) ) {
			$icon_source         = cocco_mikado_options()->getOptionValue( $option_name . '_icon_source' );
			$icon_pack           = cocco_mikado_options()->getOptionValue( $option_name . '_icon_pack' );
			$icon_svg_path       = cocco_mikado_options()->getOptionValue( $option_name . '_icon_svg_path' );
			$close_icon_svg_path = cocco_mikado_options()->getOptionValue( $option_name . '_close_icon_svg_path' );
			$is_search_icon      = isset( $args['search'] ) && $args['search'] === 'yes';
			$is_dropdown_cart    = isset( $args['dropdown_cart'] ) && $args['dropdown_cart'] === 'yes';

			if ( $icon_source === 'icon_pack' && isset( $icon_pack ) ) {

				if ( $is_search_icon ) {

					if ( $is_close_icon ) {
						$html .= cocco_mikado_icon_collections()->getSearchClose( $icon_pack, true );
					} else {
						$html .= cocco_mikado_icon_collections()->getSearchIcon( $icon_pack, true );
					}

				} else if ( $is_dropdown_cart ) {
					$html .= cocco_mikado_icon_collections()->getDropdownCartIcon( $icon_pack );
				} else if ( $is_close_icon ) {
					$html .= cocco_mikado_icon_collections()->getMenuCloseIcon( $icon_pack );
				} else {
					$html .= cocco_mikado_icon_collections()->getMenuIcon( $icon_pack );
				}

			} else if ( ( isset( $icon_svg_path ) && ! empty( $icon_svg_path ) ) || ( isset( $close_icon_svg_path ) && ! empty( $close_icon_svg_path ) ) ) {

				if ( $is_close_icon ) {
					$html .= $close_icon_svg_path;
				} else {
					$html .= $icon_svg_path;
				}

			} else if ( $icon_source === 'predefined' ) {

				if ( $is_close_icon ) {
					$html .= cocco_mikado_icon_collections()->getMenuCloseIcon( 'font_elegant' );
				} else {
					$html .= '<span class="mkdf-hm-lines">';
					$html .= '<span class="mkdf-hm-line mkdf-line-1"></span>';
					$html .= '<span class="mkdf-hm-line mkdf-line-2"></span>';
					$html .= '<span class="mkdf-hm-line mkdf-line-3"></span>';
					$html .= '</span>';
				}
			}
		}

		return $html;
	}
}

if ( ! function_exists( 'cocco_mikado_add_repeater_field' ) ) {
	/**
	 * Generates meta box field object
	 * $attributes can contain:
	 *      $name - name of the field. This will be name of the option in database
	 *      $label - title of the option
	 *      $description
	 *      $field_type - type of the field that will be rendered and repeated
	 *      $parent - parent object to which to add field
	 *
	 * @param $attributes
	 *
	 * @return bool|RepeaterField
	 */
	function cocco_mikado_add_repeater_field( $attributes ) {
		$name        = '';
		$label       = '';
		$description = '';
		$fields      = array();
		$parent      = '';
		$button_text = '';
		$table_layout = false;
		
		extract( $attributes );
		
		if ( ! empty( $parent ) && ! empty( $name ) ) {
			$field = new CoccoMikadoRepeater( $fields, $name, $label, $description, $button_text, $table_layout );
			
			if ( is_object( $parent ) ) {
				$parent->addChild( $name, $field );
				
				return $field;
			}
		}
		
		return false;
	}
}

/**
 * Taxonomy fields function
 */
if ( ! function_exists( 'cocco_mikado_add_taxonomy_fields' ) ) {
	/**
	 * Adds new meta box
	 *
	 * @param $attributes
	 *
	 * @return bool|MikadoMetaBox
	 */
	function cocco_mikado_add_taxonomy_fields( $attributes ) {
		$scope = array();
		$name  = '';
		
		extract( $attributes );
		
		if ( ! empty( $scope ) ) {
			$tax_obj = new CoccoMikadoTaxonomyOption( $scope );
			cocco_mikado_framework()->mkdTaxonomyOptions->addTaxonomyOptions( $name, $tax_obj );
			
			return $tax_obj;
		}
		
		return false;
	}
}

if ( ! function_exists( 'cocco_mikado_add_taxonomy_field' ) ) {
	/**
	 * Generates meta box field object
	 * $attributes can contain:
	 *      $type - type of the field to generate
	 *      $name - name of the field. This will be name of the option in database
	 *      $label - title of the option
	 *      $description
	 *      $options - assoc array of option. Used only for select and radiogroup field types
	 *      $args - assoc array of additional parameters. Used for dependency
	 *      $parent - parent object to which to add field
	 *
	 * @param $attributes
	 *
	 * @return bool|RepeaterField
	 */
	function cocco_mikado_add_taxonomy_field( $attributes ) {
		$type        = '';
		$name        = '';
		$label       = '';
		$description = '';
		$options     = array();
		$args        = array();
		$parent      = '';
		
		extract( $attributes );
		
		if ( ! empty( $parent ) && ! empty( $name ) ) {
			$field = new CoccoMikadoTaxonomyField( $type, $name, $label, $description, $options, $args);
			if ( is_object( $parent ) ) {
				$parent->addChild( $name, $field );
				
				return $field;
			}
		}
		
		return false;
	}
}

/**
 * User fields function
 */
if ( ! function_exists( 'cocco_mikado_add_user_fields' ) ) {
	/**
	 * Adds new meta box
	 *
	 * @param $attributes
	 *
	 * @return bool|MikadoMetaBox
	 */
	function cocco_mikado_add_user_fields( $attributes ) {
		$scope = array();
		$name  = '';
		
		extract( $attributes );
		
		if ( ! empty( $scope ) ) {
			$user_obj = new CoccoMikadoUserOption( $scope );
			cocco_mikado_framework()->mkdUserOptions->addUserOptions( $name, $user_obj );
			
			return $user_obj;
		}
		
		return false;
	}
}

if ( ! function_exists( 'cocco_mikado_add_user_field' ) ) {
	/**
	 * Generates meta box field object
	 * $attributes can contain:
	 *      $type - type of the field to generate
	 *      $name - name of the field. This will be name of the option in database
	 *      $label - title of the option
	 *      $description
	 *      $options - assoc array of option. Used only for select and radiogroup field types
	 *      $args - assoc array of additional parameters. Used for dependency
	 *      $parent - parent object to which to add field
	 *
	 * @param $attributes
	 *
	 * @return bool|RepeaterField
	 */
	function cocco_mikado_add_user_field( $attributes ) {
		$type        = '';
		$name        = '';
		$label       = '';
		$description = '';
		$options     = array();
		$args        = array();
		$parent      = '';
		
		extract( $attributes );
		
		if ( ! empty( $parent ) && ! empty( $name ) ) {
			$field = new CoccoMikadoUserField( $type, $name, $label, $description, $options, $args );
			if ( is_object( $parent ) ) {
				$parent->addChild( $name, $field );
				
				return $field;
			}
		}
		
		return false;
	}
}

if ( ! function_exists( 'cocco_mikado_add_user_group' ) ) {
	/**
	 * Generates group object
	 * $attributes can contain:
	 *      $name - name of the group with which it will be added to parent element
	 *      $title - title of group
	 *      $description - description of group
	 *      $parent - parent object to which to add group
	 *
	 * @param $attributes
	 *
	 * @return bool|CoccoMikadoUserGroup
	 */
	function cocco_mikado_add_user_group( $attributes ) {
		$name        = '';
		$title       = '';
		$description = '';
		$parent      = '';
		
		extract( $attributes );
		
		if ( ! empty( $name ) && ! empty( $title ) && is_object( $parent ) ) {
			$group = new CoccoMikadoUserGroup( $title, $description );
			$parent->addChild( $name, $group );
			
			return $group;
		}
		
		return false;
	}
}

/**
 * Dashboard fields function
 */
if ( ! function_exists( 'cocco_mikado_add_dashboard_fields' ) ) {
	/**
	 * Adds new meta box
	 *
	 * @param $attributes
	 *
	 * @return bool|CoccoMikadoDashboardOption
	 */
	function cocco_mikado_add_dashboard_fields( $attributes ) {
		$name = '';
		
		extract( $attributes );
		
		if ( $name !== '') {
			$dash_obj = new CoccoMikadoDashboardOption();
			cocco_mikado_framework()->mkdDashboardOptions->addDashboardOptions( $name, $dash_obj );
			
			return $dash_obj;
		}
		
		return false;
	}
}

if ( ! function_exists( 'cocco_mikado_add_dashboard_form' ) ) {
	/**
	 * Generates form object
	 * $attributes can contain:
	 *      $name - name of the form with which it will be added to parent element
	 *      $parent - parent object to which to add form
	 *      $form_id - id of form generated
	 *      $form_method - method for form generated
	 *      $form_nonce - nonce for form generated
	 *
	 * @param $attributes
	 *
	 * @return bool|CoccoMikadoContainer
	 */
	function cocco_mikado_add_dashboard_form( $attributes ) {
		$name				= '';
		$form_id			= '';
		$form_method		= 'post';
		$form_action		= '';
		$form_nonce_action	= '';
		$form_nonce_name	= '';
		$button_label		= esc_html__('SUMBIT','cocco');
		$button_args		= array();
		$parent				= '';
		
		extract( $attributes );
		
		if ( ! empty( $name ) && is_object( $parent ) && $form_id !== '') {
			$container = new CoccoMikadoDashboardForm( $name, $form_id, $form_method, $form_action, $form_nonce_action, $form_nonce_name, $button_label, $button_args);
			$parent->addChild( $name, $container );
			
			return $container;
		}
		
		return false;
	}
}

if ( ! function_exists( 'cocco_mikado_add_dashboard_group' ) ) {
	/**
	 * Generates form object
	 * $attributes can contain:
	 *      $name - name of the form with which it will be added to parent element
	 *      $parent - parent object to which to add form
	 *
	 * @param $attributes
	 *
	 * @return bool|CoccoMikadoContainer
	 */
	function cocco_mikado_add_dashboard_group( $attributes ) {
		$name		 = '';
		$title 		 = '';
		$description = '';
		$parent		 = '';
		
		extract( $attributes );
		
		if ( ! empty( $name ) && is_object( $parent ) ) {
			$container = new CoccoMikadoDashboardGroup( $name, $title, $description );
			$parent->addChild( $name, $container );
			
			return $container;
		}
		
		return false;
	}
}

if ( ! function_exists( 'cocco_mikado_add_dashboard_section_title' ) ) {
	/**
	 * Generates dashboard title field
	 * $attributes can contain:
	 *      $parent - parent object to which to add title
	 *      $name - name of title with which to add it to the parent
	 *      $title - title text
	 *
	 * @param $attributes
	 *
	 * @return bool|CoccoMikadoDashboardTitle
	 */
	function cocco_mikado_add_dashboard_section_title( $attributes ) {
		$parent = '';
		$name   = '';
		$title  = '';
		
		extract( $attributes );
		
		if ( is_object( $parent ) && ! empty( $title ) && ! empty( $name ) ) {
			$section_title = new CoccoMikadoDashboardTitle( $name, $title );
			$parent->addChild( $name, $section_title );
			
			return $section_title;
		}
		
		return false;
	}
}

if ( ! function_exists( 'cocco_mikado_add_dashboard_repeater_field' ) ) {
	/**
	 * Generates meta box field object
	 * $attributes can contain:
	 *      $name - name of the field. This will be name of the option in database
	 *      $label - title of the option
	 *      $description
	 *      $field_type - type of the field that will be rendered and repeated
	 *      $parent - parent object to which to add field
	 *
	 * @param $attributes
	 *
	 * @return bool|CoccoMikadoDashboardRepeater
	 */
	function cocco_mikado_add_dashboard_repeater_field( $attributes ) {
		$name        = '';
		$label       = '';
		$description = '';
		$fields      = array();
		$parent      = '';
		$button_text = '';
		$table_layout = false;
		$value = array();
		
		extract( $attributes );
		
		if ( ! empty( $parent ) && ! empty( $name ) ) {
			$field = new CoccoMikadoDashboardRepeater( $fields, $name, $label, $description, $button_text, $table_layout, $value);
			
			if ( is_object( $parent ) ) {
				$parent->addChild( $name, $field );
				
				return $field;
			}
		}
		
		return false;
	}
}

if ( ! function_exists( 'cocco_mikado_add_dashboard_field' ) ) {
	/**
	 * Generates dashboard field object
	 * $attributes can contain:
	 *      $type - type of the field to generate
	 *      $name - name of the field. This will be name of the option in database
	 *      $label - title of the option
	 *      $description
	 *      $options - assoc array of option. Used only for select and radiogroup field types
	 *      $args - assoc array of additional parameters. Used for dependency
	 *      $parent - parent object to which to add field
	 *      $hidden_property - name of option that hides field
	 *      $hidden_values - array of valus of $hidden_property that hides field
	 *
	 * @param $attributes
	 *
	 * @return bool|CoccoMikadoDashboardField
	 */
	function cocco_mikado_add_dashboard_field( $attributes ) {
		$type        = '';
		$name        = '';
		$label       = '';
		$description = '';
		$options     = array();
		$args        = array();
		$value       = '';
		$parent      = '';
		$repeat      = array();
		
		extract( $attributes );
		
		if ( ! empty( $parent ) && ! empty( $name ) ) {
			$field = new CoccoMikadoDashboardField( $type, $name, $label, $description, $options, $args, $value, $repeat);
			if ( is_object( $parent ) ) {
				$parent->addChild( $name, $field );
				
				return $field;
			}
		}
		
		return false;
	}
}