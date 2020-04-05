<?php
/**
 * Template part for displaying Recent Posts in the front page template
 *
 * @package Shutter_Up
 */

?>
<div class="recent-blog-content archive-posts-wrapper section">
	<div class="wrapper">
		<?php
		$post_title = get_theme_mod( 'shutter_up_recent_posts_heading', esc_html__( 'News', 'shutter-up' ) );

		if ( '' !== $post_title ) :
		?>
			<div class="section-heading-wrapper">
				<h2 class="section-title"><?php echo esc_html( $post_title ); ?></h2>
			</div><!-- .section-heading-wrap -->
		<?php
		endif;
		?>
		<div class="section-content-wrapper recent-blog-content-wrapper">
			<div id="infinite-post-wrap" class="archive-post-wrap">
				<div class="archive-grid masonry">
					<?php
					$recent_posts = new WP_Query( array(
						'ignore_sticky_posts' => true,
					) );

					/* Start the Loop */
					while ( $recent_posts->have_posts() ) :
						$recent_posts->the_post();
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class('archive-grid-item'); ?>>
							<div class="post-wrapper hentry-inner">
								<?php shutter_up_archive_image(); ?>

								<div class="entry-container">

									<header class="entry-header">
										<?php if ( 'post' === get_post_type() ) : ?>
										<div class="entry-meta">
											<?php shutter_up_cat_list(); ?>
										</div><!-- .entry-meta -->
										<?php
										endif; ?>
										
										<?php if ( is_sticky() ) { ?>
											<span class="sticky-post"><?php esc_html_e( 'Featured', 'shutter-up' ); ?></span>
										<?php } ?>

										<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

										<?php if ( 'post' === get_post_type() ) : ?>
										<div class="entry-meta">
											<?php shutter_up_posted_on(); ?>
										</div><!-- .entry-meta -->
										<?php
										endif; ?>
									</header><!-- .entry-header -->

									<div class="entry-content">
										<?php

											the_excerpt();
							
										?>
									</div><!-- .entry-content -->
								</div> <!-- .entry-container -->
							</div><!-- .hentry-inner -->
						</article><!-- #post -->
						<?php
					endwhile;

					wp_reset_postdata();
					?>
				</div><!-- .archive-grid -->	
			</div><!-- .archive-post-wrap -->
		</div><!-- .section-content-wrap -->
		<p class="view-more"><a class="more-recent-posts button" href="<?php the_permalink( get_option( 'page_for_posts' ) ); ?>"><?php esc_html_e( 'More Posts', 'shutter-up' ); ?></a></p>
	</div> <!-- .wrapper -->
</div> <!-- .recent-blog-content-wrapper -->
