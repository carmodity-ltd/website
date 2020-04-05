<?php
/**
 * Template for displaying search forms in Shutter Up
 *
* @package Shutter_Up
 */
?>

<?php
$unique_id   = esc_attr( uniqid( 'search-form-' ) );
$search_text = get_theme_mod( 'shutter_up_search_text', esc_html__( 'Search', 'shutter-up' ) );
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo $unique_id; ?>">
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'shutter-up' ); ?></span>
		<input type="search" id="<?php echo $unique_id; ?>" class="search-field" placeholder="<?php echo esc_attr( $search_text ); ?>" value="<?php the_search_query(); ?>" name="s" />
	</label>

	<button type="submit" class="search-submit"><?php echo shutter_up_get_svg( array( 'icon' => 'search' ) ); ?><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'shutter-up' ); ?></span></button>
</form>
