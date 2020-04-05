<?php
/**
 * Header Media Options
 *
 * @package Shutter_Up
 */

/**
 * Add Header Media options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function shutter_up_header_media_options( $wp_customize ) {
	$wp_customize->get_section( 'header_image' )->description = esc_html__( 'If you add video, it will only show up on Homepage/FrontPage. Other Pages will use Header/Post/Page Image depending on your selection of option. Header Image will be used as a fallback while the video loads ', 'shutter-up' );

	shutter_up_register_option( $wp_customize, array(
			'name'              => 'shutter_up_header_media_option',
			'default'           => 'entire-site-page-post',
			'sanitize_callback' => 'shutter_up_sanitize_select',
			'choices'           => array(
				'homepage'               => esc_html__( 'Homepage / Frontpage', 'shutter-up' ),
				'exclude-home'           => esc_html__( 'Excluding Homepage', 'shutter-up' ),
				'exclude-home-page-post' => esc_html__( 'Excluding Homepage, Page/Post Featured Image', 'shutter-up' ),
				'entire-site'            => esc_html__( 'Entire Site', 'shutter-up' ),
				'entire-site-page-post'  => esc_html__( 'Entire Site, Page/Post Featured Image', 'shutter-up' ),
				'pages-posts'            => esc_html__( 'Pages and Posts', 'shutter-up' ),
				'disable'                => esc_html__( 'Disabled', 'shutter-up' ),
			),
			'label'             => esc_html__( 'Enable on', 'shutter-up' ),
			'section'           => 'header_image',
			'type'              => 'select',
			'priority'          => 1,
		)
	);

	/*Overlay Option for Header Media*/
	shutter_up_register_option( $wp_customize, array(
			'name'              => 'shutter_up_header_media_image_opacity',
			'default'           => 25,
			'sanitize_callback' => 'shutter_up_sanitize_number_range',
			'label'             => esc_html__( 'Header Media Overlay', 'shutter-up' ),
			'section'           => 'header_image',
			'type'              => 'number',
			'input_attrs'       => array(
				'style' => 'width: 60px;',
				'min'   => 0,
				'max'   => 100,
			),
		)
	);

	shutter_up_register_option( $wp_customize, array(
			'name'              => 'shutter_up_header_media_text_alignment',
			'default'           => 'text-align-center',
			'sanitize_callback' => 'shutter_up_sanitize_select',
			'choices'           => array(
				'text-align-center' => esc_html__( 'Center', 'shutter-up' ),
				'text-align-right'  => esc_html__( 'Right', 'shutter-up' ),
				'text-align-left'   => esc_html__( 'Left', 'shutter-up' ),
			),
			'label'             => esc_html__( 'Text Alignment', 'shutter-up' ),
			'section'           => 'header_image',
			'type'              => 'radio',
		)
	);

	shutter_up_register_option( $wp_customize, array(
			'name'              => 'shutter_up_header_media_content_alignment',
			'default'           => 'content-align-center',
			'sanitize_callback' => 'shutter_up_sanitize_select',
			'choices'           => array(
				'content-align-center' => esc_html__( 'Center', 'shutter-up' ),
				'content-align-right'  => esc_html__( 'Right', 'shutter-up' ),
				'content-align-left'   => esc_html__( 'Left', 'shutter-up' ),
			),
			'label'             => esc_html__( 'Content Alignment', 'shutter-up' ),
			'section'           => 'header_image',
			'type'              => 'radio',
		)
	);

	shutter_up_register_option( $wp_customize, array(
			'name'              => 'shutter_up_header_media_logo',
			'sanitize_callback' => 'esc_url_raw',
			'custom_control'    => 'WP_Customize_Image_Control',
			'label'             => esc_html__( 'Header Media Logo', 'shutter-up' ),
			'section'           => 'header_image',
		)
	);

	shutter_up_register_option( $wp_customize, array(
			'name'              => 'shutter_up_header_media_logo_option',
			'default'           => 'homepage',
			'sanitize_callback' => 'shutter_up_sanitize_select',
			'active_callback'   => 'shutter_up_is_header_media_logo_active',
			'choices'           => array(
				'homepage'               => esc_html__( 'Homepage / Frontpage', 'shutter-up' ),
				'entire-site'            => esc_html__( 'Entire Site', 'shutter-up' ) ),
			'label'             => esc_html__( 'Enable Header Media logo on', 'shutter-up' ),
			'section'           => 'header_image',
			'type'              => 'select',
		)
	);

	shutter_up_register_option( $wp_customize, array(
			'name'              => 'shutter_up_header_media_title',
			'sanitize_callback' => 'wp_kses_post',
			'default'           => esc_html__( 'Gilles Peress', 'shutter-up' ),
			'label'             => esc_html__( 'Header Media Title', 'shutter-up' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

    shutter_up_register_option( $wp_customize, array(
			'name'              => 'shutter_up_header_media_text',
			'sanitize_callback' => 'wp_kses_post',
			'default'           => esc_html__( 'World Wide Tour 2019', 'shutter-up' ),
			'label'             => esc_html__( 'Site Header Text', 'shutter-up' ),
			'section'           => 'header_image',
			'type'              => 'textarea',
		)
	);

	shutter_up_register_option( $wp_customize, array(
			'name'              => 'shutter_up_header_media_url',
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
			'label'             => esc_html__( 'Header Media Url', 'shutter-up' ),
			'section'           => 'header_image',
		)
	);

	shutter_up_register_option( $wp_customize, array(
			'name'              => 'shutter_up_header_media_url_text',
			'default'           => esc_html__( 'View More', 'shutter-up' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Header Media Url Text', 'shutter-up' ),
			'section'           => 'header_image',
		)
	);

	shutter_up_register_option( $wp_customize, array(
			'name'              => 'shutter_up_header_url_target',
			'sanitize_callback' => 'shutter_up_sanitize_checkbox',
			'label'             => esc_html__( 'Open Link in New Window/Tab', 'shutter-up' ),
			'section'           => 'header_image',
			'custom_control'    => 'Shutter_Up_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'shutter_up_header_media_options' );

/** Active Callback Functions */

if ( ! function_exists( 'shutter_up_is_header_media_logo_active' ) ) :
	/**
	* Return true if header logo is active
	*
	* @since Shutter Up 1.0
	*/
	function shutter_up_is_header_media_logo_active( $control ) {
		$logo = $control->manager->get_setting( 'shutter_up_header_media_logo' )->value();
		if ( '' != $logo ) {
			return true;
		} else {
			return false;
		}
	}
endif;
