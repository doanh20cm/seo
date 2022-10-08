<?php

if (!function_exists('cocco_mikado_sidearea_options_map')) {
    function cocco_mikado_sidearea_options_map() {

        cocco_mikado_add_admin_page(
            array(
                'slug'  => '_side_area_page',
                'title' => esc_html__('Side Area', 'cocco'),
                'icon'  => 'fa fa-indent'
            )
        );

        $side_area_panel = cocco_mikado_add_admin_panel(
            array(
                'title' => esc_html__('Side Area', 'cocco'),
                'name'  => 'side_area',
                'page'  => '_side_area_page'
            )
        );

        cocco_mikado_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'select',
                'name'          => 'side_area_type',
                'default_value' => 'side-menu-slide-from-right',
                'label'         => esc_html__('Side Area Type', 'cocco'),
                'description'   => esc_html__('Choose a type of Side Area', 'cocco'),
                'options'       => array(
                    'side-menu-slide-from-right'       => esc_html__('Slide from Right Over Content', 'cocco'),
                    'side-menu-slide-with-content'     => esc_html__('Slide from Right With Content', 'cocco'),
                    'side-area-uncovered-from-content' => esc_html__('Side Area Uncovered from Content', 'cocco'),
                ),
            )
        );

        cocco_mikado_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'text',
                'name'          => 'side_area_width',
                'default_value' => '',
                'label'         => esc_html__('Side Area Width', 'cocco'),
                'description'   => esc_html__('Enter a width for Side Area (px or %). Default width: 405px.', 'cocco'),
                'args'          => array(
                    'col_width' => 3,
                )
            )
        );

        $side_area_width_container = cocco_mikado_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_width_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_type' => 'side-menu-slide-from-right',
                    )
                )
            )
        );

        cocco_mikado_add_admin_field(
            array(
                'parent'        => $side_area_width_container,
                'type'          => 'color',
                'name'          => 'side_area_content_overlay_color',
                'default_value' => '',
                'label'         => esc_html__('Content Overlay Background Color', 'cocco'),
                'description'   => esc_html__('Choose a background color for a content overlay', 'cocco'),
            )
        );

        cocco_mikado_add_admin_field(
            array(
                'parent'        => $side_area_width_container,
                'type'          => 'text',
                'name'          => 'side_area_content_overlay_opacity',
                'default_value' => '',
                'label'         => esc_html__('Content Overlay Background Transparency', 'cocco'),
                'description'   => esc_html__('Choose a transparency for the content overlay background color (0 = fully transparent, 1 = opaque)', 'cocco'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        cocco_mikado_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'select',
                'name'          => 'side_area_icon_source',
                'default_value' => 'icon_pack',
                'label'         => esc_html__('Select Side Area Icon Source', 'cocco'),
                'description'   => esc_html__('Choose whether you would like to use icons from an icon pack or SVG icons', 'cocco'),
                'options'       => cocco_mikado_get_icon_sources_array()
            )
        );

        $side_area_icon_pack_container = cocco_mikado_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_icon_pack_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_icon_source' => 'icon_pack'
                    )
                )
            )
        );

        cocco_mikado_add_admin_field(
            array(
                'parent'        => $side_area_icon_pack_container,
                'type'          => 'select',
                'name'          => 'side_area_icon_pack',
                'default_value' => 'font_elegant',
                'label'         => esc_html__('Side Area Icon Pack', 'cocco'),
                'description'   => esc_html__('Choose icon pack for Side Area icon', 'cocco'),
                'options'       => cocco_mikado_icon_collections()->getIconCollectionsExclude(array('linea_icons', 'dripicons', 'simple_line_icons'))
            )
        );

        $side_area_svg_icons_container = cocco_mikado_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_svg_icons_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_icon_source' => 'svg_path'
                    )
                )
            )
        );

        cocco_mikado_add_admin_field(
            array(
                'parent'      => $side_area_svg_icons_container,
                'type'        => 'textarea',
                'name'        => 'side_area_icon_svg_path',
                'label'       => esc_html__('Side Area Icon SVG Path', 'cocco'),
                'description' => esc_html__('Enter your Side Area icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'cocco'),
            )
        );

        cocco_mikado_add_admin_field(
            array(
                'parent'      => $side_area_svg_icons_container,
                'type'        => 'textarea',
                'name'        => 'side_area_close_icon_svg_path',
                'label'       => esc_html__('Side Area Close Icon SVG Path', 'cocco'),
                'description' => esc_html__('Enter your Side Area close icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'cocco'),
            )
        );

        $side_area_icon_style_group = cocco_mikado_add_admin_group(
            array(
                'parent'      => $side_area_panel,
                'name'        => 'side_area_icon_style_group',
                'title'       => esc_html__('Side Area Icon Style', 'cocco'),
                'description' => esc_html__('Define styles for Side Area icon', 'cocco')
            )
        );

        $side_area_icon_style_row1 = cocco_mikado_add_admin_row(
            array(
                'parent' => $side_area_icon_style_group,
                'name'   => 'side_area_icon_style_row1'
            )
        );

        cocco_mikado_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row1,
                'type'   => 'colorsimple',
                'name'   => 'side_area_icon_color',
                'label'  => esc_html__('Color', 'cocco')
            )
        );

        cocco_mikado_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row1,
                'type'   => 'colorsimple',
                'name'   => 'side_area_icon_hover_color',
                'label'  => esc_html__('Hover Color', 'cocco')
            )
        );

        $side_area_icon_style_row2 = cocco_mikado_add_admin_row(
            array(
                'parent' => $side_area_icon_style_group,
                'name'   => 'side_area_icon_style_row2',
                'next'   => true
            )
        );

        cocco_mikado_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row2,
                'type'   => 'colorsimple',
                'name'   => 'side_area_close_icon_color',
                'label'  => esc_html__('Close Icon Color', 'cocco')
            )
        );

        cocco_mikado_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row2,
                'type'   => 'colorsimple',
                'name'   => 'side_area_close_icon_hover_color',
                'label'  => esc_html__('Close Icon Hover Color', 'cocco')
            )
        );

        cocco_mikado_add_admin_field(
            array(
                'parent'      => $side_area_panel,
                'type'        => 'color',
                'name'        => 'side_area_background_color',
                'label'       => esc_html__('Background Color', 'cocco'),
                'description' => esc_html__('Choose a background color for Side Area', 'cocco')
            )
        );

		cocco_mikado_add_admin_field(
			array(
				'parent'      => $side_area_panel,
				'type'        => 'image',
				'name'        => 'side_area_background_image',
				'label'       => esc_html__('Background Image', 'cocco'),
				'description' => esc_html__('Choose a background image for Side Area', 'cocco')
			)
		);

        cocco_mikado_add_admin_field(
            array(
                'parent'      => $side_area_panel,
                'type'        => 'text',
                'name'        => 'side_area_padding',
                'label'       => esc_html__('Padding', 'cocco'),
                'description' => esc_html__('Define padding for Side Area in format top right bottom left', 'cocco'),
                'args'        => array(
                    'col_width' => 3
                )
            )
        );

        cocco_mikado_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'select',
                'name'          => 'side_area_aligment',
                'default_value' => '',
                'label'         => esc_html__('Text Alignment', 'cocco'),
                'description'   => esc_html__('Choose text alignment for side area', 'cocco'),
                'options'       => array(
                    ''       => esc_html__('Default', 'cocco'),
                    'left'   => esc_html__('Left', 'cocco'),
                    'center' => esc_html__('Center', 'cocco'),
                    'right'  => esc_html__('Right', 'cocco')
                )
            )
        );
    }

    add_action('cocco_mikado_action_options_map', 'cocco_mikado_sidearea_options_map', 5);
}