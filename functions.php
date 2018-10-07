<?php
/**
 * Fad functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Fad
 */

if ( ! function_exists( 'fad_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function fad_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Fad, use a find and replace
		 * to change 'fad' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'fad', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'fad' ),
			)
		);

		register_nav_menus(
			array(
				'top' => esc_html__( 'Top', 'fad' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'fad_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'fad_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fad_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'fad_content_width', 640 );
}
add_action( 'after_setup_theme', 'fad_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fad_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'fad' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'fad' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'fad_widgets_init' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fad_widgets_init_footer() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'fad' ),
			'id'            => 'footer-widget',
			'description'   => esc_html__( 'Add widgets here.', 'fad' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'fad_widgets_init_footer' );


/**
 * Enqueue scripts and styles.
 */
function fad_scripts() {

	wp_enqueue_style( 'Lota-opensans-font', 'https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700', false );

	wp_enqueue_style( 'bootstrap.min', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css', false, '4.0' );

	wp_enqueue_style( 'fad-style', get_stylesheet_uri(), false, '1.0' );

	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '20151215', true );

	wp_enqueue_script( 'fad-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array( 'jquery' ), '20151215', true );

	wp_enqueue_script( 'fad-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array( 'jquery' ), '20151215', true );

	wp_enqueue_script( 'active', get_template_directory_uri() . '/assets/js/active.js', array( 'jquery' ), '20151215', true );

	wp_enqueue_script( 'videos', get_template_directory_uri() . '/assets/js/videos.js', array( 'jquery' ), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'fad_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
* For plugin recomendation notice
*/
require get_template_directory() . '/inc/functions-tgmpa.php';


if ( ! file_exists( get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php' ) ) {
	// file does not exist... return an error.
	return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'fad' ) );
} else {
	// file exists... require it.
	require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}
/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * [fad_excerpt_more description]
 *
 * @param string $more [description].
 * @return string       [description].
 */
function fad_excerpt_more( $more ) {
	$read_more_text = get_option( 'fad_options_blog_read_more_text' );
	if ( $read_more_text ) {
		global $post;
		return '<p><a class="button read_more" href="' . esc_url( get_permalink( $post->ID ) ) . '">' . $read_more_text . '</a></p>';
	} else {
		return $more;
	}
}
add_filter( 'excerpt_more', 'fad_excerpt_more' );

/**
 * [fad_excerpt_length description]
 *
 * @param int $length [description].
 * @return int       [description].
 */
function fad_custom_excerpt_length( $length ) {
	$read_more_length = get_option( 'fad_options_blog_excerpt_length' );
	if ( $read_more_length ) {
		return $read_more_length;
	} else {
		return $length;
	}
}
add_filter( 'excerpt_length', 'fad_custom_excerpt_length', 999 );

/**
 * [fad_css_styles description]
 *
 * @return void [description].
 */
function fad_css_styles() {
	$main_menu_color = get_option( 'fad_main_menu_text_colorpicker' );
	$top_menu_color  = get_option( 'fad_top_menu_text_colorpicker' );
	?>

	<style type="text/css" media="all">
	<?php if ( ! empty( $main_menu_color ) ) : ?>
				.navbar-nav > li > a {
				color:<?php echo esc_attr( $main_menu_color ); ?> !important;
				}
				.navbar-nav li > li a {
				color:#000 !important;
				}

	<?php endif; ?>

	<?php if ( ! empty( $top_menu_color ) ) : ?>

				.topnavigation li a {
				color : <?php echo esc_attr( $top_menu_color ); ?> !important;
				}

				#masthead input[type="search"]{
				background:<?php echo esc_attr( $top_menu_color ); ?>;
				}

	<?php endif; ?>


	</style>
	<?php
}
add_action( 'wp_head', 'fad_css_styles', 50 );
/**
 * [fad_print_custom_scripts description]
 *
 * @return void [description].
 */
function fad_print_custom_scripts() {
	if ( ! is_admin() ) {
		?>
			<script type="text/javascript">
				jQuery(document).ready(function($){
				$("#site").vids();
			});
			</script>
		<?php
	}
}
add_action( 'wp_head', 'fad_print_custom_scripts', 99 );
