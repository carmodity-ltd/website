<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Shutter_Up
 */

if ( ! function_exists( 'shutter_up_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function shutter_up_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

		echo '<span class="posted-on">' .  $posted_on . '</span>';
	}
endif;

if ( ! function_exists( 'shutter_up_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function shutter_up_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			$categories_list = get_the_category_list( ' ' ); // Separate list by space.

			if ( $categories_list  ) {
				echo '<span class="cat-links">' . shutter_up_get_svg( array( 'icon' => 'folder-open' ) ) . '<span class="screen-reader-text">' . __( 'Categories', 'shutter-up' ) . '</span>' . $categories_list . '</span>';
			}

			$tags_list = get_the_tag_list( '', ' ' ); // Separate list by space.

			if ( $tags_list  ) {
				echo '<span class="tags-links">' . shutter_up_get_svg( array( 'icon' => 'tag' ) ) . '<span class="screen-reader-text">' . __( 'Tags', 'shutter-up' ) . ',' . '</span>' . $tags_list . '</span>';
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">' . shutter_up_get_svg( array( 'icon' => 'comment' ) );
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'shutter-up' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'shutter-up' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'shutter_up_author_bio' ) ) :
	/**
	 * Prints HTML with meta information for the author bio.
	 */
	function shutter_up_author_bio() {
		if ( '' !== get_the_author_meta( 'description' ) ) {
			get_template_part( 'template-parts/biography' );
		}
	}
endif;

if ( ! function_exists( 'shutter_up_by_line' ) ) :
	/**
	 * Prints HTML with meta information for the author bio.
	 */
	function shutter_up_by_line() {
		$post_id = get_queried_object_id();
		$post_author_id = get_post_field( 'post_author', $post_id );

		$byline = '<span class="author vcard">';

		$byline .= '<a class="url fn n" href="' . esc_url( get_author_posts_url( $post_author_id ) ) . '">' . esc_html( get_the_author_meta( 'nickname', $post_author_id ) ) . '</a></span>';

		echo '<span class="byline">' .  esc_html__( ' by ', 'shutter-up' ) . $byline . '</span>';
	}
endif;

if ( ! function_exists( 'shutter_up_cat_list' ) ) :
	/**
	 * Prints HTML with meta information for the categories
	 */
	function shutter_up_cat_list() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the / */
			$categories_list = get_the_category_list( esc_html__( ', ', 'shutter-up' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>', esc_html__(  'Cat Links', 'shutter-up' ), $categories_list ); // WPCS: XSS OK.
			}
		} elseif ( 'jetpack-portfolio' == get_post_type() ) {
			/* translators: used between list items, there is a space after the / */
			$categories_list = get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '', esc_html__( ' / ', 'shutter-up' ) );

			if ( ! is_wp_error( $categories_list ) ) {
				printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>', esc_html__(  'Cat Links', 'shutter-up' ), $categories_list ); // WPCS: XSS OK.
			}
		}
	}
endif;

if ( ! function_exists( 'shutter_up_entry_category_date' ) ) :
	/**
	 * Prints HTML with category and tags for current post.
	 *
	 * Create your own shutter_up_entry_category_date() function to override in a child theme.
	 *
	 * @since Shutter Up 1.0
	 */
	function shutter_up_entry_category_date() {
		$meta = '<div class="entry-meta">';

		$portfolio_categories_list = get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '<span class="portfolio-entry-meta entry-meta">', esc_html_x( ', ', 'Used between list items, there is a space after the comma.', 'shutter-up' ), '</span>' );

		if ( 'jetpack-portfolio' === get_post_type() ) {
			$meta .= sprintf( '<span class="cat-links">%1$s%2$s</span>',
				sprintf( _x( '<span class="screen-reader-text">Categories: </span>', 'Used before category names.', 'shutter-up' ) ),
				$portfolio_categories_list
			);
		}

		$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'shutter-up' ) );
		if ( $categories_list && shutter_up_categorized_blog() ) {
			$meta .= sprintf( '<span class="cat-links">%1$s%2$s</span>',
				sprintf( _x( '<span class="screen-reader-text">Categories: </span>', 'Used before category names.', 'shutter-up' ) ),
				$categories_list
			);
		}

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$meta .= sprintf( '<span class="posted-on">%1$s<a href="%2$s" rel="bookmark">%3$s</a></span>',
			sprintf( __( '<span class="date-label">Posted on </span>', 'shutter-up' ) ),
			esc_url( get_permalink() ),
			$time_string
		);

		$meta .= '</div><!-- .entry-meta -->';

		return $meta;
	}
endif;

if ( ! function_exists( 'shutter_up_categorized_blog' ) ) :
	/**
	 * Determines whether blog/site has more than one category.
	 *
	 * Create your own shutter_up_categorized_blog() function to override in a child theme.
	 *
	 * @since Shutter Up 1.0
	 *
	 * @return bool True if there is more than one category, false otherwise.
	 */
	function shutter_up_categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'shutter_up_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'fields'     => 'ids',
				// We only need to know if there is more than one category.
				'number'     => 2,
			) );

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'shutter_up_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so shutter_up_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so shutter_up_categorized_blog should return false.
			return false;
		}
	}
endif;

if ( ! function_exists( 'shutter_up_single_image' ) ) :
	/**
	 * Display Single Page/Post Image
	 */
	function shutter_up_single_image() {
		global $post, $wp_query;

		if ( is_attachment() ) {
			$parent = $post->post_parent;
			$metabox_feat_img = get_post_meta( $parent, 'shutter-up-featured-image', true );
		} else {
			$metabox_feat_img = get_post_meta( $post->ID, 'shutter-up-featured-image', true );
		}

		if ( empty( $metabox_feat_img ) || ! is_singular() ) {
			$metabox_feat_img = 'default';
		}

		$featured_image = get_theme_mod( 'shutter_up_single_layout', 'disabled' );

		if ( ( 'disabled' == $metabox_feat_img  || ! has_post_thumbnail() || ( 'default' == $metabox_feat_img && 'disabled' == $featured_image ) ) ) {
			echo '<!-- Page/Post Single Image Disabled or No Image set in Post Thumbnail -->';
			return false;
		}
		else {
			$class = '';

			if ( 'default' == $metabox_feat_img ) {
				$class = $featured_image;
			}
			else {
				$class = 'from-metabox ' . $metabox_feat_img;
				$featured_image = $metabox_feat_img;
			}

			?>
			<figure class="entry-image <?php echo esc_attr( $class ); ?>">
                <?php the_post_thumbnail( $featured_image ); ?>
	        </figure>
	   	<?php
		}
	}
endif; // shutter_up_single_image.

if ( ! function_exists( 'shutter_up_archive_image' ) ) :
	/**
	 * Display Post Archive Image
	 */
	function shutter_up_archive_image() {
		if ( ! has_post_thumbnail() ) {
			// Bail if there is no featured image.
			return;
		}

		$archive_layout = 'excerpt';
		
		shutter_up_post_thumbnail();
	}
endif; // shutter_up_archive_image.

if ( ! function_exists( 'shutter_up_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 */
	function shutter_up_comment( $comment, $args, $depth ) {
		if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<div class="comment-body">
				<?php esc_html_e( 'Pingback:', 'shutter-up' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( 'Edit', 'shutter-up' ), '<span class="edit-link">', '</span>' ); ?>
			</div>

		<?php else : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">

				<div class="comment-author vcard">
					<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
				</div><!-- .comment-author -->

				<div class="comment-container">
					<header class="comment-meta">
						<?php printf( __( '%s <span class="says screen-reader-text">says:</span>', 'shutter-up' ), sprintf( '<cite class="fn author-name">%s</cite>', get_comment_author_link() ) ); ?>

						<a class="comment-permalink entry-meta" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<?php echo shutter_up_get_svg( array( 'icon' => 'clock-o' ) ); ?>
						<time datetime="<?php comment_time( 'c' ); ?>"><?php printf( esc_html__( '%s ago', 'shutter-up' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?></time></a>
					<?php edit_comment_link( esc_html__( 'Edit', 'shutter-up' ), '<span class="edit-link">', '</span>' ); ?>
					</header><!-- .comment-meta -->

					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'shutter-up' ); ?></p>
					<?php endif; ?>

					<div class="comment-content">
						<?php comment_text(); ?>
					</div><!-- .comment-content -->

					<?php
						comment_reply_link( array_merge( $args, array(
							'add_below' => 'div-comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<span class="reply">',
							'after'     => '</span>',
						) ) );
					?>
				</div><!-- .comment-content -->

			</article><!-- .comment-body -->
		<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>

		<?php
		endif;
	}
endif; // ends check for shutter_up_comment()

if ( ! function_exists( 'shutter_up_slider_entry_category' ) ) :
/**
 * Prints HTML with category and tags for current post.
 *
 * Create your own shutter_up_entry_category_date() function to override in a child theme.
 *
 * @since Shutter Up 1.0
 */
function shutter_up_slider_entry_category() {
	$meta = '<div class="entry-meta">';

	$portfolio_categories_list = get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '<span class="portfolio-entry-meta entry-meta">', '', '</span>' );

	if ( 'jetpack-portfolio' === get_post_type( ) ) {
		$meta .= sprintf( '<span class="cat-links">' .'<span class="cat-label screen-reader-text">%1$s</span>%2$s</span>',
			sprintf( _x( 'Categories', 'Used before category names.', 'shutter-up' ) ),
			$portfolio_categories_list
		);
	}

	$categories_list = get_the_category_list( ' ' );
	if ( $categories_list && shutter_up_categorized_blog( ) ) {
		$meta .= sprintf( '<span class="cat-links">' . '<span class="cat-label screen-reader-text">%1$s</span>%2$s</span>',
			sprintf( _x( 'Categories', 'Used before category names.', 'shutter-up' ) ),
			$categories_list
		);
	}

	$meta .= '</div><!-- .entry-meta -->';

	return $meta;

}
endif;

if ( ! function_exists( 'shutter_up_entry_date_author' ) ) :
/**
 * Prints HTML with category and tags for current post.
 *
 * Create your own shutter_up_entry_category_date() function to override in a child theme.
 *
 * @since Shutter Up 1.0
 */
function shutter_up_entry_date_author() {
	$meta = '<div class="entry-meta">';

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$meta .= sprintf( '<span class="posted-on screen-reader-text">%3$s' . '<span class="date-label screen-reader-text">%1$s</span><a href="%2$s" rel="bookmark">%4$s</a></span>',
		_x( 'Posted on', 'Used before publish date.', 'shutter-up' ),
		esc_url( get_permalink() ),
		esc_html__( 'Posted on ', 'shutter-up' ),
		$time_string
	);

	// Get the author name; wrap it in a link.
	$byline = sprintf(
		/* translators: %s: post author */
		__( '<span class="author-label screen-reader-text">By </span>%s', 'shutter-up' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
	);

	$meta .= sprintf( '<span class="byline">%1$s%2$s</span>',
		esc_html__( ' By ', 'shutter-up' ),
		$byline
	 );


	$meta .= '</div><!-- .entry-meta -->';

	return $meta;

}
endif;
