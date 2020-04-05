<?php
/**
 * Add Testimonial Settings in Customizer
 *
 * @package Shutter Up
*/

/**
 * Add testimonial options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function shutter_up_testimonial_options( $wp_customize ) {
	// Add note to Jetpack Testimonial Section
	shutter_up_register_option( $wp_customize, array(
			'name'              => 'shutter_up_jetpack_testimonial_cpt_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Shutter_Up_Note_Control',
			'label'             => sprintf( esc_html__( 'For Testimonial Options for Shutter Up Theme, go %1$shere%2$s', 'shutter-up' ),
				'<a href="javascript:wp.customize.section( \'shutter_up_testimonials\' ).focus();">',
				 '</a>'
			),
		   'section'            => 'jetpack_testimonials',
			'type'              => 'description',
			'priority'          => 1,
		)
	);

	$wp_customize->add_section( 'shutter_up_testimonials', array(
			'panel'    => 'shutter_up_theme_options',
			'title'    => esc_html__( 'Testimonials', 'shutter-up' ),
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

	shutter_up_register_option( $wp_customize, array(
	        'name'              => 'shutter_up_testimonial_jetpack_note',
	        'sanitize_callback' => 'sanitize_text_field',
	        'custom_control'    => 'Shutter_Up_Note_Control',
	        'active_callback'   => 'shutter_up_is_ect_testimonial_inactive',
	        /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
	        'label'             => sprintf( esc_html__( 'For Testimonial, install %1$sEssential Content Types%2$s Plugin with testimonial Type Enabled', 'shutter-up' ),
	            '<a target="_blank" href="' . esc_url( $install_url ) . '">',
	            '</a>'

	        ),
	       'section'            => 'shutter_up_testimonials',
	        'type'              => 'description',
	        'priority'          => 1,
	    )
	);

	shutter_up_register_option( $wp_customize, array(
			'name'              => 'shutter_up_testimonial_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'shutter_up_sanitize_select',
			'active_callback'   => 'shutter_up_is_ect_testimonial_active',
			'choices'           => shutter_up_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'shutter-up' ),
			'section'           => 'shutter_up_testimonials',
			'type'              => 'select',
			'priority'          => 1,
		)
	);

	shutter_up_register_option( $wp_customize, array(
			'name'              => 'shutter_up_testimonial_cpt_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Shutter_Up_Note_Control',
			'active_callback'   => 'shutter_up_is_testimonial_active',
			/* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'shutter-up' ),
				'<a href="javascript:wp.customize.section( \'jetpack_testimonials\' ).focus();">',
				'</a>'
			),
			'section'           => 'shutter_up_testimonials',
			'type'              => 'description',
		)
	);

	shutter_up_register_option( $wp_customize, array(
			'name'              => 'shutter_up_testimonial_number',
			'default'           => '3',
			'sanitize_callback' => 'shutter_up_sanitize_number_range',
			'active_callback'   => 'shutter_up_is_testimonial_active',
			'label'             => esc_html__( 'Number of items', 'shutter-up' ),
			'section'           => 'shutter_up_testimonials',
			'type'              => 'number',
			'input_attrs'       => array(
				'style'             => 'width: 100px;',
				'min'               => 0,
			),
		)
	);

	$number = get_theme_mod( 'shutter_up_testimonial_number', 3 );

	for ( $i = 1; $i <= $number ; $i++ ) {

		//for CPT
		shutter_up_register_option( $wp_customize, array(
				'name'              => 'shutter_up_testimonial_cpt_' . $i,
				'sanitize_callback' => 'shutter_up_sanitize_post',
				'active_callback'   => 'shutter_up_is_testimonial_active',
				'label'             => esc_html__( 'Testimonial', 'shutter-up' ) . ' ' . $i ,
				'section'           => 'shutter_up_testimonials',
				'type'              => 'select',
				'choices'           => shutter_up_generate_post_array( 'jetpack-testimonial' ),
			)
		);

	} // End for().
}
add_action( 'customize_register', 'shutter_up_testimonial_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'shutter_up_is_testimonial_active' ) ) :
	/**
	* Return true if testimonial is active
	*
	* @since Shutter Up 1.0
	*/
	function shutter_up_is_testimonial_active( $control ) {
		$enable = $control->manager->get_setting( 'shutter_up_testimonial_option' )->value();

        //return true only if previwed page on customizer matches the type of content option selected
        return ( shutter_up_is_ect_testimonial_active( $control ) &&  shutter_up_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'shutter_up_is_ect_testimonial_inactive' ) ) :
    /**
    *
    * @since Shutter Up 1.0
    */
    function shutter_up_is_ect_testimonial_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Jetpack_testimonial' ) || class_exists( 'Essential_Content_Pro_Jetpack_testimonial' ) );
    }
endif;

if ( ! function_exists( 'shutter_up_is_ect_testimonial_active' ) ) :
    /**
    *
    * @since Shutter Up 1.0
    */
    function shutter_up_is_ect_testimonial_active( $control ) {
        return ( class_exists( 'Essential_Content_Jetpack_testimonial' ) || class_exists( 'Essential_Content_Pro_Jetpack_testimonial' ) );
    }
endif;



