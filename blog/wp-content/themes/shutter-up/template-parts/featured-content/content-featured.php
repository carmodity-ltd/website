<?php
/**
 * The template for displaying featured posts on the front page
 *
 * @package Shutter_Up
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( ); ?>>
	<div class="hentry-inner">
		<?php shutter_up_post_thumbnail(); ?>

		<div class="entry-container">
			<header class="entry-header">

				<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php shutter_up_cat_list(); ?>
				</div><!-- .entry-meta -->
				<?php
				endif; ?>

				<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h2>' ); ?>
				
				<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php shutter_up_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php
				endif; ?>
			</header>
			<?php
				$excerpt = get_the_excerpt();
				echo '<div class="entry-summary"><p>' . $excerpt . '</p></div><!-- .entry-summary -->';
			?>
		</div><!-- .entry-container -->
	</div><!-- .hentry-inner -->
</article>
