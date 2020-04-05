<?php
/**
 * The template used for displaying testimonial on front page
 *
 * @package Shutter_Up
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="hentry-inner">
		<?php shutter_up_post_thumbnail( 'shutter-up-testimonial', 'html', true, false ); ?>

		<div class="entry-container">
			<?php $position = get_post_meta( get_the_id(), 'ect_testimonial_position', true ); ?>

			<?php if ( $position ) : ?>
					<header class="entry-header">
						<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
						<?php if ( $position ) : ?>
							<p class="entry-meta"><span class="position">
								<?php echo esc_html( $position ); ?></span>
							</p>
						<?php endif; ?>
					</header>
			<?php endif;?>
			
			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div>
		</div><!-- .entry-container -->	
	</div><!-- .hentry-inner -->
</article>
