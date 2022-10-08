<?php

if ( ! function_exists( 'cocco_mikado_get_blog_list_types_options' ) ) {
	function cocco_mikado_get_blog_list_types_options() {
		$blog_list_type_options = apply_filters( 'cocco_mikado_filter_blog_list_type_global_option', $blog_list_type_options = array() );
		
		return $blog_list_type_options;
	}
}

if ( ! function_exists( 'cocco_mikado_blog_options_map' ) ) {
	function cocco_mikado_blog_options_map() {
		$blog_list_type_options = cocco_mikado_get_blog_list_types_options();
		
		cocco_mikado_add_admin_page(
			array(
				'slug'  => '_blog_page',
				'title' => esc_html__( 'Blog', 'cocco' ),
				'icon'  => 'fa fa-files-o'
			)
		);
		
		/**
		 * Blog Lists
		 */
		$panel_blog_lists = cocco_mikado_add_admin_panel(
			array(
				'page'  => '_blog_page',
				'name'  => 'panel_blog_lists',
				'title' => esc_html__( 'Blog Lists', 'cocco' )
			)
		);

		cocco_mikado_add_admin_field(
			array(
				'name'        => 'blog_list_grid_space',
				'type'        => 'select',
				'label'       => esc_html__( 'Grid Layout Space', 'cocco' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for blog post lists. Default value is large', 'cocco' ),
				'options'     => cocco_mikado_get_space_between_items_array( true ),
				'parent'      => $panel_blog_lists
			)
		);

		cocco_mikado_add_admin_field(
			array(
				'name'          => 'blog_list_type',
				'type'          => 'select',
				'label'         => esc_html__( 'Blog Layout for Archive Pages', 'cocco' ),
				'description'   => esc_html__( 'Choose a default blog layout for archived blog post lists', 'cocco' ),
				'default_value' => 'standard',
				'parent'        => $panel_blog_lists,
				'options'       => $blog_list_type_options
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'          => 'archive_sidebar_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout for Archive Pages', 'cocco' ),
				'description'   => esc_html__( 'Choose a sidebar layout for archived blog post lists', 'cocco' ),
				'default_value' => '',
				'parent'        => $panel_blog_lists,
                'options'       => cocco_mikado_get_custom_sidebars_options(),
			)
		);
		
		$cocco_custom_sidebars = cocco_mikado_get_custom_sidebars();
		if ( count( $cocco_custom_sidebars ) > 0 ) {
			cocco_mikado_add_admin_field(
				array(
					'name'        => 'archive_custom_sidebar_area',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Sidebar to Display for Archive Pages', 'cocco' ),
					'description' => esc_html__( 'Choose a sidebar to display on archived blog post lists. Default sidebar is "Sidebar Page"', 'cocco' ),
					'parent'      => $panel_blog_lists,
					'options'     => cocco_mikado_get_custom_sidebars(),
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
		
		cocco_mikado_add_admin_field(
			array(
				'name'          => 'blog_masonry_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Layout', 'cocco' ),
				'default_value' => 'in-grid',
				'description'   => esc_html__( 'Set masonry layout. Default is in grid.', 'cocco' ),
				'parent'        => $panel_blog_lists,
				'options'       => array(
					'in-grid'    => esc_html__( 'In Grid', 'cocco' ),
					'full-width' => esc_html__( 'Full Width', 'cocco' )
				)
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'          => 'blog_masonry_number_of_columns',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Number of Columns', 'cocco' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for your masonry blog lists. Default value is 4 columns', 'cocco' ),
				'parent'        => $panel_blog_lists,
				'options'       => array(
					'two'   => esc_html__( '2 Columns', 'cocco' ),
					'three' => esc_html__( '3 Columns', 'cocco' ),
					'four'  => esc_html__( '4 Columns', 'cocco' ),
					'five'  => esc_html__( '5 Columns', 'cocco' )
				)
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'          => 'blog_masonry_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Space Between Items', 'cocco' ),
				'description'   => esc_html__( 'Set space size between posts for your masonry blog lists. Default value is normal', 'cocco' ),
				'default_value' => 'normal',
				'options'       => cocco_mikado_get_space_between_items_array(),
				'parent'        => $panel_blog_lists
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'          => 'blog_list_featured_image_proportion',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Featured Image Proportion', 'cocco' ),
				'default_value' => 'fixed',
				'description'   => esc_html__( 'Choose type of proportions you want to use for featured images on masonry blog lists', 'cocco' ),
				'parent'        => $panel_blog_lists,
				'options'       => array(
					'fixed'    => esc_html__( 'Fixed', 'cocco' ),
					'original' => esc_html__( 'Original', 'cocco' )
				)
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'          => 'blog_pagination_type',
				'type'          => 'select',
				'label'         => esc_html__( 'Pagination Type', 'cocco' ),
				'description'   => esc_html__( 'Choose a pagination layout for Blog Lists', 'cocco' ),
				'parent'        => $panel_blog_lists,
				'default_value' => 'standard',
				'options'       => array(
					'standard'        => esc_html__( 'Standard', 'cocco' ),
					'load-more'       => esc_html__( 'Load More', 'cocco' ),
					'infinite-scroll' => esc_html__( 'Infinite Scroll', 'cocco' ),
					'no-pagination'   => esc_html__( 'No Pagination', 'cocco' )
				)
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'number_of_chars',
				'default_value' => '40',
				'label'         => esc_html__( 'Number of Words in Excerpt', 'cocco' ),
				'description'   => esc_html__( 'Enter a number of words in excerpt (article summary). Default value is 40', 'cocco' ),
				'parent'        => $panel_blog_lists,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		/**
		 * Blog Single
		 */
		$panel_blog_single = cocco_mikado_add_admin_panel(
			array(
				'page'  => '_blog_page',
				'name'  => 'panel_blog_single',
				'title' => esc_html__( 'Blog Single', 'cocco' )
			)
		);

		cocco_mikado_add_admin_field(
			array(
				'name'        => 'blog_single_grid_space',
				'type'        => 'select',
				'label'       => esc_html__( 'Grid Layout Space', 'cocco' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for Blog Single pages. Default value is large', 'cocco' ),
				'options'     => cocco_mikado_get_space_between_items_array( true ),
				'parent'      => $panel_blog_single
			)
		);

		cocco_mikado_add_admin_field(
			array(
				'name'          => 'blog_single_sidebar_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'cocco' ),
				'description'   => esc_html__( 'Choose a sidebar layout for Blog Single pages', 'cocco' ),
				'default_value' => '',
				'parent'        => $panel_blog_single,
                'options'       => cocco_mikado_get_custom_sidebars_options()
			)
		);
		
		if ( count( $cocco_custom_sidebars ) > 0 ) {
			cocco_mikado_add_admin_field(
				array(
					'name'        => 'blog_single_custom_sidebar_area',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Sidebar to Display', 'cocco' ),
					'description' => esc_html__( 'Choose a sidebar to display on Blog Single pages. Default sidebar is "Sidebar"', 'cocco' ),
					'parent'      => $panel_blog_single,
					'options'     => cocco_mikado_get_custom_sidebars(),
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
		
		cocco_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_blog',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'cocco' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single post pages', 'cocco' ),
				'parent'        => $panel_blog_single,
				'options'       => cocco_mikado_get_yes_no_select_array(),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'          => 'blog_single_title_in_title_area',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Post Title in Title Area', 'cocco' ),
				'description'   => esc_html__( 'Enabling this option will show post title in title area on single post pages', 'cocco' ),
				'parent'        => $panel_blog_single,
				'default_value' => 'no'
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'          => 'blog_single_related_posts',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Related Posts', 'cocco' ),
				'description'   => esc_html__( 'Enabling this option will show related posts on single post pages', 'cocco' ),
				'parent'        => $panel_blog_single,
				'default_value' => 'no'
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'name'          => 'blog_single_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments Form', 'cocco' ),
				'description'   => esc_html__( 'Enabling this option will show comments form on single post pages', 'cocco' ),
				'parent'        => $panel_blog_single,
				'default_value' => 'yes'
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_single_navigation',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Prev/Next Single Post Navigation Links', 'cocco' ),
				'description'   => esc_html__( 'Enable navigation links through the blog posts (left and right arrows will appear)', 'cocco' ),
				'parent'        => $panel_blog_single
			)
		);
		
		$blog_single_navigation_container = cocco_mikado_add_admin_container(
			array(
				'name'            => 'mkdf_blog_single_navigation_container',
				'parent'          => $panel_blog_single,
				'dependency' => array(
					'show' => array(
						'blog_single_navigation' => 'yes'
					)
				)
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_navigation_through_same_category',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Navigation Only in Current Category', 'cocco' ),
				'description'   => esc_html__( 'Limit your navigation only through current category', 'cocco' ),
				'parent'        => $blog_single_navigation_container,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_author_info',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Author Info Box', 'cocco' ),
				'description'   => esc_html__( 'Enabling this option will display author name and descriptions on single post pages', 'cocco' ),
				'parent'        => $panel_blog_single
			)
		);
		
		$blog_single_author_info_container = cocco_mikado_add_admin_container(
			array(
				'name'            => 'mkdf_blog_single_author_info_container',
				'parent'          => $panel_blog_single,
				'dependency' => array(
					'show' => array(
						'blog_author_info' => 'yes'
					)
				)
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_author_info_email',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show Author Email', 'cocco' ),
				'description'   => esc_html__( 'Enabling this option will show author email', 'cocco' ),
				'parent'        => $blog_single_author_info_container,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_single_author_social',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Author Social Icons', 'cocco' ),
				'description'   => esc_html__( 'Enabling this option will show author social icons on single post pages', 'cocco' ),
				'parent'        => $blog_single_author_info_container,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		do_action( 'cocco_mikado_action_blog_single_options_map', $panel_blog_single );
	}
	
	add_action( 'cocco_mikado_action_options_map', 'cocco_mikado_blog_options_map', 13 );
}