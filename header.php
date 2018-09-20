<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fad
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'fad' ); ?></a>
		<header>
	<div class="container">
<div class="topbar">
		<a class="navbar-brand js-scroll-trigger" href="#page-top">
			<?php
			$fad_title_toggle_logo = get_theme_mod( 'fad_title_toggle_logo' );
			if($fad_title_toggle_logo == '1'){ ?>
	<style>
	.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}

	</style>
				<?php
			}

			the_custom_logo();
				?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php		$fad_description = get_bloginfo( 'description', 'display' );
		if ( $fad_description || is_customize_preview() ) :
			?>
					<p class="site-description"><?php echo $fad_description; /* WPCS: xss ok. */ ?></p>
		<?php endif; ?>
	</a>
</div>
	<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'top',
						'depth'           => 1,
						'menu_class'      => 'topnavigation',
						'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
						'walker'          => new WP_Bootstrap_Navwalker(),
					)
				);

				$fad_header_search = get_theme_mod( 'fad_header_search' );
				if($fad_header_search == '1'){ ?>
		<style>
		header input[type="search"] {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}

		</style>
					<?php
				}
		get_search_form(); ?>
</div>
</header>
<div class="bs-example">
              <nav class="navbar-inverse" role="navigation">
                <div class="container">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header">

                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>

                  </div>

                  <!-- Collect the nav links, forms, and other content for toggling -->
												<?php
															wp_nav_menu(
																array(
																	'theme_location'  => 'primary',
																	'depth'           => 3,
																	'container'       => 'div',
																	'container_class' => 'collapse navbar-collapse',
																	'container_id'    => 'bs-example-navbar-collapse-1',
																	'menu_class'      => 'nav navbar-nav',
																	'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
																	'walker'          => new WP_Bootstrap_Navwalker(),
																)
															);
															?>

                </div><!-- /.container-fluid -->
              </nav>
            </div>
        <!-- /.container -->

    </nav>
    <!-- Navigation -->
		<div class="container">
