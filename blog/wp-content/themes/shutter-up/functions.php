<?php
/**
 * Shutter Up functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Shutter_Up
 */

if ( ! function_exists( 'shutter_up_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function shutter_up_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Shutter Up, use a find and replace
		 * to change 'shutter-up' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'shutter-up', get_parent_theme_file_path( '/languages' ) );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, and column width.
		 *
		 * Google fonts url addition
		 *
		 * Font Awesome addition
		 */
		add_editor_style( array(
				'assets/css/editor-style.css',
				shutter_up_fonts_url(),
				get_theme_file_uri( 'assets/css/font-awesome/css/font-awesome.css' ),
			)
		);

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		
		set_post_thumbnail_size( 640, 480, true ); // Ratio 4:3

		// Used in Inner Pages as Header Image.
		add_image_size( 'shutter-up-header-inner', 1920, 540, true );

		// Used in Portfolio
		add_image_size( 'shutter-up-portfolio', 1920, 9999, true );// Flexible Height
		
		// Used in testimonials.
		add_image_size( 'shutter-up-testimonial', 640, 853, true ); // Ratio 3:4
		
		// Used in stats.
		add_image_size( 'shutter-up-stats', 70, 70, true ); // Ratio 1:1
		
		// Used in logo slider.
		add_image_size( 'shutter-up-logo-slider', 180, 77, true ); // Ratio 21:9
		
		// Used in Slider.
		add_image_size( 'shutter-up-slider', 1920, 700, true );

		

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary-menu'    => esc_html__( 'Primary', 'shutter-up' ),
			'social-menu'     => esc_html__( 'Header Social Menu', 'shutter-up' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		/**
		 * Add support for essential widget image.
		 *
		 */
		add_theme_support( 'ew-newsletter-image' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__( 'Small', 'shutter-up' ),
					'shortName' => esc_html__( 'S', 'shutter-up' ),
					'size'      => 13,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__( 'Normal', 'shutter-up' ),
					'shortName' => esc_html__( 'M', 'shutter-up' ),
					'size'      => 18,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html__( 'Large', 'shutter-up' ),
					'shortName' => esc_html__( 'L', 'shutter-up' ),
					'size'      => 42,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__( 'Huge', 'shutter-up' ),
					'shortName' => esc_html__( 'XL', 'shutter-up' ),
					'size'      => 56,
					'slug'      => 'huge',
				),
			)
		);

		// Add support for custom color scheme.
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => esc_html__( 'White', 'shutter-up' ),
				'slug'  => 'white',
				'color' => '#ffffff',
			),
			array(
				'name'  => esc_html__( 'Black', 'shutter-up' ),
				'slug'  => 'black',
				'color' => '#000000',
			),
			array(
				'name'  => esc_html__( 'Seventy Black', 'shutter-up' ),
				'slug'  => 'seventy-black',
				'color' => 'rgba(0,0,0,0.7)',
			),
			array(
				'name'  => esc_html__( 'Fifteen Black', 'shutter-up' ),
				'slug'  => 'fifteen-black',
				'color' => 'rgba(0,0,0,0.7)',
			),
			array(
				'name'  => esc_html__( 'Gray', 'shutter-up' ),
				'slug'  => 'gray',
				'color' => 'rgba(102,102,102,0.8)',
			),
		) );
		
	}
endif;
add_action( 'after_setup_theme', 'shutter_up_setup' );

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 *
 */
function shutter_up_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-2' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-4' ) ) {
		$count++;
	}

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
	}

	if ( $class ) {
		echo 'class="widget-area footer-widget-area ' . esc_attr( $class ) . '"';
	}
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function shutter_up_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'shutter_up_content_width', 920 );
}
add_action( 'after_setup_theme', 'shutter_up_content_width', 0 );

if ( ! function_exists( 'shutter_up_template_redirect' ) ) :
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet for different value other than the default one
	 *
	 * @global int $content_width
	 */
	function shutter_up_template_redirect() {
		$layout = shutter_up_get_theme_layout();

		if ( 'no-sidebar-full-width' === $layout ) {
			$GLOBALS['content_width'] = 1510;
		}

		if ( is_singular() ) {
			$GLOBALS['content_width'] = 680;
		}
	}
endif;
add_action( 'template_redirect', 'shutter_up_template_redirect' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function shutter_up_widgets_init() {
	$args = array(
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Sidebar', 'shutter-up' ),
		'id'          => 'sidebar-1',
		'description' => esc_html__( 'Add widgets here.', 'shutter-up' ),
		) + $args
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Footer 1', 'shutter-up' ),
		'id'          => 'sidebar-2',
		'description' => esc_html__( 'Add widgets here to appear in your footer.', 'shutter-up' ),
		) + $args
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Footer 2', 'shutter-up' ),
		'id'          => 'sidebar-3',
		'description' => esc_html__( 'Add widgets here to appear in your footer.', 'shutter-up' ),
		) + $args
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Footer 3', 'shutter-up' ),
		'id'          => 'sidebar-4',
		'description' => esc_html__( 'Add widgets here to appear in your footer.', 'shutter-up' ),
		) + $args
	);

	if ( class_exists( 'Catch_Instagram_Feed_Gallery_Widget' ) ||  class_exists( 'Catch_Instagram_Feed_Gallery_Widget_Pro' ) ) {
		register_sidebar( array(
			'name'        => esc_html__( 'Instagram', 'shutter-up' ),
			'id'          => 'sidebar-instagram',
			'description' => esc_html__( 'Appears above footer. This sidebar is only for Widget from plugin Catch Instagram Feed Gallery Widget and Catch Instagram Feed Gallery Widget Pro', 'shutter-up' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<div class="section-heading-wrapper"><div class="section-title-wrapper"><h2 class="section-title">',
			'after_title'   => '</h2></div></div>',
		) );
	}
}
add_action( 'widgets_init', 'shutter_up_widgets_init' );

if ( ! function_exists( 'shutter_up_fonts_url' ) ) :
	/**
	 * Register Google fonts for Shutter Up
	 *
	 * Create your own shutter_up_fonts_url() function to override in a child theme.
	 *
	 * @since Shutter Up 1.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function shutter_up_fonts_url() {
		$fonts_url = '';

		/* Translators: If there are characters in your language that are not
		* supported by Montserrat, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$roboto = _x( 'on', 'Roboto: on or off', 'shutter-up' );

		/* Translators: If there are characters in your language that are not
		* supported by Playfair Display, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$oswald = _x( 'on', 'Oswald: on or off', 'shutter-up' );

		if ( 'off' !== $roboto || 'off' !== $oswald) {
			$font_families = array();

			if ( 'off' !== $roboto ) {
				$font_families[] = 'Roboto:400,500,600,700,400italic,700italic';
			}

			if ( 'off' !== $oswald ) {
				$font_families[] = 'Oswald:400,500,600,700,400italic,700italic';
			}
			

			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);

			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}
		return esc_url( $fonts_url );
	}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Shutter Up 1.0
 */
function shutter_up_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'shutter_up_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 */
function shutter_up_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'shutter-up-fonts', shutter_up_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'shutter-up-style', get_stylesheet_uri() );

	// Theme block stylesheet.
	wp_enqueue_style( 'shutter-up-block-style', get_theme_file_uri( 'assets/css/blocks.css' ), array( 'shutter-up-style' ), '1.0' );

	// Load the html5 shiv.
	wp_enqueue_script( 'shutter-up-html5',  get_theme_file_uri( 'assets/js/html5.min.js' ), array(), '3.7.3' );
	wp_script_add_data( 'shutter-up-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'shutter-up-skip-link-focus-fix', get_theme_file_uri( 'assets/js/skip-link-focus-fix.min.js' ), array(), '201800703', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$deps[] = 'jquery';

	$enable_featured_content = get_theme_mod( 'shutter_up_featured_content_option', 'disabled' );
	
	if ( shutter_up_check_section( $enable_featured_content ) ) {
		wp_register_script( 'jquery-match-height', get_theme_file_uri( 'assets/js/jquery.matchHeight.min.js' ), array( 'jquery' ), '201800703', true );

		$deps[] = 'jquery-match-height';
	}

	// Portfolio enable/disable check.
	$enable_portfolio = shutter_up_check_section( get_theme_mod( 'shutter_up_portfolio_option', 'disabled' ) );

	if ( $enable_portfolio || is_home() || is_search() ) {
		$deps[] = 'jquery-masonry';
	}

	//Slider Scripts
	$enable_slider = shutter_up_check_section( get_theme_mod( 'shutter_up_slider_option', 'disabled' ) );

	$enable_testimonial_slider      = shutter_up_check_section( get_theme_mod( 'shutter_up_testimonial_option', 'disabled' ) ) && get_theme_mod( 'shutter_up_testimonial_slider', 1 );

	if ( $enable_slider || $enable_testimonial_slider ) {
		// Enqueue owl carousel css. Must load CSS before JS.
		wp_enqueue_style( 'owl-carousel-core', get_theme_file_uri( 'assets/css/owl-carousel/owl.carousel.min.css' ), null, '2.3.4' );
		wp_enqueue_style( 'owl-carousel-default', get_theme_file_uri( 'assets/css/owl-carousel/owl.theme.default.min.css' ), null, '2.3.4' );

		// Enqueue script
		wp_enqueue_script( 'owl-carousel', get_theme_file_uri( 'assets/js/owl.carousel.min.js' ), array( 'jquery' ), '2.3.4', true );

		$deps[] = 'owl-carousel';

	}

	wp_enqueue_script( 'shutter-up-script', get_theme_file_uri( 'assets/js/functions.min.js' ), $deps, '201800703', true );

	wp_localize_script( 'shutter-up-script', 'shutterUpOptions', array(
		'screenReaderText' => array(
			'expand'   => esc_html__( 'expand child menu', 'shutter-up' ),
			'collapse' => esc_html__( 'collapse child menu', 'shutter-up' ),
			'icon'     => shutter_up_get_svg( array(
					'icon'     => 'angle-down',
					'fallback' => true,
				)
			),
		),
		'iconNavPrev'     => shutter_up_get_svg( array(
				'icon'     => 'angle-left',
				'fallback' => true,
			)
		),
		'iconNavNext'     => shutter_up_get_svg( array(
				'icon'     => 'angle-right',
				'fallback' => true,
			)
		),
		'rtl' => is_rtl(),
		'dropdownIcon'     => shutter_up_get_svg( array( 'icon' => 'angle-down', 'fallback' => true ) ),
	) );
}
add_action( 'wp_enqueue_scripts', 'shutter_up_scripts' );

/**
 * Enqueue editor styles for Gutenberg
 */
function shutter_up_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'shutter-up-block-editor-style', get_theme_file_uri( 'assets/css/editor-blocks.css' ) );
	
	// Add custom fonts.
	wp_enqueue_style( 'shutter-up-fonts', shutter_up_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'shutter_up_block_editor_styles' );

if ( ! function_exists( 'shutter_up_excerpt_length' ) ) :
	/**
	 * Sets the post excerpt length to n words.
	 *
	 * function tied to the excerpt_length filter hook.
	 * @uses filter excerpt_length
	 *
	 * @since Shutter Up 1.0
	 */
	function shutter_up_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}

		// Getting data from Customizer Options
		$length	= get_theme_mod( 'shutter_up_excerpt_length', 30 );

		return absint( $length );
	}
endif; //shutter_up_excerpt_length
add_filter( 'excerpt_length', 'shutter_up_excerpt_length', 999 );

if ( ! function_exists( 'shutter_up_excerpt_more' ) ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a option from customizer
	 *
	 * @return string option from customizer prepended with an ellipsis.
	 */
	function shutter_up_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}

		$more_tag_text = get_theme_mod( 'shutter_up_excerpt_more_text',  esc_html__( 'Read More', 'shutter-up' ) );

		$link = sprintf( '<p class="more-link"><a href="%1$s" class="readmore">%2$s</a></p>',
			esc_url( get_permalink() ),
			/* translators: %s: Name of current post */
			wp_kses_data( $more_tag_text ) . shutter_up_get_svg( array( 'icon' => 'angle-right' ) ) . '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>'
			);

		return $link;
	}
endif;
add_filter( 'excerpt_more', 'shutter_up_excerpt_more' );

if ( ! function_exists( 'shutter_up_custom_excerpt' ) ) :
	/**
	 * Adds Read More link to more tag excerpts.
	 *
	 * function tied to the get_the_excerpt filter hook.
	 *
	 * @since Shutter Up 1.0
	 */
	function shutter_up_custom_excerpt( $output ) {
		if ( has_excerpt() && ! is_attachment() ) {
			$more_tag_text = get_theme_mod( 'shutter_up_excerpt_more_text', esc_html__( 'Read More', 'shutter-up' ) );

			$output .= sprintf( '<a href="%1$s" class="more-link"><span class="readmore">%2$s</span></a>',
				esc_url( get_permalink() ),
				/* translators: %s: Name of current post */
				wp_kses_data( $more_tag_text ) . shutter_up_get_svg( array( 'icon' => 'angle-right' ) ) . '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>'
			);
		}

		return $output;
	}
endif; //shutter_up_custom_excerpt
add_filter( 'get_the_excerpt', 'shutter_up_custom_excerpt' );

if ( ! function_exists( 'shutter_up_more_link' ) ) :
	/**
	 * Replacing Read More link to the_content more.
	 *
	 * function tied to the the_content_more_link filter hook.
	 *
	 * @since Shutter Up 1.0
	 */
	function shutter_up_more_link( $more_link, $more_link_text ) {
		$more_tag_text = get_theme_mod( 'shutter_up_excerpt_more_text', esc_html__( 'Read More', 'shutter-up' ) );

		return str_replace( $more_link_text, wp_kses_data( $more_tag_text ) . shutter_up_get_svg( array( 'icon' => 'angle-right' ) ), $more_link ) ;
	}
endif; //shutter_up_more_link
add_filter( 'the_content_more_link', 'shutter_up_more_link', 10, 2 );

/**
 * SVG icons functions and filters
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );

/**
 * Implement the Custom Header feature
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Functions which enhance the theme by hooking into WordPress
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions
 */
require get_parent_theme_file_path( '/inc/customizer/customizer.php' );

/**
 * Load Jetpack compatibility file
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_parent_theme_file_path( '/inc/jetpack.php' );
}

/**
 * Load Metabox
 */
require get_parent_theme_file_path( '/inc/metabox/metabox.php' );

/**
 * Load Social Widgets
 */
require get_parent_theme_file_path( '/inc/widget-social-icons.php' );

/**
 * Load TGMPA
 */
require get_parent_theme_file_path( '/inc/class-tgm-plugin-activation.php' );

/**
 * Load Theme About Page
 */
require get_parent_theme_file_path( '/inc/about.php' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function shutter_up_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		// Catch Web Tools.
		array(
			'name' => 'Catch Web Tools', // Plugin Name, translation not required.
			'slug' => 'catch-web-tools',
		),
		// Catch IDs
		array(
			'name' => 'Catch IDs', // Plugin Name, translation not required.
			'slug' => 'catch-ids',
		),
		// To Top.
		array(
			'name' => 'To top', // Plugin Name, translation not required.
			'slug' => 'to-top',
		),
		// Catch Gallery.
		array(
			'name' => 'Catch Gallery', // Plugin Name, translation not required.
			'slug' => 'catch-gallery',
		),
	);

	if ( ! class_exists( 'Catch_Infinite_Scroll_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Catch Infinite Scroll', // Plugin Name, translation not required.
			'slug' => 'catch-infinite-scroll',
		);
	}

	if ( ! class_exists( 'Essential_Content_Types_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Essential Content Types', // Plugin Name, translation not required.
			'slug' => 'essential-content-types',
		);
	}

	if ( ! class_exists( 'Essential_Widgets_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Essential Widgets', // Plugin Name, translation not required.
			'slug' => 'essential-widgets',
		);
	}

	if ( ! class_exists( 'Catch_Instagram_Feed_Gallery_Widget_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Catch Instagram Feed Gallery & Widget', // Plugin Name, translation not required.
			'slug' => 'catch-instagram-feed-gallery-widget',
		);
	}

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'shutter-up',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'shutter_up_register_required_plugins' );

/**
 * Checks if there are options already present from free version and adds it to the Pro theme options
 *
 * @since Shutter Up 1.0
 * @hook after_theme_switch
 */
function shutter_up_setup_options( $old_theme_name ) {
	if ( $old_theme_name ) {
		$old_theme_slug = sanitize_title( $old_theme_name );
		$free_version_slug = array(
			'shutterUp',
		);

		$pro_version_slug  = 'shutter-up';

		$free_options = get_option( 'theme_mods_' . $old_theme_slug );

		// Perform action only if theme_mods_shutterUp free version exists.
		if ( in_array( $old_theme_slug, $free_version_slug ) && $free_options && '1' !== get_theme_mod( 'free_pro_migration' ) ) {
			$new_options = wp_parse_args( get_theme_mods(), $free_options );

			if ( update_option( 'theme_mods_' . $pro_version_slug, $free_options ) ) {
				// Set Migration Parameter to true so that this script does not run multiple times.
				set_theme_mod( 'free_pro_migration', '1' );
			}
		}
	}
}
add_action( 'after_switch_theme', 'shutter_up_setup_options' );
