<?php
/**
 * The template for displaying portfolio items
 *
 * @package Shutter_Up
 */
?>

<?php
$enable = get_theme_mod( 'shutter_up_portfolio_option', 'disabled' );

if ( ! shutter_up_check_section( $enable ) ) {
	// Bail if portfolio section is disabled.
	return;
}

$title     = get_option( 'jetpack_portfolio_title', esc_html__( 'Projects', 'shutter-up' ) );
$sub_title = get_option( 'jetpack_portfolio_content' );

$classes[] = 'layout-special';
$classes[] = 'jetpack-portfolio section';

if ( ! $title && ! $sub_title ) {
	$classes[] = 'no-section-heading';
}
?>

<div id="portfolio-content-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<?php if ( $title || $sub_title ) : ?>
			<div class="section-heading-wrapper portfolio-section-headline">
				<?php if ( $title ) : ?>
					<div class="section-title-wrapper">
						<h2 class="section-title"><?php echo wp_kses_post( $title ); ?></h2>
					</div><!-- .section-title-wrapper -->
				<?php endif; ?>

				<?php if ( $sub_title ) : ?>
					<div class="section-description-wrapper section-subtitle">
						<?php
						$sub_title = apply_filters( 'the_content', $sub_title );
						echo wp_kses_post( str_replace( ']]>', ']]&gt;', $sub_title ) );
						?>
					</div><!-- .section-description-wrapper -->
				<?php endif; ?>
			</div><!-- .section-heading-wrapper -->
		<?php endif; ?>

		<div class="section-content-wrapper portfolio-content-wrapper layout-special">
			<div class="portfolio-grid">
				<div class="grid-sizer"></div>
				
				<?php
					get_template_part( 'template-parts/portfolio/post-types', 'portfolio' );				
				?>
			</div>
		</div><!-- .section-content-wrap -->

		<?php
			$target = get_theme_mod( 'shutter_up_portfolio_target' ) ? '_blank': '_self';
			$link   = get_theme_mod( 'shutter_up_portfolio_link', '#' );
			$text   = get_theme_mod( 'shutter_up_portfolio_text', esc_html__( 'View More', 'shutter-up' ) );

			if ( $text ) :
		?>

		<p class="view-more">
			<a class="button" target="<?php echo $target; ?>" href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $text ); ?></a>
		</p>
		<?php endif; ?>
	</div><!-- .wrapper -->
</div><!-- #portfolio-section -->
