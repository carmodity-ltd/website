<?php
/**
 * The template used for displaying hero content
 *
 * @package Shutter_Up
 */

$enable_section = get_theme_mod( 'shutter_up_hero_content_visibility', 'disabled' );

if ( ! shutter_up_check_section( $enable_section ) ) {
	// Bail if hero content is not enabled
	return;
}

get_template_part( 'template-parts/hero-content/post-type-hero' );
