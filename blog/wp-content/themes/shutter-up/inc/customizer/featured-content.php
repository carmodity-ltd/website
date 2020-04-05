<?php
/**
 * Featured Content options
 *
 * @package Shutter_Up
 */

/**
 * Add featured content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function shutter_up_featured_content_options( $wp_customize ) {
	// Add note to ECT Featured Content Section
    shutter_up_register_option( $wp_customize, array(
            'name'              => 'shutter_up_featured_content_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Shutter_Up_Note_Control',
            'label'             => sprintf( esc_html__( 'For all Featured Content Options for Shutter Up Theme, go %1$shere%2$s', 'shutter-up' ),
                '<a href="javascript:wp.customize.section( \'shutter_up_featured_content\' ).focus();">',
                 '</a>'
            ),
           'section'            => 'featured_content',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'shutter_up_featured_content', array(
			'title' => esc_html__( 'Featured Content', 'shutter-up' ),
			'panel' => 'shutter_up_theme_options',
		)
	);

	$action = 'install-plugin';
	$slug   = 'essential-content-types';

	$install_url = wp_nonce_url(
	    add_query_arg(
	        array(
	            'action' => $action,
	            'plugin' => $slug
	        ),
	        admin_url( 'update.php' )
	    ),
	    $action . '_' . $slug
	);

	// Add note to ECT Featured Content Section
    shutter_up_register_option( $wp_customize, array(
            'name'              => 'shutter_up_featured_content_etc_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Shutter_Up_Note_Control',
            'active_callback'   => 'shutter_up_is_ect_featured_content_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Featured Content, install %1$sEssential Content Types%2$s Plugin with Featured Content Type Enabled', 'shutter-up' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'shutter_up_featured_content',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	// Add color scheme setting and control.
	shutter_up_register_option( $wp_customize, array(
			'name'              => 'shutter_up_featured_content_option',
			'default'           => 'disabled',
			'active_callback'   => 'shutter_up_is_ect_featured_content_active',
			'sanitize_callback' => 'shutter_up_sanitize_select',
			'choices'           => shutter_up_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'shutter-up' ),
			'section'           => 'shutter_up_featured_content',
			'type'              => 'select',
		)
	);

    shutter_up_register_option( $wp_customize, array(
            'name'              => 'shutter_up_featured_content_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Shutter_Up_Note_Control',
            'active_callback'   => 'shutter_up_is_featured_content_active',
            'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'shutter-up' ),
                 '<a href="javascript:wp.customize.control( \'featured_content_title\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'shutter_up_featured_content',
            'type'              => 'description',
        )
    );

	shutter_up_register_option( $wp_customize, array(
			'name'              => 'shutter_up_featured_content_number',
			'default'           => 6,
			'sanitize_callback' => 'shutter_up_sanitize_number_range',
			'active_callback'   => 'shutter_up_is_featured_content_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Featured Content is changed (Max no of Featured Content is 20)', 'shutter-up' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of Featured Content', 'shutter-up' ),
			'section'           => 'shutter_up_featured_content',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	$number = get_theme_mod( 'shutter_up_featured_content_number', 3 );

	//loop for featured post content
	for ( $i = 1; $i <= $number ; $i++ ) {

		shutter_up_register_option( $wp_customize, array(
				'name'              => 'shutter_up_featured_content_cpt_' . $i,
				'sanitize_callback' => 'shutter_up_sanitize_post',
				'active_callback'   => 'shutter_up_is_featured_content_active',
				'label'             => esc_html__( 'Featured Content', 'shutter-up' ) . ' ' . $i ,
				'section'           => 'shutter_up_featured_content',
				'type'              => 'select',
                'choices'           => shutter_up_generate_post_array( 'featured-content' ),
			)
		);

	} // End for().

}
add_action( 'customize_register', 'shutter_up_featured_content_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'shutter_up_is_featured_content_active' ) ) :
	/**
	* Return true if featured content is active
	*
	* @since Shutter Up 1.0
	*/
	function shutter_up_is_featured_content_active( $control ) {
		$enable = $control->manager->get_setting( 'shutter_up_featured_content_option' )->value();

		return ( shutter_up_is_ect_featured_content_active( $control ) &&  shutter_up_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'shutter_up_is_ect_featured_content_active' ) ) :
    /**
    * Return true if featured_content is active
    *
    * @since Shutter Up 1.0
    */
    function shutter_up_is_ect_featured_content_active( $control ) {
        return ( class_exists( 'Essential_Content_Featured_Content' ) || class_exists( 'Essential_Content_Pro_Featured_Content' ) );
    }
endif;

if ( ! function_exists( 'shutter_up_is_ect_featured_content_inactive' ) ) :
    /**
    * Return true if featured_content is active
    *
    * @since Shutter_Up 1.0
    */
    function shutter_up_is_ect_featured_content_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Featured_Content' ) || class_exists( 'Essential_Content_Pro_Featured_Content' ) );
    }
endif;
