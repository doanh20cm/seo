<?php

if ( ! function_exists( 'cocco_mikado_popup_options_map' ) ) {
	function cocco_mikado_popup_options_map() {
		$cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
		
		$contact_forms = array();
		if ( $cf7 ) {
			foreach ( $cf7 as $cform ) {
				$contact_forms[ $cform->ID ] = $cform->post_title;
			}
		} else {
			$contact_forms[0] = esc_html__( 'No contact forms found', 'cocco' );
		}
		
		cocco_mikado_add_admin_page(
			array(
				'slug'  => '_popup_page',
				'title' => esc_html__( 'Pop-up', 'cocco' ),
				'icon'  => 'fa fa-pencil-square-o'
			)
		);
		
		$popup_panel = cocco_mikado_add_admin_panel(
			array(
				'title' => esc_html__( 'Pop-up', 'cocco' ),
				'name'  => 'popup',
				'page'  => '_popup_page'
			)
		);
		
		cocco_mikado_add_admin_field(
			array(
				'parent'        => $popup_panel,
				'type'          => 'yesno',
				'name'          => 'enable_popup',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Pop-up', 'cocco' ),
				'description'   => '',
			)
		);
		
		$enable_popup_container = cocco_mikado_add_admin_container(
			array(
				'parent'     => $popup_panel,
				'name'       => 'enable_popup_container',
				'dependency' => array(
					'hide' => array(
						'enable_popup' => array( 'no', '' )
					)
				)
			)
		);

        cocco_mikado_add_admin_field(
			array(
				'parent'        => $enable_popup_container,
				'type'          => 'text',
				'name'          => 'popup_title',
				'default_value' => '',
				'label'         => esc_html__( 'Title', 'cocco' ),
				'description'   => esc_html__( 'Enter title pop-up window', 'cocco' )
			)
		);

        cocco_mikado_add_admin_field(
			array(
				'parent'        => $enable_popup_container,
				'type'          => 'text',
				'name'          => 'popup_subtitle',
				'default_value' => '',
				'label'         => esc_html__( 'Subtitle', 'cocco' ),
				'description'   => esc_html__( 'Enter subtitle pop-up window', 'cocco' )
			)
		);

        cocco_mikado_add_admin_field(
			array(
				'parent'        => $enable_popup_container,
				'type'          => 'image',
				'name'          => 'popup_background_image',
				'default_value' => '',
				'label'         => esc_html__( 'Background Image', 'cocco' )
			)
		);

        cocco_mikado_add_admin_field(
			array(
				'name'          => 'popup_contact_form',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Select Contact Form', 'cocco' ),
				'description'   => esc_html__( 'Choose contact form to display in popup window', 'cocco' ),
				'parent'        => $enable_popup_container,
				'options'       => $contact_forms
			)
		);

        cocco_mikado_add_admin_field(
			array(
				'name'          => 'popup_contact_form_style',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Contact Form Style', 'cocco' ),
				'description'   => esc_html__( 'Choose style defined in Contact Form 7 option tab', 'cocco' ),
				'parent'        => $enable_popup_container,
				'options'       => array(
					'default'            => esc_html__( 'Default', 'cocco' ),
					'cf7_custom_style_1' => esc_html__( 'Custom Style 1', 'cocco' ),
					'cf7_custom_style_2' => esc_html__( 'Custom Style 2', 'cocco' ),
					'cf7_custom_style_3' => esc_html__( 'Custom Style 3', 'cocco' )
				)
			)
		);

        cocco_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_popup_prevent',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Enable Pop-up Prevent', 'cocco' ),
				'parent'        => $enable_popup_container
			)
		);

        cocco_mikado_add_admin_field(
			array(
				'name'          => 'popup_prevent_behavior',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Pop-up Prevent Behavior', 'cocco' ),
				'options'       => array(
					'session' => esc_html__( 'Manage Pop-up Prevent by Current Session', 'cocco' ),
					'cookies' => esc_html__( 'Manage Pop-up Prevent by Browser Cookies', 'cocco' )
				),
				'dependency'    => array(
					'show' => array(
						'enable_popup_prevent' => array( 'yes' )
					)
				),
				'parent'        => $enable_popup_container
			)
		);
	}
	
	add_action( 'cocco_mikado_action_options_map', 'cocco_mikado_popup_options_map', 16 );
}