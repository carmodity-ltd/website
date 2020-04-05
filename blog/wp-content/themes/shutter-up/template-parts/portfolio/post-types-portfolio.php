<?php
/**
 * The template for displaying portfolio items
 *
 * @package Shutter_Up
 */
?>

<?php
$number = get_theme_mod( 'shutter_up_portfolio_number', 6 );

if ( ! $number ) {
	// If number is 0, then this section is disabled
	return;
}

$args = array(
	'orderby'             => 'post__in',
	'ignore_sticky_posts' => 1 // ignore sticky posts
);

$post_list  = array();// list of valid post/page ids

$no_of_post = 0; // for number of posts

$type = 'jetpack-portfolio';

$args['post_type'] = $type;

for ( $i = 1; $i <= $number; $i++ ) {
	$post_id = '';

	$post_id =  get_theme_mod( 'shutter_up_portfolio_cpt_' . $i );
	

	if ( $post_id && '' !== $post_id ) {
		// Polylang Support.
		if ( class_exists( 'Polylang' ) ) {
			$post_id = pll_get_post( $post_id, pll_current_language() );
		}

		$post_list = array_merge( $post_list, array( $post_id ) );

		$no_of_post++;
	}
}

$args['post__in'] = $post_list;


if ( 0 === $no_of_post ) {
	return;
}

$args['posts_per_page'] = $no_of_post;
$loop     = new WP_Query( $args );

$slider_select = get_theme_mod( 'shutter_up_portfolio_slider', 1 );

if ( $loop -> have_posts() ) :
	while ( $loop -> have_posts() ) :
		$loop -> the_post();
		
		$categories_list = get_the_category();

		$classes = 'grid-item';
		foreach ( $categories_list as $cat ) {
			$classes .= ' ' . $cat->slug ;
		}

		if ( 0 === $loop->current_post || 4 === $loop->current_post ) {
			$classes .= ' wide';
		}
		?>

		<article id="portfolio-post-<?php the_ID(); ?>" <?php post_class( esc_attr( $classes ) ); ?>>
			<div class="hentry-inner">
				<?php shutter_up_post_thumbnail( 'shutter-up-portfolio', 'html', true, true ); ?>
				
				<div class="entry-container">
					<header class="entry-header">
						<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

						<div class="entry-meta">
							<?php shutter_up_posted_on(); ?>
						</div>
					</header>
				</div><!-- .entry-container -->
			</div><!-- .hentry-inner -->
		</article>
	<?php
	endwhile;
	wp_reset_postdata();
endif;
