<?php
/**
 * Primary Menu Template
 *
 * @package Shutter_Up Pro
 */

?>
	<div id="site-header-menu" class="site-header-menu">
		<div id="primary-menu-wrapper" class="menu-wrapper">
			<div class="menu-toggle-wrapper">
				<button id="menu-toggle"  class="menu-toggle" aria-controls="top-menu" aria-expanded="false"><?php echo shutter_up_get_svg( array( 'icon' => 'bars' ) ); echo shutter_up_get_svg( array( 'icon' => 'close' ) ); ?><span class="menu-label"><?php echo esc_html_e( 'Menu', 'shutter-up' ); ?></span></button>
			</div><!-- .menu-toggle-wrapper -->

			<div class="menu-inside-wrapper">
				<?php if ( has_nav_menu( 'primary-menu' ) ) : ?>

					<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'shutter-up' ); ?>">
						<?php
							wp_nav_menu( array(
									'container'      => '',
									'theme_location' => 'primary-menu',
									'menu_id'        => 'primary-menu',
									'menu_class'     => 'menu nav-menu',
								)
							);
						?>

				<?php else : ?>

					<nav id="site-navigation" class="main-navigation default-page-menu" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'shutter-up' ); ?>">
						<?php wp_page_menu(
							array(
								'menu_class' => 'primary-menu-container',
								'before'     => '<ul id="menu-primary-items" class="menu nav-menu">',
								'after'      => '</ul>',
							)
						); ?>

				<?php endif; ?>

					</nav><!-- .main-navigation -->

				<div class="mobile-social-search">

					<div class="search-container">
						<?php get_search_form(); ?>
					</div>

					<?php if ( has_nav_menu( 'social-menu' ) ) : ?>
						<div id="header-menu-social" class="menu-social"><?php get_template_part('template-parts/navigation/navigation', 'social'); ?></div>
					<?php endif; ?>

				</div><!-- .mobile-social-search -->
			</div><!-- .menu-inside-wrapper -->
		</div><!-- #primary-menu-wrapper.menu-wrapper -->

		<div id="primary-search-wrapper" class="menu-wrapper">
			<div class="menu-toggle-wrapper">
				<button id="social-search-toggle" class="menu-toggle search-toggle"><?php echo shutter_up_get_svg( array( 'icon' => 'search' ) ); echo shutter_up_get_svg( array( 'icon' => 'close' ) ); ?><span class="screen-reader-text"><?php esc_html_e( 'Search', 'shutter-up' ); ?></span></button>
			</div><!-- .menu-toggle-wrapper -->

			<div class="menu-inside-wrapper">
				<div class="search-container">
					<?php get_Search_form(); ?>
				</div>
			</div><!-- .menu-inside-wrapper -->
		</div><!-- #social-search-wrapper.menu-wrapper -->

		<?php if ( has_nav_menu( 'social-menu' ) ) : ?>
		<!-- Social Navigation Top -->
		<div id="social-menu-wrapper" class="menu-wrapper">
			<nav class="social-navigation social-top" role="navigation" aria-label="<?php esc_attr_e( 'Social Menu', 'shutter-up' ); ?>">
					<?php
						wp_nav_menu( array(
							'theme_location'  => 'social-menu',
							'menu_class'      => 'social-links-menu',
							'container'       => 'div',
							'container_class' => 'menu-social-container',
							'depth'           => 1,
							'link_before'     => '<span class="screen-reader-text">',
							'link_after'      => '</span>' . shutter_up_get_svg( array( 'icon' => 'chain' ) ),
						) );
					?>
				</nav><!-- .social-navigation -->
		</div><!-- .menu-wrapper -->
		<?php endif; ?>
	</div><!-- .site-header-menu -->
