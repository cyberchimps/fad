<?php
/**
 * fad functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package fad
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
		 * If you're building a theme based on fad, use a find and replace
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
		add_image_size( 'fad_archive', 350, 230,true );
		add_image_size( 'fad_slider', 1000, 400,true );
		add_image_size( 'fad_single', 750, 500,true );

				register_nav_menus(
					array(
						'primary' => __( 'Primary Menu', 'fad' ),
					)
				);

						register_nav_menus(
							array(
								'top' => __( 'Top Menu', 'fad' ),
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
			'before_title'  => '<h5>',
			'after_title'   => '</h5>',
		)
	);
}
add_action( 'widgets_init', 'fad_widgets_init' );


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
	wp_enqueue_style( 'fad-style', get_stylesheet_uri() );
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), '20180924', true );
	wp_enqueue_script( 'jquery', get_template_directory_uri() . 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js', array(), '20180924', true );
	wp_enqueue_script( 'bootstrap-dropdownhover', get_template_directory_uri() . '/assets/js/bootstrap-dropdownhover.js', array(), '20180924', true );
	wp_enqueue_script( 'active', get_template_directory_uri() . '/assets/js/active.js', array(), '20180924', true );

	wp_enqueue_script( 'fad-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20180924', true );

	wp_enqueue_script( 'fad-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20180924', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'fad_scripts' );

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
* For plugin recomendation notice
*/
require get_template_directory() . '/inc/functions-tgmpa.php';

/**
 * Enqueue scripts and styles
 */
function fad_enqueue_css() {
	$directory_uri = get_template_directory_uri();
	wp_enqueue_style( 'bootstrap', $directory_uri.'/assets/css/bootstrap.min.css',false );
  wp_enqueue_style( 'animate', $directory_uri.'/assets/css/animate.min.css',false );
  wp_enqueue_style( 'bootstrap-dropdownhover', $directory_uri.'/assets/css/bootstrap-dropdownhover.min.css',false);
  wp_enqueue_style( 'Lota-opensans-font', 'https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700', false );
  wp_enqueue_style( 'fad', $directory_uri.'/assets/css/fad.css',false);
}
add_action( 'wp_enqueue_scripts', 'fad_enqueue_css' );


add_action( 'wp_head', 'fad_css_styles', 50 );
function fad_css_styles(){
	$main_menu_color = get_option('fad_main_menu_text_colorpicker');
	$top_menu_color = get_option('fad_top_menu_text_colorpicker');
	$background_color = get_option('fad_background_colorpicker');
	?>

	<style type="text/css" media="all">
	<?php if ( !empty( $main_menu_color ) ) : ?>
				.navbar-inverse .navbar-nav > li > a {
				color:<?php echo $main_menu_color; ?>;
				}
	<?php endif; ?>

	<?php if ( !empty( $top_menu_color ) ) : ?>
				.topnavigation li a {
				color:<?php echo $top_menu_color; ?>;
				}
				input[type="search"]{
				background:<?php echo $top_menu_color; ?>;
				}
	<?php endif; ?>

	<?php if ( !empty( $background_color ) ) : ?>
				body {
				background:<?php echo $background_color; ?>;
				}
	<?php endif; ?>

	</style>
	<?php
}

function fad_excerpt_more( $more ) {

	$read_more_text = get_option( 'fad_options_blog_read_more_text');
	if($read_more_text != ''){
	global $post;
	return '<p><a class="button read_more" href="' . esc_url(get_permalink( $post->ID )) . '">' . $read_more_text . '</a></p>';
	}else{
		return $more;
	}
}
add_filter( 'excerpt_more', 'fad_excerpt_more' );

function fad_custom_excerpt_length( $length ) {
	$read_more_length = get_option( 'fad_options_blog_excerpt_length');

	if($read_more_length != ''){
	return $read_more_length;
	}else{
		return $length;
	}
}
add_filter( 'excerpt_length', 'fad_custom_excerpt_length', 999 );
add_action( 'admin_notices', 'my_admin_notice' );
function my_admin_notice(){
	global $fad_check_screen;
	$fad_check_screen = get_admin_page_title();

   if ( $fad_check_screen == 'Manage Themes' )
{
          echo '<div class="notice notice-info is-dismissible"><p class="fad-upgrade-callout" style="font-size:18px; "><a href="https://cyberchimps.com/free-download-50-stock-images-use-please/?utm_source=Fad" target="_blank" style="text-decoration:none;">FREE - Download CyberChimps\' Pack of 50 High-Resolution Stock Images Now</a></p></div>';
}
}

function fad_customize_edit_links( $wp_customize ) {


   $wp_customize->selective_refresh->add_partial( 'blogname', array(
'selector' => '#site-title h1'
) );

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '#site-description'
	) );

}
add_action( 'customize_register', 'fad_customize_edit_links' );


/**
 * Function for layout customizer option
 */
function fad_set_page_post_layout() {
	$fad_layout_options = get_theme_mod( 'fad_layout_options', 'right-sidebar' );
	return apply_filters( 'fad_page_layout', $fad_layout_options );
}

/**
 * Function to set class
 */
function fad_set_class() {
	$fad_layout_options = get_theme_mod( 'fad_layout_options', 'right-sidebar' );
	$content_class              = 'col-md-8 col-sm-12';
	if ( $fad_layout_options == 'no-sidebar' ) {
		$content_class = 'col-md-12 col-sm-12';
	} else {
		$content_class = 'col-md-8 col-sm-12';
	}
	return $content_class;
}

	function fad_custom_meta() {
		    add_meta_box( 'fad_meta', __( 'Featured Posts', 'fad' ), 'fad_meta_callback', 'post' );
		}
		function fad_meta_callback( $post ) {
		    $featured = get_post_meta( $post->ID );
		    ?>

			<p>
		    <div class="fad-row-content">
		        <label for="meta-checkbox">
		            <input type="checkbox" name="meta-checkbox" id="meta-checkbox" value="yes" <?php if ( isset ( $featured['meta-checkbox'] ) ) checked( $featured['meta-checkbox'][0], 'yes' ); ?> />
		            <?php _e( 'Featured this post', 'fad' )?>
		        </label>

		    </div>
		</p>

		    <?php
		}
		add_action( 'add_meta_boxes', 'fad_custom_meta' );

		/**
		 * Saves the custom meta input
		 */
		function fad_meta_save( $post_id ) {

		    // Checks save status
		    $is_autosave = wp_is_post_autosave( $post_id );
		    $is_revision = wp_is_post_revision( $post_id );
		    $is_valid_nonce = ( isset( $_POST[ 'fad_nonce' ] ) && wp_verify_nonce( $_POST[ 'fad_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

		    // Exits script depending on save status
		    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
		        return;
		    }

		 // Checks for input and saves
		if( isset( $_POST[ 'meta-checkbox' ] ) ) {
		    update_post_meta( $post_id, 'meta-checkbox', 'yes' );
		} else {
		    update_post_meta( $post_id, 'meta-checkbox', '' );
		}

		}
		add_action( 'save_post', 'fad_meta_save' );

		function fad_text_sanitization( $text ) {
			return sanitize_text_field( $text );
		}

		function fad_sanitize_checkbox( $input ) {
			if( $input ) {
				$output = '1';
			}
			else {
				$output = false;
			}

			return $output;
		}
