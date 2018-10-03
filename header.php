<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fad
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'fad' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-6">
					<div class="site-branding">
						<?php the_custom_logo(); ?>
						<?php
						if ( is_front_page() && is_home() ) :
							?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php
						else :
							?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							<?php
						endif;

						$fad_description = get_bloginfo( 'description', 'display' );
						if ( $fad_description || is_customize_preview() ) :
							?>
							<p class="site-description"><?php echo $fad_description; /* WPCS: xss ok. */ ?></p>
							<?php
						endif;
						?>
					</div>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-2">
					<?php get_search_form(); ?>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'top',
							'depth'          => 1,
							'menu_class'     => 'topnavigation',
							'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
							'walker'         => new WP_Bootstrap_Navwalker(),
						)
					);
					?>
				</div>

			</div>
		</div>
	</header><!-- #masthead -->

	<nav id="site-navigation" class="main-navigation navbar navbar-expand-md navbar-light" role="navigation">
		<div class="container">
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

			<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'primary',
					'depth'           => 3,
					'container'       => 'div',
					'container_class' => 'collapse navbar-collapse',
					'container_id'    => 'navbarResponsive',
					'menu_class'      => 'navbar-nav',
					'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
					'walker'          => new WP_Bootstrap_Navwalker(),
				)
			);
			?>
		</div>
	</nav><!-- #site-navigation -->
